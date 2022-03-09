<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function index($id)        
    {   
        $name=DB::table('category')->where('id',$id)->value('name');
        $product=DB::table('product')->where('category_id',$id)->get();
        return view('page.show_product_with_category',['name'=>$name,'product'=>$product]);
    }
    public function add_category()
    {
        return view('admin.category.add_category');
    }
    public function handle_add(Request $req)
    {
        $data['name']=$req->name;
        $data['status']=$req->status;
        if(DB::table('category')->insert($data)){
            return redirect('/danh-sach-danh-muc');
        }
        else{
            echo 'that bai';
        }
    }
    public function list()
    {
        $list_category=DB::table('category')->orderBy('created_at','asc')->get();
        return view('admin.category.list_category',['list_category'=>$list_category]);
    }
    public function delete($id)
    {
        if(DB::table('category')->where('id',$id)->delete()){
            return redirect('/danh-sach-danh-muc');
        }
        else{
            echo 'Xóa không thành công, vui lòng thử lại';
        }
    }
    public function edit($id)
    {
        $category=DB::table('category')->where('id',$id)->first();
        return view('admin.category.edit_category',['category'=>$category]);
    }
    public function handle_edit(Request $req,$id)
    {
        $name_category=$req->name;
        if(DB::table('category')->where('id', $id)->update(['name' => $name_category])){
            return redirect('/danh-sach-danh-muc');
        }
        else{
            echo 'Update không thành công, vui lòng thử lại';
        }
    }
    public function edit_status($id)
    {
        $status=DB::table('category')->where('id',$id)->value('status');
        $bool_status=(Boolean)$status;
        $status=(int)!$bool_status;
        
        if(DB::table('category')->where('id', $id)->update(['status' =>$status ])){
            return redirect('/danh-sach-danh-muc');
        }
        else{
            echo 'Update status không thành công, vui lòng thử lại';
        }
    }
    
}
