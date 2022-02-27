@extends("welcome")
@section("content")
<div class="container">
    <div class="row mt-5">
        <div class="col-8">
            <h2 class="title-category-product">{{$name}}</h2>
            <div class="row">
                @foreach($product as $item)
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <a href=""><img src="{{url('/')}}/public/uploads/product/{{$item->image}}" class="card-img-top" alt="product"></a>
                            <div class="card-body">
                            <h3 class="card-text name-product">{{$item->name}}</h3>
                            <p class="price-product">Giá: {{$item->price}}</p>
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