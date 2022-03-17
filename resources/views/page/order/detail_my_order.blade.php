@extends("welcome")
@section("content")
<!-- Thông tin người đặt hàng -->
<div class="container" style="margin-top:80px;">
    <div class="table-agile-info">
        <a href="{{url()->previous()}}"><i class="fa fa-arrow-left" aria-hidden="true"></i>Quay lại</a>
    </div>
</div>
<!-- Thông tin giao hàng -->
<div class="container">
    <div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading h3">
        Thông tin giao hàng
        </div>
        <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
            <tr>

                <th>Tên khách hàng</td>
                <th>Số điện thoại</th>
                <th>Email</th>      
                <th>Địa chỉ</th>
                <th>Cách thanh toán</th>      
                <th>Ghi chú</th>           
            </tr>
            </thead>
            <tbody>                    
                        @foreach($info_shipping as $item)
                        <tr>
                            
                            <td><p class="text-ellipsis name">{{$item->name}}</p></td>
                            <td><p class="text-ellipsis name">{{$item->phone}}</p></td>
                            <td><p class="text-ellipsis name">{{$item->email}}</p></td> 
                            <td><p class="text-ellipsis name">{{$item->address}}</p></td>
                            <td><p class="text-ellipsis name">{{$item->pay_method}}</p></td>
                            <td><p class="text-ellipsis name">{{$item->notes}}</p></td>                                              
                        </tr>
                        @endforeach    
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>

<!-- Chi tiết sản phẩm -->
<div class="container">
    <div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading h3">
        Chi tiết sản phẩm
        </div>
        <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
            <tr>

                <th>Tên sản phẩm</td>
                <th>Giá</th>
                <th>Số lượng</th>  
                <th>Tổng tiền</th>   
            </tr>
            </thead>
            <tbody>     
                        <?php $total_money=0; ?>            
                        @foreach($info_product as $item)
                        
                        <tr>                            
                            <td><p class="text-ellipsis name">{{$item->product_name}}</p></td>
                            <td><p class="text-ellipsis name">{{number_format($item->product_price)}}</p></td>                     
                            <td>      
                                <input type="number" disabled class="order_product_qty_{{$item->id}}" name="product_sales_quantity" value="{{$item->product_quantyti}}">      
                            </td>
                            <td><?php echo number_format($item->product_price*$item->product_quantyti).' VND'; ?></td>                             
                            <?php $total_money=$total_money+$item->product_price*$item->product_quantyti;?>                
                        </tr>
                        @endforeach
                        
            </tbody>
        </table>
        
        <br>
        </div>
        <?php echo "Tổng tiền: ".number_format($total_money).' VND' ; ?>
        <br>
        <?php echo "Thuế VAT 10%: ".number_format($total_money*10/100).' VND' ; ?>
        <br>
        <p>Giảm giá: <?php echo number_format($discount).' VND'; ?></p>
        <br>
        <?php echo "Số tiền cần thanh toán: ".number_format($total_money+$total_money*10/100-$discount).' VND' ;
        ?>
    </div>
    </div>
    <a href="{{url('/')}}/in-don-hang/<?php echo $order_id; ?>" class="btn btn-info">In đơn hàng</a>
</div>
@stop