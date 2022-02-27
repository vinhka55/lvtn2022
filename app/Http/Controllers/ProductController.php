<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;

class ProductController extends Controller
{
    public function add(Request $req)
    {
        return view('admin.product.add_product');
    }
    public function handle_add(Request $req)
    {
        $product=new Product;
        $product->name=$req->name;
        $product->origin=$req->origin;
        $product->price=$req->price;
        $product->exp=$req->exp;
        $product->category_id=$req->category_id;
        $product->description=$req->description;
        $product->image=$req->file("image");
        $product->count=$req->count;
        $product->status=$req->status;
        $product->note=$req->note;
        
        if($product->image){
            $name_image= $product->image->getClientOriginalName();
            $product->image->move("public/uploads/product",$name_image);
            $product->image=$name_image;
            $product->save();
            return redirect('/danh-sach-san-pham');
        }
        $product->image="";
        $product->save();
        echo 'not ok';
    }
    public function list() 
    {
        $product=DB::table('product')->get();
        //return $product;
        return view('admin.product.list_product',['product'=>$product]);
    }
    public function edit_status($id)
    {
        $status=DB::table('product')->where('id',$id)->value('status');
        $bool_status=(Boolean)$status;
        $status=(int)!$bool_status;
        if(DB::table('product')->where('id', $id)->update(['status' =>$status ])){
            return redirect('/danh-sach-san-pham');
        }
        else{
            echo 'Update status không thành công, vui lòng thử lại';
        }
    }
    public function delete($id)
    {
        if(DB::table('product')->where('id',$id)->delete()){
            return redirect('/danh-sach-san-pham');
        }
        else{
            echo 'Xóa không thành công, vui lòng thử lại';
        }
    }
    public function detail($id)
    {
        $product=DB::table('product')->where('id',$id)->get();
        echo view('page.check_product',['product'=>$product]);
    }
}