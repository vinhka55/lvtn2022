<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
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
    public function payment_method(Request $req)
    {
        $data=[];
        $data['name']=$req->name;
        $data['email']=$req->email;
        $data['phone']=$req->phone;
        $data['address']=$req->address;
        $data['notes']=$req->notes;
        $shipping_id=DB::table('shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id);
        return view('page.checkout.payment');
    }
    public function order_place(Request $req)
    {
        $data=[];
        $data['method']=$req->pay;
        $data['status']="Đang chờ xử lý";
        $payment_id=DB::table('payment')->insertGetId($data);

        //insert đơn hàng
        $data=[];
        $data['customer_id']=Session::get('user_id');
        $data['shipping_id']=Session::get('shipping_id');
        $data['payment_id']=$payment_id;
        $data['total_money']=Cart::total();
        $data['status']="Đang chờ xử lý";
        $order_id=DB::table('order')->insertGetId($data);

        //insert chi tiết đơn hàng      
        $content=Cart::items()->original;
        foreach($content as $item){
            $data=[];
            $data['order_id']=$order_id;
            $data['product_id']=$item['product'];
            $data['product_name']=$item['name'];
            $data['product_price']=$item['price'];
            $data['product_quantyti']=$item['qty'];
            DB::table('order_detail')->insert($data);
        }
        return view('page.checkout.payment_done');
    }
    public function list_order()
    {
        $data=DB::table('order')->join('user','order.customer_id','=','user.id')->select('order.*','user.name')->orderby('order.id','desc')->get();
        return view('admin.order.list',['data'=>$data]);
    }
    public function detail_order($orderId)
    {

        $user_id=DB::table('order')->where('id',$orderId)->value('customer_id');
        $info_user=DB::table('user')->where('id',$user_id)->get();

        $shipping_id=DB::table('order')->where('id',$orderId)->value('shipping_id');
        $info_shipping=DB::table('shipping')->where('id',$shipping_id)->get();

        $info_product=DB::table('order_detail')->where('order_id',$orderId)->get();
        return view('admin.order.detail',['info_user'=>$info_user,'info_shipping'=>$info_shipping,'info_product'=>$info_product]);
    }
    public function delete_order($orderId)
    {
        if(DB::table('order')->where('id',$orderId)->delete()){
            return redirect('/danh-sach-don-hang');
        }
        else{
            echo 'Xóa không thành công, vui lòng thử lại';
        }
    }
}
