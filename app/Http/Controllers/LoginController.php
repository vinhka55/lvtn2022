<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;
use Socialite;
use App\Models\User;
use Session;
use DB;

class LoginController extends Controller
{
    public function login_google(){
        return Socialite::driver('google')->with(["prompt" => "select_account"])->redirect();
    }
    public function callback_google(){
        $users = Socialite::driver('google')->stateless()->user(); 
        $authUser = $this->findOrCreateUser($users,'google');
        $account_name = User::where('id',$authUser->login_id)->first();
        Session::put('name_user',$account_name->name);
        Session::put('user_id',$account_name->id);
        return redirect('/');
        
    }
    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){
            return $authUser;
        }
    
        $account = new Social([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);

        $orang = User::where('email',$users->email)->first();

            if(!$orang){
                $orang = User::create([
                    'name' => $users->name,
                    'email' => $users->email,
                    'password' => '',
                    'phone' => '',
                ]);
            }
        $account->login()->associate($orang);
        $account->save();

        $account_name = User::where('id',$authUser->login_id)->first();
        Session::put('name_user',$account_name->name);
        Session::put('user_id',$account_name->id);
        return redirect('/');
    }
    public function login()
    {
        return view('page.login.login_user');
    }
    public function handle_login(Request $req)
    {
        $this->validate($req,[
            'email'=>"required|email",
            'password'=>"required",
        ]);
        $data=DB::table('user')->where('email',$req->email)->where('password',$req->password)->get();
        if(count($data)!=0){
            
                foreach($data as $item){
                Session::put('user_id',$item->id);
                Session::put('name_user',$item->name);
                return redirect('/');
                }
        }else{
            echo 'sai pass or mail';
        }   
    }
    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
    public function register(Request $req)
    {
        $this->validate($req,[
            'name'=>"required",
            'email'=>"required|email",
            'password'=>'min:6|required|same:repassword',
            'repassword'=>'min:6',
            'phone'=>"required",
        ]);
        $data=[];
        $data['name']=$req->name;
        $data['email']=$req->email;
        $data['password']=$req->password;
        $data['phone']=$req->phone;
        $user_id=DB::table('user')->insertGetId($data);
        Session::put('user_id',$user_id);
        Session::put('name_user',$req->name);
        return redirect('/');
    }
}
