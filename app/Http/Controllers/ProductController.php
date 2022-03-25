<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Product;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use Image;
use Session;

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return redirect('/admin');
        }else{
            return redirect('/admin/login');
        }
    }
    public function add(Request $req)
    {
        return view('admin.product.add_product');
    }

    public function handle_add(Request $req)
    {
        $this->AuthLogin();
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
        //echo $req->file("image");return;
        if($product->image){
            $name_image= $product->image->getClientOriginalName();
            $product->image->move("public/uploads/product",$name_image);
            $product->image=$name_image;
            $product->save();
            return redirect('admin/danh-sach-san-pham');
        }
        $product->image="";
        $product->save();
        echo 'not ok';
    }
    public function list() 
    {
        $this->AuthLogin();
        $product=DB::table('product')->paginate(5);
        
        return view('admin.product.list_product',['product'=>$product]);
    }
    public function edit_status($id)
    {
        $status=DB::table('product')->where('id',$id)->value('status');
        $bool_status=(Boolean)$status;
        $status=(int)!$bool_status;
        if(DB::table('product')->where('id', $id)->update(['status' =>$status ])){
            return redirect('admin/danh-sach-san-pham');
        }
        else{
            echo 'Update status không thành công, vui lòng thử lại';
        }
    }
    public function delete($id)
    {
        if(DB::table('product')->where('id',$id)->delete()){
            return redirect('admin/danh-sach-san-pham');
        }
        else{
            echo 'Xóa không thành công, vui lòng thử lại';
        }
    }
    public function detail($id)
    {
        //load avatar
        
        $my_avatar=DB::table('user')->where('id',Session::get('user_id'))->value('avatar');

        $product=DB::table('product')->where('id',$id)->get();
        echo view('page.check_product',['product'=>$product,'my_avatar'=>$my_avatar]);
    }
    public function edit($id)
    {
        $product=Product::where('id',$id)->get();
        // echo "<pre>";
        // var_dump($product);
        // return;
        return view('admin.product.edit',compact('product'));
    }
    public function handle_edit(Request $req)
    {
        $product=Product::where('id',$req->id)->first();
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
        //echo $req->file("image");return;
        if($product->image!=null){
            // echo "<pre>";
            // var_dump($product->image);
            // return;
            $name_image= $product->image->getClientOriginalName();
            $product->image->move("public/uploads/product",$name_image);
            $product->image=$name_image;
            $product->save();
            return redirect('admin/danh-sach-san-pham');
        }
        $product->image=$req->old_image;
        $product->save();
        return redirect('admin/danh-sach-san-pham');
    }
}
