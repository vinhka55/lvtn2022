@extends("welcome")
@section("content")
<section id="cart_items">
		<div class="container mt-5">			
			<div class="table-responsive cart_info">
				<?php 
					$content=Cart::items()->original;
				?>
				@if(count($content)>0)
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image text-center">Ảnh</td>
							<td class="name">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Thành tiền</td>
							<td>Action</td>
						</tr>
					</thead>				
					<tbody>
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
									<form action="{{route('update_cart',$item['uid'])}}" method="post">
										@csrf
										<input class="cart_quantity_input" type="number" name="quantity" value="{{$item['qty']}}" autocomplete="off" size="2">
										<input type="submit" value="update" class="btn btn-default">
										<input type="hidden" value="{{$item['uid']}}" name='uid'>
									</form>
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
							<td class="delete">
								<a class="cart_quantity_delete" href="{{route('delete_product_in_cart',$item['uid'])}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
							</td>
						</tr> 						
						@endforeach					                     
					</tbody>
				</table>
				<div class="flex m-2">
				<a href="" class="btn btn-primary">Cập nhật giỏ hàng</a>
				<a href="{{route('delete-all-product-in-cart')}}" class="btn btn-primary">Xóa tất cả</a>
				</div>				
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
								?>
								@else
								<?php 
								$discount= $item->rate;
								echo number_format($discount);								
								?>
								@endif
							@endforeach
							</span></li>
							@else
								<?php $discount=0; ?>
								
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
	@endif
@stop