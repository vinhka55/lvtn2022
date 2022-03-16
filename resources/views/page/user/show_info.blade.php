@extends("welcome")
@section("content")
<body class="personal-page" style="margin-top:50px;">
<div class="contaier-fluid">
    <div class="row py-5 px-4">
    @foreach($info as $item)
        <div class="col-md-5 mx-auto">
            <!-- Profile widget -->
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 cover" style="text-align:center;">
                    <div class="media align-items-end profile-head" style="display:inline-block;padding-top:10px">
                        <div class="profile mr-3">
                            <img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=80" alt="..." width="130" class="rounded mb-2 img-thumbnail">
                        </div>
                        <div class="media-body mb-5 text-white">
                            <h4 class="mt-0 mb-0">{{$item->name}}</h4>
                            <p class="small mb-4"> <i class="fas fa-map-marker-alt mr-2"></i>Sài Gòn</p>
                        </div>
                    </div>
                </div>
                <div class="px-4" style="text-align:center;">
                    <h5 class="mb-0 text-center">Thông tin</h5>
                    <div class="p-4 rounded shadow-sm bg-light" style="display:inline-block;">
                        <p class="font-italic mb-0">Số điện thoại: <b>{{$item->name}}</b></p>
                        <p class="font-italic mb-0">Số điện thoại: <b>{{$item->phone}}</b></p>
                        <p class="font-italic mb-0">Email: <b>{{$item->email}}</b></p>
                    </div>
                </div>
                <a href="#" class="btn btn-outline-dark btn-sm btn-block">Edit profile</a>
                <div class="py-4 px-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">Sản phẩm đã mua gần đây</h5><a href="{{route('my_order')}}" class="btn btn-link text-muted">Xem tất cả</a>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-2 pr-lg-1"><img src="https://images.unsplash.com/photo-1469594292607-7bd90f8d3ba4?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="" class="img-fluid rounded shadow-sm"></div>
                        <div class="col-lg-6 mb-2 pl-lg-1"><img src="https://images.unsplash.com/photo-1493571716545-b559a19edd14?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="" class="img-fluid rounded shadow-sm"></div>
                        <div class="col-lg-6 pr-lg-1 mb-2"><img src="https://images.unsplash.com/photo-1453791052107-5c843da62d97?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="" class="img-fluid rounded shadow-sm"></div>
                        <div class="col-lg-6 pl-lg-1"><img src="https://images.unsplash.com/photo-1475724017904-b712052c192a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="" class="img-fluid rounded shadow-sm"></div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</body>
@endsection