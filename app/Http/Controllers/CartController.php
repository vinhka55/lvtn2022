<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;
use App\Models\Coupon;
//use Munna\ShoppingCart\Cart;

class CartController extends Controller
{
    public function get_mothod_shopping_cart()
    {
        //Session::forget('incorrect_coupon');
        if(Session::has('id_coupon')){

            $id_coupon=Session::get('id_coupon');
            $coupon=DB::table('coupon')->where('id',$id_coupon)->get();
            return view('page.cart.show_cart',['coupon'=>$coupon]);
        }
        else{
            $coupon=array();
            return view('page.cart.show_cart',['coupon'=>$coupon]);
        }
    }

    public function shopping_cart(Request $req)
    {
        // Require Fields
        $product_id  = $req->id; // Required
        $product_name = $req->name; // Required
        $product_qty = $req->quantity; // Required
        $product_price = $req->price; // Required
        $product_image=$req->image;
        Cart::add($product_id, $product_name, $product_qty, $product_price,0,$product_image);
        if(Session::has('id_coupon')){
            Session::forget('id_coupon');
        }
        if(Session::has('incorrect_coupon')){
            Session::forget('incorrect_coupon');
        }
        $coupon=array();
        return view('page.cart.show_cart',['coupon'=>$coupon]);
        
    }
    public function delete_product($uid)
    {       
        if(Cart::remove($uid)){
            return redirect('/gio-hang');
        }
    }
    public function update(Request $req)
    {
        $data=$req->all();
        echo "<pre>";
        var_dump($data['quantity']);
        echo "</pre>";
        foreach($data['quantity'] as $key=>$val){
            Cart::update($key, $val);
        }
        return redirect()->back();
    }
    public function pay()
    {
        echo 'ok';
    }
    public function add_cart_ajax(Request $req)
    {
        $data= $req->all();
        //$session_id = substr(md5(microtime()),rand(0,26),5);
        //$cart = Session::get('cart');
        $product_name = $data['cart_product_name'];
        $product_id = $data['cart_product_id'];
        $product_image = $data['cart_product_image'];
        $product_qty = $data['cart_product_qty'];
        $product_price = $data['cart_product_price'];
        Cart::add($product_id, $product_name, $product_qty, $product_price,0,$product_image);
    }
    public function delete_all()
    {
        Cart::clear();
        return redirect()->back();
    }
    public function show_cart_menu()
    {
        echo Cart::count();
    }
    public function hover_cart_menu()
    {
        $content=Cart::items()->original;
        $output='';
        if(count($content)>0){
            $output.= '<ul class="list-unstyled">';
            foreach ($content as $key => $value) {
                $output.='<li><a href="http://localhost/lvtn2022/gio-hang"><p class="text-danger">'.$value['name'].': '.$value['price'].'</p></a></li><hr>';
            }
            $output.= '</ul>';
            $output.='<button type="button" class="btn btn-success text-white"><a class="text-decoration-none text-white" href="http://localhost/lvtn2022/gio-hang">Thanh toán</a></button>';

        }
        else{
            $output.="<p class='text-center'>empty cart</p>";
        }
        return $output;
    }
}
