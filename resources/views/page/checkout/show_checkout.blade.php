@extends("welcome")
@section("content")
<section id="cart_items">
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
								<p>{{number_format($item['price'])}}</p>
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
                        <form action="{{route('order_place')}}" method="post">
							@csrf
                            @foreach($info as $item)
                            <ul>
                                <label for="name">Tên khách hàng</label>
                                <input type="text" name="name" id="name" value="{{$item->name}}"><br><br>
                                <label for="phone">Số điện thoại</label>
                                <input type="text" name="phone" id="phone" value="{{$item->phone}}"><br><br>
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" value="{{$item->email}}"><br><br>
                                <textarea name="address" placeholder="Địa chỉ..."></textarea><br><br>
                                <textarea name="notes" rows="11" placeholder="Lưu ý khác..."></textarea><br><br>
                                <p>Tổng tiền: 
                                    <?php
                                        $total=Cart::total()+0.1*Cart::total();
                                        echo number_format($total).' '.'VND (Đã bao gồm 10% thuế VAT)';
                                    ?>
                                </p>
								<p>Chọn phương thức thanh toán</p>
								<input type="radio" id="atm" name="pay" value="atm">
								<label for="atm"> ATM</label><br>
								<input type="radio" id="cash" name="pay" value="cash">
								<label for="cash"> Tiền mặt</label><br>
								<input type="radio" id="momo" name="pay" value="momo">
								<label for="momo"> Momo QR</label><br>
                            </ul>  
                            @endforeach
                            <input type="submit" value="Thanh toán ngay" class="btn btn-primary">
                        </form>	
					</div>
				</div>              	
			</div>
		</div>
	</section><!--/#do_action-->


@stop