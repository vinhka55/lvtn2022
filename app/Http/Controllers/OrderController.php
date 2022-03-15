<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\OrderDetails;
use App\Models\Product;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function format_datetime($datetime)
    {
        return Carbon::parse($datetime);
    }
    public function order_place(Request $req)
    {
        //Cập nhật lại số lượng coupon nếu có áp mã
        if(Session::has('id_coupon')){        
            $amount_coupon=Coupon::where('id',Session::get('id_coupon'))->value('amount');
            if($amount_coupon>0){
                $amount_coupon=$amount_coupon-1;
                $coupon=Coupon::find(Session::get('id_coupon'));
                $coupon->amount=$amount_coupon;
                $coupon->save();
            }
            Session::forget('id_coupon');
        }
        

        //insert thông tin nhận hàng
        $data=[];
        $data['name']=$req->name;
        $data['email']=$req->email;
        $data['phone']=$req->phone;
        $data['address']=$req->address;
        $data['notes']=$req->notes;
        $data['pay_method']=$req->pay;
        $shipping_id=DB::table('shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id);

        // $data=[];
        // $data['method']=$req->pay;
        // $data['status']="Đang chờ xử lý";
        // $payment_id=DB::table('payment')->insertGetId($data);

        //insert đơn hàng
        $data=[];
        $data['customer_id']=Session::get('user_id');
        $data['shipping_id']=Session::get('shipping_id');
        $data['payment']=$req->pay;
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
            //Cập nhật lại số lượng sản phẩm
            $count=DB::table('product')->where('id',$data['product_id'])->value('count');
            //echo $data['product_quantyti'];
            $new_count=$count-$data['product_quantyti'];
            DB::table('product')->where('id',$data['product_id'])->update(['count'=>$new_count]);
        }
        
        //Cart::clear();
        //return view('page.checkout.payment_done');
    }
    public function list_order()
    {
        $data=DB::table('order')->join('user','order.customer_id','=','user.id')->select('order.*','user.name')->orderby('order.id','desc')->get();
        return view('admin.order.list',['data'=>$data]);
    }
    public function detail_order($orderId)
    {
        
        $order=Order::where('id',$orderId)->get();

        foreach ($order as $item) {
            $order_status=$item->status;
        }

        $user_id=DB::table('order')->where('id',$orderId)->value('customer_id');
        $info_user=DB::table('user')->where('id',$user_id)->get();

        $shipping_id=DB::table('order')->where('id',$orderId)->value('shipping_id');
        $info_shipping=DB::table('shipping')->where('id',$shipping_id)->get();

        $info_product=OrderDetails::with('product')->where('order_id',$orderId)->get();
        //return view('admin.order.detail',['info_user'=>$info_user,'info_shipping'=>$info_shipping,'info_product'=>$info_product,'order'=>$order]);
        return view('admin.order.detail')->with(compact('info_user','info_shipping','info_product','order','order_status'));
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
    public function update_status_of_product(Request $req)
    {
        //cập nhật trạng thái đơn hàng
        $data=$req->all();
        $order=Order::find($data['order_id']);
        $order->status=$data['order_status'];
        $order->save();
        if($data['order_status']=="Đã xử lý" || $data['order_status']=="Đã thanh toán-chờ nhận hàng" ){
            for($i=0;$i<count($data['order_product_id']);$i++){
                $product=Product::find($data['order_product_id'][$i]);
                //$product->count=$product->count-$data['quantity'][$i];
                $product->count_sold=$product->count_sold+$data['quantity'][$i];
                $product->save();
            }
        }
        elseif ($data['order_status']=="Đơn đã hủy") {
            for($i=0;$i<count($data['order_product_id']);$i++){
                $product=Product::find($data['order_product_id'][$i]);
                $product->count=$product->count+$data['quantity'][$i];
                //$product->count_sold=$product->count_sold-$data['quantity'][$i];
                $product->save();
            }
            if(Session::has('id_coupon')){
                $coupon=Coupon::find(Session::get('id_coupon'));
                $coupon->amount=$coupon->amount+1;
                $coupon->save();
            }
        }
        else{
            for($i=0;$i<count($data['order_product_id']);$i++){
                $product=Product::find($data['order_product_id'][$i]);
                $product->count=$product->count-$data['quantity'][$i];
                //$product->count_sold=$product->count_sold+$data['quantity'][$i];
                $product->save();
            }
        }
    }
    public function delete_product_in_order($id)
    {
        $product = OrderDetails::find($id);
        $product->delete();
        return redirect()->back();
    }
    public function update_qty_product_in_order(Request $req)
    {
        $data=$req->all();
        $product_in_order=OrderDetails::find($data['id_detail']);
        $product_in_order->product_quantyti=$data['order_product_qty'];
        $product_in_order->save();
    }
    public function my_order(Request $req)
    {

        $data= Order::where('customer_id',Session::get('user_id'))->orderBy('id','DESC')->paginate(5);
        return view('page.order.history')->with(compact('data'));
    }
    public function detail_my_order($id)
    {

        $shipping_id=DB::table('order')->where('id',$id)->value('shipping_id');
        $info_shipping=DB::table('shipping')->where('id',$shipping_id)->get();

        $info_product=OrderDetails::with('product')->where('order_id',$id)->get();
        //return view('admin.order.detail',['info_user'=>$info_user,'info_shipping'=>$info_shipping,'info_product'=>$info_product,'order'=>$order]);
        return view('page.order.detail_my_order')->with(compact('info_shipping','info_product'));
    }
    public function customer_cancel_order(Request $req)
    {
        $order=Order::where('id',$req->order_id)->first();
        $order->reason=$req->reason_cancel_order;
        $order->status="Đơn đã hủy";
        $order->save();

        //Cập nhật lại số lượng sản phẩm
        $product=OrderDetails::where('order_id',$req->order_id)->get();
        foreach ($product as $key => $value) {
            $product_cancel=DB::table('product')->where('id',$value->product_id)->first();
            $product_cancel->count=$product_cancel->count+$value->product_quantyti;
            DB::table('product')->where('id',$value->product_id)->update(['count' => $product_cancel->count]);
        }
    }
}
