@extends("welcome")
@section("content")
<section id="cart_items" style="margin-top:80px;">
		<div class="container mt-5">			
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image text-center">Ảnh</td>
							<td class="name">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Thành tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php 
							$content=Cart::items()->original;
						?>
						@foreach($content as $item)																						
						<tr>
							<td class="image" width="20%">
								<a href=""><img width="80%" src="{{url('/')}}/public/uploads/product/{{$item['thumb']}}" alt="ảnh lỗi"></a>
							</td>
							<td class="name">
								<h4><a href="">{{$item['name']}}</a></h4>								
							</td>
							<td class="price">
								<p>{{number_format($item['price'])}} VND</p>
							</td>
							<td class="quantity">
								<div class="cart_quantity_button">
									
									<input disabled class="cart_quantity_input" type="number" name="quantity" value="{{$item['qty']}}" autocomplete="off" size="2">
										
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									<?php
										$subtotal=$item['qty']*$item['price'];
										echo number_format($subtotal).' '.'VND';
									?>
								</p>
							</td>
							
						</tr> 						
						@endforeach                     
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

    <section id="do_action">
		<div class="container">	
			<div class="row">	            
				<div class="col-sm-6">
					<div class="total_area">
                        <!-- <form action="{{route('order_place')}}" method="post"> -->
							<!-- @csrf -->
                            @foreach($info as $item)
                            <ul>
                                <label for="name">Tên khách hàng</label><br>
                                <input type="text" name="name" id="name" value="{{$item->name}}"><br>
								<p><small id="error-name-null" class="text-danger"></small></p>
                                <label for="phone">Số điện thoại</label><br>
                                <input type="text" name="phone" id="phone" value="{{$item->phone}}"><br>
								<p><small id="error-phone-null" class="text-danger"></small></p>
                                <label for="email">Email</label><br>
                                <input type="text" name="email" id="email" value="{{$item->email}}"><br>
								<p><small id="error-email-null" class="text-danger"></small></p>
                                <textarea id="address-re" name="address_re" placeholder="Địa chỉ..."></textarea><br>
								<p><small id="error-address-null" class="text-danger"></small></p>
                                <textarea id="notes" name="notes" rows="11" placeholder="Lưu ý khác..."></textarea><br><br>
                                <p>Tổng tiền: 
                                    <?php
                                        $total=Cart::total()+0.1*Cart::total()-Session::get('discount');
                                        echo number_format($total).' '.'VND (Đã bao gồm 10% thuế VAT và khấu trừ khuyễn mãi nếu có)';
                                    ?>
                                </p>
								<p>Chọn phương thức thanh toán</p>
								<form id="pay_online_method">
									<input type="radio" id="cash" name="pay" value="cash">
									<label for="cash"> Tiền mặt</label><br>
									<input type="radio" id="atm" name="pay" value="atm">
									<label for="atm"> ATM</label><br>
									<?php
										//đoạn code tạo unique mã đơn hàng lấy trên mạng
										$stamp = strtotime("now");
										$order_code = 'order_'.$stamp;
									?>	 
									<input type="hidden" value="{{$order_code}}" id="order_code">							 
								</form>			
								<p><small id="error-pay-null" class="text-danger"></small></p>			
                            </ul>  
                            @endforeach
                            
							<div class="nut-thanh-toan" style="display:flex;">
								<!-- Thanh toán bình thường -->
								<button class="btn btn-primary checkout-now">Thanh toán ngay</button>
								<!-- Thanh toán momo -->
								<form method="post" action="{{route('momo')}}">									
									@csrf
									<input type="hidden" name="total_money" value="{{$total}}">								
									<button type="submit" name="payUrl" class="button-momo ">Thanh toán Momo</button>
								</form>
							</div>
					</div>
				</div>              	
			</div>
		</div>
	</section><!--/#do_action-->
@stop