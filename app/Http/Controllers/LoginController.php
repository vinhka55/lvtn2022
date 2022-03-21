<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;
use Socialite;
use App\Models\User;
use Session;

class LoginController extends Controller
{
    public function login_google(){
        return Socialite::driver('google')->redirect();
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
}
