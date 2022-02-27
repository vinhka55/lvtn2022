<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
//use Munna\ShoppingCart\Cart;

class CartController extends Controller
{
    public function get_mothod_shopping_cart()
    {
        return view('page.cart.show_cart');
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
        //$product=$cart->items();
        // Cart::remove("mrk6out9usge7zzwtwbxemglvnci1exv");
        //return Cart::items();
        return view('page.cart.show_cart');
    }
    public function delete_product($uid)
    {       
        if(Cart::remove($uid)){
            return redirect('/gio-hang');
        }
    }
    public function update($uid, Request $req)
    {
        if(Cart::update($uid,$req->quantity)){
            return redirect('/gio-hang');
        }
    }
    public function pay()
    {
        echo 'ok';
    }
}
