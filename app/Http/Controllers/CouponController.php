<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Session;

class CouponController extends Controller
{
    public function insert()
    {
        return view('admin.coupon.insert');
    }
    public function handle_insert(Request $req)
    {
        $data= $req->all();
        $coupon= new Coupon();
        $coupon->name=$data['name'];
        $coupon->code=$data['code'];
        $coupon->amount=$data['amount'];
        $coupon->condition=$data['condition'];
        $coupon->rate=$data['rate'];
        $coupon->save();
        return redirect('/danh-sach-ma-giam-gia');
    }
    public function list()
    {
        $data=Coupon::all();
        return view('admin.coupon.list')->with(compact('data'));
    }
    public function discount(Request $req)
    {
        $data = $req->all();
        //echo $data['code_coupon'];
        if(Coupon::where('code',$data['code_coupon'])->value('id')){            
            $id_coupon=Coupon::where('code',$data['code_coupon'])->value('id');
            if(Session::has('id_coupon')){
                Session::forget('id_coupon');
            }
            Session::put('id_coupon',$id_coupon);
            if(Session::has('incorrect_coupon')){
                Session::forget('incorrect_coupon');
            }
            return redirect('/gio-hang');
        }
        else{
            if(Session::has('id_coupon')){
                Session::forget('id_coupon');
            }
            Session::put('incorrect_coupon','Mã giảm giá sai');
            return redirect('/gio-hang');
        }
    }
    public function delete($id)
    {
        $coupon= Coupon::find($id);
        $coupon->delete();
        return redirect('danh-sach-ma-giam-gia');
    }
    public function edit($id)
    {
        $coupon=Coupon::find($id)->get();
        return view('admin.coupon.edit')->with(compact('coupon'));
    }
    public function handle_edit(Request $req)
    {
        $data=$req->all();
        $id=$data['id'];
        $coupon= Coupon::find($id);
        $coupon->name=$data['name'];
        $coupon->code=$data['code'];
        $coupon->amount=$data['amount'];
        $coupon->condition=$data['condition'];
        $coupon->rate=$data['rate'];
        $coupon->save();
        return redirect('/danh-sach-ma-giam-gia');
    }
}
