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
use Mail;

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
            $coupon_used=Coupon::where('id',Session::get('id_coupon'))->value('used');
            $amount_coupon=Coupon::where('id',Session::get('id_coupon'))->value('amount');
            //$id_user_used=$id_user_used.','.Session::get('user_id');
            if($coupon_used<$amount_coupon){
                $coupon_used=$coupon_used+1;
                $coupon=Coupon::find(Session::get('id_coupon'));
                $coupon->used=$coupon_used;
                $coupon->id_user_used=$coupon->id_user_used.','.Session::get('user_id');
                $coupon->save();
            }
            //Session::forget('id_coupon');
        }
        
        //insert thông tin nhận hàng
        $data_shipping=[];
        $data_shipping['name']=$req->name;
        $data_shipping['email']=$req->email;
        $data_shipping['phone']=$req->phone;
        $data_shipping['address']=$req->address_re;
        $data_shipping['notes']=$req->notes;
        $data_shipping['pay_method']=$req->pay;
        $shipping_id=DB::table('shipping')->insertGetId($data_shipping);
        Session::put('shipping_id',$shipping_id);

        //insert đơn hàng
        $data_order=[];
        
        $data_order['order_code']=$req->order_code;
        $data_order['customer_id']=Session::get('user_id');
        $data_order['shipping_id']=Session::get('shipping_id');
        $data_order['payment']=$req->pay;
        $data_order['total_money']=Cart::total();
        if(Session::has('discount')){
            $data_order['discount']=Session::get('discount');
        }else{
            $data_order['discount']=0;
        }
        $data_order['status']="Đang chờ xử lý";
        $order_id=DB::table('order')->insertGetId($data_order);
        $order_code=$req->order_code;

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

        //send mail to customer
        Session::put('dmm',$req->email);
        Mail::send('emails.confirm_checkout',compact('data_shipping','data_order','content','order_id','order_code'),function ($email)
        {           
            $email->from('noreply@gmail.com', 'Công ty TNHH thực phẩm sạch Thiên An Phú');
            $email->to(Session::get('dmm'),Session::get('name_user'))->subject('Đơn hàng của bạn!');
        });
        //Cart::clear();
        //return view('page.checkout.payment_done');
        Session::forget('discount');
        Session::forget('id_coupon');
        Cart::clear();
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
            return redirect('admin/danh-sach-don-hang');
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
            $order->reason="Admin hủy";
        }
        else{
            for($i=0;$i<count($data['order_product_id']);$i++){
                $product=Product::find($data['order_product_id'][$i]);
                $product->count=$product->count-$data['quantity'][$i];
                //$product->count_sold=$product->count_sold+$data['quantity'][$i];
                $product->save();
            }
        }
        $order->save();
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
        $order_id=$id;

        $discount=Order::where('id',$id)->value('discount');

        $shipping_id=DB::table('order')->where('id',$id)->value('shipping_id');
        $info_shipping=DB::table('shipping')->where('id',$shipping_id)->get();

        $info_product=OrderDetails::with('product')->where('order_id',$id)->get();
        //return view('admin.order.detail',['info_user'=>$info_user,'info_shipping'=>$info_shipping,'info_product'=>$info_product,'order'=>$order]);
        return view('page.order.detail_my_order')->with(compact('info_shipping','info_product','discount','order_id'));
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
    public function search_in_order(Request $request)
    {
        $key_search=$request->key;
        $order=Order::where('payment','LIKE','%'.$key_search.'%')->orWhere('status','LIKE','%'.$key_search.'%')
        ->orWhere('reason','LIKE','%'.$key_search.'%')->orWhere('order_code','LIKE','%'.$key_search.'%')->get();
        return view('admin.order.search_with_keyword',compact('order'));
    }
    public function down_price_order(Request $request)
    {   
        $order=Order::orderBy('total_money','desc')->get();
        return view('admin.order.search_down_price',compact('order'));
    }
    public function up_price_order(Request $request)
    {       
        $order=Order::orderBy('total_money','asc')->get();
        return view('admin.order.search_up_price',compact('order'));
    }
    public function search_with_status($status)
    {
        if($status=='dang-cho-xu-ly'){
            $order=Order::where('status','Đang chờ xử lý')->get();
        }
        else if($status=='da-xu-ly'){
            $order=Order::where('status','Đã xử lý')->get();
        }
        else if($status=='da-thanh-toan-cho-nhan-hang'){
            $order=Order::where('status','Đã thanh toán-chờ nhận hàng')->get();
        }
        else{
            $order=Order::where('status','Đơn đã hủy')->get();
        }
        return view('admin.order.search_with_status',compact('order'));
    }
}
