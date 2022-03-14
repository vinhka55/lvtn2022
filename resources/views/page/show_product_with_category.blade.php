@extends("welcome")
@section("content")
<div class="container-fluid">
    <div class="row mt-5 mx-0 px-3">
        <div class="col-12 col-md-8">
            <h1 class="bg-success text-white m-0 p-3 mb-3">{{$name}}</h1>
            <div class="row m-0 p-0">
                @foreach($product as $item)
                    <div class="col-12 col-md-3 my-3">
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