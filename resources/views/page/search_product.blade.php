@extends("welcome")
@section("content")
<div class="container-fluid">
    <h3 class="bg-success text-white m-0 p-3 mb-3">Kết quả tìm kiếm sản phẩm</h3>
    <div class="row p-0 m-0">
        @foreach($data as $item)
        <div class="col-12 col-md-4 my-3">
            <div class="card">
                <a href="{{route('detail_product',$item->id)}}"><img width="100%" src="{{url('/')}}/public/uploads/product/{{$item->image}}" alt="error"></a>
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
@stop