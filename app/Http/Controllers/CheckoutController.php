<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
session_start();

class CheckoutController extends Controller
{
    public function login()
    {
        return view('page.login.login_user');
    }
    public function handle_login(Request $req)
    {
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
        // $ga_dong_lanh=DB::table('product')->where('category_id',1)->get();
        // $ga_tuoi_sach=DB::table('product')->where('category_id',2)->get();
        // $bo_uc_my=DB::table('product')->where('category_id',3)->get();
        // $thit_heo=DB::table('product')->where('category_id',4)->get();
        // $trau_an_do=DB::table('product')->where('category_id',5)->get();
        // $hai_san=DB::table('product')->where('category_id',6)->get();
        // $gao_sach=DB::table('product')->where('category_id',9)->get();  
        // $gia_vi=DB::table('product')->where('category_id',12)->get();
        // return view('page.home',['ga_dong_lanh'=>$ga_dong_lanh,'ga_tuoi_sach'=>$ga_tuoi_sach,'bo_uc_my'=>$bo_uc_my,'thit_heo'=>$thit_heo,'trau_an_do'=>$trau_an_do,'hai_san'=>$hai_san,'gao_sach'=>$gao_sach,'gia_vi'=>$gia_vi]);
        return redirect('/');
    }
    public function register(Request $req)
    {
        $data=[];
        $data['name']=$req->name;
        $data['email']=$req->email;
        $data['password']=$req->password;
        $data['phone']=$req->phone;
        $user_id=DB::table('user')->insertGetId($data);
        Session::put('user_id',$user_id);
        Session::put('name_user',$req->name);
        echo Session::get('name_user');
    }
    public function pay()
    {
        $id_customer=Session::get('user_id');
        $data=DB::table('user')->where('id',$id_customer)->get();
        return view('page.checkout.show_checkout',['info'=>$data]);
    }
}
