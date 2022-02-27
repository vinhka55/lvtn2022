@extends("welcome")
@section("content")
<div class="container">
<div class="product-details"><!--product-details-->
    @foreach($product as $item)					
        <div class="col-sm-5">
            <div class="view-product">
                <img src="{{url('/')}}/public/uploads/product/{{$item->image}}" alt="image" width="50%"/>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->	
                    <span>
                        <form action="{{route('shopping_cart')}}" method="POST">
                            {{ csrf_field() }}
                            <h3>{{$item->name}}</h3>
                            <p>Xuất xứ: {{$item->origin}}</p>
                            <p>Đã bán: {{$item->count_sold}}</p>
                            <p>{{$item->note}}</p>
                            <p>Hạn sử dụng: {{$item->exp}}</p>
                            <p>Giá: {{number_format($item->price)}}VND</p>
                            
                            <label>Số lượng:</label>
                            <input type="number" name="quantity" value="1" min="1" />
                            <input type="hidden" name="id" value="{{$item->id}}"/>
                            <input type="hidden" name="name" value="{{$item->name}}"/>
                            <input type="hidden" name="price" value="{{$item->price}}"/>
                            <input type="hidden" name="image" value="{{$item->image}}"/>
                            <br>                           
                            <button type="submit" class="btn btn-info">										
                                Mua ngay
                            </button>
                            <button type="submit" class="btn btn-warning">
                                <i class="fa fa-shopping-cart"></i>
                                Thêm vào giỏ hàng
                            </button>	
                        </form>			
                    </span>			
            </div><!--/product-information-->
        </div>
    @endforeach
</div><!--/product-details-->
<div class="relation-product">
    <h3>Sản phẩm liên quan</h3>
</div>
</div>
@stop