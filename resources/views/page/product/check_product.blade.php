@extends("welcome")
@section("content")
@include("page.header.header")
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v13.0" nonce="HPaXPNLU"></script>
<div class="container-fluid p-2">
    <div class="product-details row p-0 m-0">
        <!--product-details-->
        @foreach($product as $item)
        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{route('show_product_with_category',$item->category->slug)}}">{{$item->category->name}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$item->name}}</li>
            </ol>
        </nav>
        <div class="col-12 col-md-5">
            <div class="view-product">
                <ul id="lightSlider">
                    <li data-thumb="{{url('/')}}/public/uploads/product/{{$item->image}}">
                        <img src="{{url('/')}}/public/uploads/product/{{$item->image}}" width="100%"/>
                    </li>
                    @foreach($gallerys as $gallery)
                    <li data-thumb="{{url('/')}}/public/uploads/gallery/{{$gallery->image}}">               
                        <img src="{{url('/')}}/public/uploads/gallery/{{$gallery->image}}" width="100%"/>               
                    </li>
                    @endforeach        
                </ul>
            </div>

        </div>
        <div class="col-12 col-md-7">
            <div class="product-information">
                <!--/product-information-->
                <span>
                    <form action="{{route('shopping_cart')}}" method="POST">
                        {{ csrf_field() }}
                        <h3 class="p-2 m-0 bg-success text-white">{{$item->name}}</h3>
                        <p>Xuất xứ: {{$item->origin}}</p>
                        <p>Đã bán: {{$item->count_sold}}</p>
                        <p>{{$item->note}}</p>
                        <p>Hạn sử dụng: <?php echo date("d/m/Y", strtotime($item->exp)); ?></p>
                        <p>Giá: {{number_format($item->price)}} VND</p>

                        <label>Số lượng:</label>
                        <input width="50%" type="number" name="quantity" value="1" min="1" max="{{$item->count}}"
                            size="2" />
                        <input type="hidden" name="id" id="id-product-hidden" value="{{$item->id}}" />
                        <input type="hidden" name="name" value="{{$item->name}}" />
                        <input type="hidden" name="price" value="{{$item->price}}" />
                        <input type="hidden" name="image" value="{{$item->image}}" />
                        <br>
                        <button type="submit" class="btn btn-info">
                            Mua ngay
                        </button>
                        <!-- add to cart by ajax -->
                        <form>
                            @csrf
                            <input type="hidden" value="{{$item->id}}" class="cart_product_id_{{$item->id}}">
                            <input type="hidden" value="{{$item->name}}" class="cart_product_name_{{$item->id}}">
                            <input type="hidden" value="{{$item->image}}" class="cart_product_image_{{$item->id}}">
                            <input type="hidden" value="{{$item->price}}" class="cart_product_price_{{$item->id}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$item->id}}">
                            <button type="button" name="add-to-cart" class="btn btn-primary add-to-cart"
                                data-id_product="{{$item->id}}"><i class="fa fa-shopping-cart"></i>Thêm giỏ
                                hàng</button>
                        </form>
                        <!-- end add to cart by ajax -->
                    </form>
                    <br>
                    <div class="handle-social">
                        <div class="fb-like" data-href="{{url()->current()}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div>
                        <div class="fb-share-button" data-href="{{url()->current()}}" data-layout="button_count" data-size="small">
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
                                Chia sẻ
                            </a>
                        </div>
                    </div>
                </span>
            </div>
            <!--/product-information-->
        </div>
    </div>
</div>
<div class="row d-inline">
    <div class="col-6">
        <div class="list-group d-flex" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list"
                href="#list-home" role="tab" aria-controls="list-home">Mô tả</a>
            <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list"
                href="#list-profile" role="tab" aria-controls="list-profile">Bình luận</a>
        </div>
    </div>
    <div class="col-12">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active text-center" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                <div class="text-center">
                    <?php echo htmlspecialchars_decode($item->description); ?>
                </div>
            </div>
            <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                <!-- start comment -->
                @if(Session::get("user_id")!=null)
                <div class="d-flex flex-start mt-3 ms-5">
                    <input type="hidden" id="product_id" name="product_id" value="{{$item->id}}">
                    <input type="hidden" id="user_id_hidden" value="{{Session::get('user_id')}}">
                    <img class="rounded-circle shadow-1-strong me-3"
                        src="{{url('/')}}/public/uploads/avatar/{{$my_avatar}}" alt="avatar" width="65"
                        height="65" />
                    <div class="flex-grow-1 flex-shrink-1">
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-1 text-primary">
                                    @ {{Session::get('name_user')}}
                                </p>
                            </div>
                            
                            <input class="rounded-pill w-90" type="text" id="your_comment" placeholder="Điền bình luận của bạn">
                            <button type="button" class="btn btn-primary send-comment">Gửi</button>
                            <p class="text-danger" id="empty_comment"></p>                       
                        </div>
                        <!-- end comment -->
                    </div>
                </div>
                @else
                <h3 class="text-center text-danger">Đăng nhập để bình luận</h3>
                @endif
                <div class="show-comment row">
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@stop
