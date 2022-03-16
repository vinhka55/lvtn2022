@extends("welcome")
@section("content")
<section id="cart_items" style="margin-top:80px;">
		<div class="container mt-5">			
			<div class="table-responsive cart_info">
				<form action="{{route('update_cart')}}" method="post">
					@csrf
					<?php 
						$content=Cart::items()->original;
					?>
					@if(count($content)>0)
					<table class="table table-condensed">
						<thead>
							<tr class="cart_menu">
								<td class="image text-center">Ảnh</td>
								<td class="name text-center">Tên sản phẩm</td>
								<td class="price text-center">Giá</td>
								<td class="quantity text-center">Số lượng</td>
								<td class="total text-center">Thành tiền</td>
								<td class="text-center">Action</td>
							</tr>
						</thead>				
						<tbody>
							
							@foreach($content as $item)																						
							<tr>
								<td class="image text-center" width="20%">
									<a href=""><img width="80%" src="{{url('/')}}/public/uploads/product/{{$item['thumb']}}" alt="ảnh lỗi"></a>
								</td>
								<td class="name text-center">
									<h4><a href="">{{$item['name']}}</a></h4>								
								</td>
								<td class="price text-center">
									<p>{{number_format($item['price'])}}</p>
								</td>
								<td class="quantity ">
									<div class="cart_quantity_button">
										
											
											<input class="cart_quantity_input" type="number" name="quantity[{{$item['uid']}}]" value="{{$item['qty']}}" min="1">
											<input type="hidden" name="uid[{{$item['uid']}}]" value="{{$item['uid']}}">
									</div>
								</td>
								<td class="cart_total text-center">
									<p class="cart_total_price">
										<?php
											$subtotal=$item['qty']*$item['price'];
											echo number_format($subtotal).' '.'VND';
										?>
									</p>
								</td>
								<td class="delete text-center">
									<a class="cart_quantity_delete" href="{{route('delete_product_in_cart',$item['uid'])}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
								</td>
							</tr> 						
							@endforeach					                     
						</tbody>
					</table>
					<div class="flex m-2">
						<button type='submit' class='btn btn-primary'>Cập nhật giỏ hàng</button>
						<a href="{{route('delete-all-product-in-cart')}}" class="btn btn-primary">Xóa tất cả</a>
					</div>	
				</form>			
			</div>
		</div>
	</section> <!--/#cart_items-->

	<!-- form coupon -->
	<section id="coupon">
		<div class="container">
			<form action="{{route('discount')}}" method="post">
				{{ csrf_field() }}
				<p class="text-danger">{{Session::get('error')}}</p>
				@if(Session::has('incorrect_coupon'))
					<p class="text-danger">{{Session::get('incorrect_coupon')}}</p>
					{{Session::put('incorrect_coupon',null)}}
				@endif
				<input type="text" name="code_coupon" class="form-control w-25" placeholder="Mã giảm giá" >
				<input type="submit" value="Áp dụng" class="btn btn-info">
			</form>
		</div>
	</section>
	<!-- end form coupom -->

    <section id="do_action">
		<div class="container mt-3">	
			<div class="row">				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Thành tiền <span>{{number_format(Cart::total())}}</span></li>
							<li>Thuế <span>
								<?php 
									$tax= 0.1*Cart::total();
									echo number_format($tax);
								?>
							</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<!--  -->
							@if($coupon)
							<li>Giảm giá <span>
							@foreach($coupon as $item)								
								@if($item->condition=='percent')
								<?php 
								$discount= $item->rate*(Cart::total()+$tax)/100;
								echo number_format($discount);
								Session::put('discount',$discount);							
								?>
								@else
								<?php 
								$discount= $item->rate;
								echo number_format($discount);	
								Session::put('discount',$discount);							
								?>
								@endif
							@endforeach
							</span></li>
							@else
								<?php $discount=0;
								Session::put('discount',0);
								?>
								
							@endif
							<li>Tổng tiền <span>
								<?php
									$total=Cart::total()+$tax-$discount;
									echo number_format($total);
							 	?></span>
							</li>
						</ul>
						<?php 
							if(Session::get('user_id')){
								?>
							<a class="btn btn-default check_out" href="{{route('pay_product')}}">Thanh toán</a>   
							<?php }
							else { ?>
							<a class="btn btn-default check_out" href="{{route('login')}}">Thanh toán</a>
						<?php } ?>
							
					</div>
				</div>
			</div>
		</div>
	</section>
	@else
		<?php echo "<h3 class='text-center'>Không có sản phẩm nào trong giỏ hàng</h3>"; ?>
		<?php Session::forget('id_coupon'); ?>
	@endif
@stop