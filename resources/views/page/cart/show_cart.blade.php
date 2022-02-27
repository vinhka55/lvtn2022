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
							// echo "<pre>";
							// var_dump($content);
							// echo "</pre>";
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
								<a class="cart_quantity_delete" href="{{route('delete_product_in_cart',$item['uid'])}}"><i class="fa fa-times"></i></a>
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
						<ul>
							<li>Thành tiền <span>{{number_format(Cart::total())}}</span></li>
							<li>Thuế <span>
								<?php 
									$tax= 0.1*Cart::total();
									echo number_format($tax);
								?>
							</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Tổng tiền <span>
								<?php
									$total=Cart::total()+$tax;
									echo number_format($total);
							 	?></span></li>
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
	</section><!--/#do_action-->
@stop