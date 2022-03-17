@extends("welcome")
@section("content")
<div class="container-fluid body-content">
    <div class="row m-0 p-0 mt-5 pt-5">
        <div class="col-12 col-md-8 p-2">
            <h2 class="title-category-product p-2 bg-success text-white m-0">{{$name}}</h2>
            <div class="row m-0 p-2">
                @foreach($product as $item)
                    <div class="col-12 col-md-3">
                        <div class="card">
                            <a href="{{route('detail_product',$item->id)}}"><img src="{{url('/')}}/public/uploads/product/{{$item->image}}" class="card-img-top" alt="product"></a>
                            <div class="card-body">
                            <h3 class="card-text name-product">{{$item->name}}</h3>
                            <p class="price-product">Giá: {{number_format($item->price)}}</p>
                            <a href="{{route('detail_product',$item->id)}}">Chi tiết</a>
                            </div>
                        </div>
                    </div>                
                @endforeach
            </div>
        </div>
    </div>
</div>
@stop