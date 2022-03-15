<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;
class HomeController extends Controller
{
    public function index()
    {
        $ga_dong_lanh=DB::table('product')->where('category_id',1)->limit(6)->get();
        $ga_tuoi_sach=DB::table('product')->where('category_id',2)->limit(6)->get();
        $bo_uc_my=DB::table('product')->where('category_id',3)->limit(6)->get();
        $thit_heo=DB::table('product')->where('category_id',4)->limit(6)->get();
        $trau_an_do=DB::table('product')->where('category_id',5)->limit(6)->get();
        $hai_san=DB::table('product')->where('category_id',6)->limit(6)->get();
        $gao_sach=DB::table('product')->where('category_id',7)->limit(6)->get();  
        $gia_vi=DB::table('product')->where('category_id',8)->limit(6)->get();
        $hot_product=Product::limit(6)->get();
        return view('page.home',['ga_dong_lanh'=>$ga_dong_lanh,'ga_tuoi_sach'=>$ga_tuoi_sach,'bo_uc_my'=>$bo_uc_my,'thit_heo'=>$thit_heo,'trau_an_do'=>$trau_an_do,'hai_san'=>$hai_san,'gao_sach'=>$gao_sach,'gia_vi'=>$gia_vi,'hot_product'=>$hot_product]);
    }
    public function search(Request $req)
    {
        $data=DB::table('product')->where('name','like','%'.$req->search.'%')->get();
        return view('page.search_product',['data'=>$data]);
    }
}
