@extends("welcome")
@section("content")
@include("page.header.header")
<div class="container-fluid p-3">
<div class="content-page">  
        <div class="body-content">
            <!-- sản phẩm hot -->
            <div class="hot-product product row m-0 p-0 m-0 p-0">
                <h1 class="title-hot-product p-2 m-0 bg-success text-white">SẢN PHẨM HOT</h1>
                <div class="test-reponsive">
                @foreach($hot_product as $hot_pro)
                <div class="col-12 col-md-2 my-2 ok">
                    <div class="card">
                        <a href="{{route('detail_product',$hot_pro->id)}}"><img height="220px" src="{{url('/')}}/public/uploads/product/{{$hot_pro->image}}" alt="error" width="100%"></a>
                        <div class="card-body">
                          <h3 class="card-text name-product">{{$hot_pro->name}}</h3>
                          <p class="price-product">{{number_format($hot_pro->price)}} VND</p>
                          <a href="{{route('detail_product',$hot_pro->id)}}">Chi tiết</a>
                          <!-- icon eyes trigger modal -->                         
                            <i type="button" class="fas fa-eye ms-3" data-bs-toggle="modal" data-bs-target="#quickview-{{$hot_pro->id}}"></i>
                            <!-- Modal -->
                            <div class="modal fade" id="quickview-{{$hot_pro->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog container">
                                    <div class="modal-content">
                                        <img width="100%" src="{{url('/')}}/public/uploads/product/{{$hot_pro->image}}" alt="hot product">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tên sản phẩm: {{$hot_pro->name}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Giá: <?php echo number_format($hot_pro->price) ?> VND
                                        </div>
                                        <div class="modal-body">
                                            Xuất xứ: {{$hot_pro->origin}}
                                        </div>
                                        <div class="modal-body">
                                            Hạn dùng: {{ \Carbon\Carbon::parse($hot_pro->exp)->format('d/m/Y')}}
                                        </div>
                                        <div class="modal-body">
                                            Đã bán: {{$hot_pro->count_sold}}
                                        </div>  
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"><a class="text-white" href="{{route('detail_product',$hot_pro->id)}}">Xem nhiều hơn</a></button>
                                        </div>     
                                    </div>                                                                                              
                                </div>
                            </div>
                          <!-- add to cart by ajax -->
                          <form>
                                @csrf
                                <input type="hidden" value="{{$hot_pro->id}}" class="cart_product_id_{{$hot_pro->id}}">
                                <input type="hidden" value="{{$hot_pro->name}}" class="cart_product_name_{{$hot_pro->id}}">
                                <input type="hidden" value="{{$hot_pro->image}}" class="cart_product_image_{{$hot_pro->id}}">
                                <input type="hidden" value="{{$hot_pro->price}}" class="cart_product_price_{{$hot_pro->id}}">
                                <input type="hidden" value="1" class="cart_product_qty_{{$hot_pro->id}}">
                                <button type="button" name="add-to-cart" class="btn btn-primary add-to-cart" data-id_product="{{$hot_pro->id}}"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                            </form>
                            <!-- end add to cart by ajax -->
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
            <!-- thịt gà đông lạnh -->
            
                <div class="cool-chicken product row m-0 p-0 m-0 p-0">
                    <h1 class="title-hot-product p-2 m-0 bg-success text-white">THỊT GÀ ĐÔNG LẠNH</h1>    
                    <div class="test-reponsive">                    
                    @foreach($ga_dong_lanh as $ga1)
                    <div class="col-12 col-md-2 my-2 ok">                                              
                        <div class="card">
                            <a href="{{route('detail_product',$ga1->id)}}"><img height="220px" src="{{url('/')}}/public/uploads/product/{{$ga1->image}}" alt="error" width="100%"></a>
                            <div class="card-body">
                            <h3 class="card-text name-product">{{$ga1->name}}</h3>
                            <p class="price-product">Giá: {{number_format($ga1->price)}} VND</p>
                            <a href="{{route('detail_product',$ga1->id)}}">Chi tiết</a>
                            <!-- icon eyes trigger modal -->                         
                            <i type="button" class="fas fa-eye ms-3" data-bs-toggle="modal" data-bs-target="#quickview-{{$ga1->id}}"></i>
                            <!-- Modal -->
                            <div class="modal fade" id="quickview-{{$ga1->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog container">
                                    <div class="modal-content">
                                        <img width="100%" src="{{url('/')}}/public/uploads/product/{{$ga1->image}}" alt="hot product">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tên sản phẩm: {{$ga1->name}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Giá: <?php echo number_format($ga1->price) ?> VND
                                        </div>
                                        <div class="modal-body">
                                            Xuất xứ: {{$ga1->origin}}
                                        </div>
                                        <div class="modal-body">
                                            Hạn dùng: {{ \Carbon\Carbon::parse($ga1->exp)->format('d/m/Y')}}
                                        </div>
                                        <div class="modal-body">
                                            Đã bán: {{$ga1->count_sold}}
                                        </div>  
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"><a class="text-white" href="{{route('detail_product',$ga1->id)}}">Xem nhiều hơn</a></button>
                                        </div>     
                                    </div>                                                                                              
                                </div>
                            </div>
                            <!-- add to cart by ajax -->
                            <form>
                                @csrf
                                <input type="hidden" value="{{$ga1->id}}" class="cart_product_id_{{$ga1->id}}">
                                <input type="hidden" value="{{$ga1->name}}" class="cart_product_name_{{$ga1->id}}">
                                <input type="hidden" value="{{$ga1->image}}" class="cart_product_image_{{$ga1->id}}">
                                <input type="hidden" value="{{$ga1->price}}" class="cart_product_price_{{$ga1->id}}">
                                <input type="hidden" value="1" class="cart_product_qty_{{$ga1->id}}">
                                <button type="button" name="add-to-cart" class="btn btn-primary add-to-cart" data-id_product="{{$ga1->id}}"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                            </form>
                            <!-- end add to cart by ajax -->
                            </div>
                        </div>
                    </div>
                    @endforeach  
                    </div>                                                                 
                </div>
            

            <!-- thịt gà tươi sạch -->
            <div class="fresh-chicken product row m-0 p-0 m-0 p-0">
                <h1 class="title-hot-product p-2 m-0 bg-success text-white">THỊT GÀ TƯƠI SẠCH</h1> 
                <div class="test-reponsive"> 
                @foreach($ga_tuoi_sach as $ga2)        
                    <div class="col-12 col-md-2 my-2 ok">                                              
                        <div class="card">
                            <a href="{{route('detail_product',$ga2->id)}}"><img height="220px" width="100%" src="{{url('/')}}/public/uploads/product/{{$ga2->image}}" alt="error"></a>
                            <div class="card-body">
                            <h3 class="card-text name-product">{{$ga2->name}}</h3>
                            <p class="price-product">Giá: {{number_format($ga2->price)}} VND</p>
                            <a href="{{route('detail_product',$ga2->id)}}">Chi tiết</a>
                            <!-- icon eyes trigger modal -->                         
                            <i type="button" class="fas fa-eye ms-3" data-bs-toggle="modal" data-bs-target="#quickview-{{$ga2->id}}"></i>
                            <!-- Modal -->
                            <div class="modal fade" id="quickview-{{$ga2->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog container">
                                    <div class="modal-content">
                                        <img width="100%" src="{{url('/')}}/public/uploads/product/{{$ga2->image}}" alt="hot product">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tên sản phẩm: {{$ga2->name}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Giá: <?php echo number_format($ga2->price) ?> VND
                                        </div>
                                        <div class="modal-body">
                                            Xuất xứ: {{$ga2->origin}}
                                        </div>
                                        <div class="modal-body">
                                            Hạn dùng: {{ \Carbon\Carbon::parse($ga2->exp)->format('d/m/Y')}}
                                        </div>
                                        <div class="modal-body">
                                            Đã bán: {{$ga2->count_sold}}
                                        </div>  
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"><a class="text-white" href="{{route('detail_product',$ga2->id)}}">Xem nhiều hơn</a></button>
                                        </div>     
                                    </div>                                                                                              
                                </div>
                            </div>
                            <!-- add to cart by ajax -->
                            <form>
                                @csrf
                                <input type="hidden" value="{{$ga2->id}}" class="cart_product_id_{{$ga2->id}}">
                                <input type="hidden" value="{{$ga2->name}}" class="cart_product_name_{{$ga2->id}}">
                                <input type="hidden" value="{{$ga2->image}}" class="cart_product_image_{{$ga2->id}}">
                                <input type="hidden" value="{{$ga2->price}}" class="cart_product_price_{{$ga2->id}}">
                                <input type="hidden" value="1" class="cart_product_qty_{{$ga2->id}}">
                                <button type="button" name="add-to-cart" class="btn btn-primary add-to-cart" data-id_product="{{$ga2->id}}"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                            </form>
                            <!-- end add to cart by ajax -->
                            </div>
                        </div>
                    </div>
                @endforeach  
                </div>                                      
            </div>
            <!-- thịt bò úc, mỹ ngon -->
            <div class="beef product row m-0 p-0">
                <h1 class="title-hot-product p-2 m-0 bg-success text-white">THỊT BÒ ÚC MỸ NGON</h1> 
                <div class="test-reponsive"> 
                @foreach($bo_uc_my as $bo_u_m)        
                    <div class="col-12 col-md-2 my-2 ok">                                              
                        <div class="card" >
                            <a href="{{route('detail_product',$bo_u_m->id)}}"><img height="220px" width="100%" src="{{url('/')}}/public/uploads/product/{{$bo_u_m->image}}" alt="error"></a>
                            <div class="card-body">
                            <h3 class="card-text name-product">{{$bo_u_m->name}}</h3>
                            <p class="price-product">Giá: {{number_format($bo_u_m->price)}} VND</p>
                            <a href="{{route('detail_product',$bo_u_m->id)}}">Chi tiết</a>
                            <!-- icon eyes trigger modal -->                         
                            <i type="button" class="fas fa-eye ms-3" data-bs-toggle="modal" data-bs-target="#quickview-{{$bo_u_m->id}}"></i>
                            <!-- Modal -->
                            <div class="modal fade" id="quickview-{{$bo_u_m->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog container">
                                    <div class="modal-content">
                                        <img width="100%" src="{{url('/')}}/public/uploads/product/{{$bo_u_m->image}}" alt="hot product">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tên sản phẩm: {{$bo_u_m->name}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Giá: <?php echo number_format($bo_u_m->price) ?> VND
                                        </div>
                                        <div class="modal-body">
                                            Xuất xứ: {{$bo_u_m->origin}}
                                        </div>
                                        <div class="modal-body">
                                            Hạn dùng: {{ \Carbon\Carbon::parse($bo_u_m->exp)->format('d/m/Y')}}
                                        </div>
                                        <div class="modal-body">
                                            Đã bán: {{$bo_u_m->count_sold}}
                                        </div>  
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"><a class="text-white" href="{{route('detail_product',$bo_u_m->id)}}">Xem nhiều hơn</a></button>
                                        </div>     
                                    </div>                                                                                              
                                </div>
                            </div>
                            <!-- add to cart by ajax -->
                            <form>
                                @csrf
                                <input type="hidden" value="{{$bo_u_m->id}}" class="cart_product_id_{{$bo_u_m->id}}">
                                <input type="hidden" value="{{$bo_u_m->name}}" class="cart_product_name_{{$bo_u_m->id}}">
                                <input type="hidden" value="{{$bo_u_m->image}}" class="cart_product_image_{{$bo_u_m->id}}">
                                <input type="hidden" value="{{$bo_u_m->price}}" class="cart_product_price_{{$bo_u_m->id}}">
                                <input type="hidden" value="1" class="cart_product_qty_{{$bo_u_m->id}}">
                                <button type="button" name="add-to-cart" class="btn btn-primary add-to-cart" data-id_product="{{$bo_u_m->id}}"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                            </form>
                            <!-- end add to cart by ajax -->
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>    
            </div>
            <!-- thịt heo -->
            <div class="pork product row m-0 p-0">
                <h1 class="title-hot-product p-2 m-0 bg-success text-white">THỊT LỢN</h1> 
                <div class="test-reponsive"> 
                @foreach($thit_heo as $heo)        
                    <div class="col-12 col-md-2 my-2 ok">                                              
                        <div class="card" >
                            <a href="{{route('detail_product',$heo->id)}}"><img height="220px" width="100%" src="{{url('/')}}/public/uploads/product/{{$heo->image}}" alt="error"></a>
                            <div class="card-body">
                            <h3 class="card-text name-product">{{$heo->name}}</h3>
                            <p class="price-product">Giá: {{number_format($heo->price)}} VND</p>
                            <a href="{{route('detail_product',$heo->id)}}">Chi tiết</a>
                            <!-- icon eyes trigger modal -->                         
                            <i type="button" class="fas fa-eye ms-3" data-bs-toggle="modal" data-bs-target="#quickview-{{$heo->id}}"></i>
                            <!-- Modal -->
                            <div class="modal fade" id="quickview-{{$heo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog container">
                                    <div class="modal-content">
                                        <img width="100%" src="{{url('/')}}/public/uploads/product/{{$heo->image}}" alt="hot product">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tên sản phẩm: {{$heo->name}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Giá: <?php echo number_format($heo->price) ?> VND
                                        </div>
                                        <div class="modal-body">
                                            Xuất xứ: {{$heo->origin}}
                                        </div>
                                        <div class="modal-body">
                                            Hạn dùng: {{ \Carbon\Carbon::parse($heo->exp)->format('d/m/Y')}}
                                        </div>
                                        <div class="modal-body">
                                            Đã bán: {{$heo->count_sold}}
                                        </div>  
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"><a class="text-white" href="{{route('detail_product',$heo->id)}}">Xem nhiều hơn</a></button>
                                        </div>     
                                    </div>                                                                                              
                                </div>
                            </div>
                            <!-- add to cart by ajax -->
                            <form>
                                @csrf
                                <input type="hidden" value="{{$heo->id}}" class="cart_product_id_{{$heo->id}}">
                                <input type="hidden" value="{{$heo->name}}" class="cart_product_name_{{$heo->id}}">
                                <input type="hidden" value="{{$heo->image}}" class="cart_product_image_{{$heo->id}}">
                                <input type="hidden" value="{{$heo->price}}" class="cart_product_price_{{$heo->id}}">
                                <input type="hidden" value="1" class="cart_product_qty_{{$heo->id}}">
                                <button type="button" name="add-to-cart" class="btn btn-primary add-to-cart" data-id_product="{{$heo->id}}"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                            </form>
                            <!-- end add to cart by ajax -->
                            </div>
                        </div>
                    </div>
                @endforeach   
                </div>    
            </div>
            <!-- thịt trâu ấn độ -->
            <div class="buffalo product row m-0 p-0">
                <h1 class="title-hot-product p-2 m-0 bg-success text-white">THỊT TRÂU ẤN ĐỘ</h1>
                <div class="test-reponsive">  
                @foreach($trau_an_do as $trau)        
                    <div class="col-12 col-md-2 my-2 ok">                                              
                        <div class="card" >
                            <a href="{{route('detail_product',$trau->id)}}"><img height="220px" width="100%" src="{{url('/')}}/public/uploads/product/{{$trau->image}}" alt="error"></a>
                            <div class="card-body">
                            <h3 class="card-text name-product">{{$trau->name}}</h3>
                            <p class="price-product">Giá: {{number_format($trau->price)}} VND</p>
                            <a href="{{route('detail_product',$trau->id)}}">Chi tiết</a>
                            <!-- icon eyes trigger modal -->                         
                            <i type="button" class="fas fa-eye ms-3" data-bs-toggle="modal" data-bs-target="#quickview-{{$trau->id}}"></i>
                            <!-- Modal -->
                            <div class="modal fade" id="quickview-{{$trau->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog container">
                                    <div class="modal-content">
                                        <img width="100%" src="{{url('/')}}/public/uploads/product/{{$trau->image}}" alt="hot product">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tên sản phẩm: {{$trau->name}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Giá: <?php echo number_format($trau->price) ?> VND
                                        </div>
                                        <div class="modal-body">
                                            Xuất xứ: {{$trau->origin}}
                                        </div>
                                        <div class="modal-body">
                                            Hạn dùng: {{ \Carbon\Carbon::parse($trau->exp)->format('d/m/Y')}}
                                        </div>
                                        <div class="modal-body">
                                            Đã bán: {{$trau->count_sold}}
                                        </div>  
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"><a class="text-white" href="{{route('detail_product',$trau->id)}}">Xem nhiều hơn</a></button>
                                        </div>     
                                    </div>                                                                                              
                                </div>
                            </div>
                            <!-- add to cart by ajax -->
                            <form>
                                @csrf
                                <input type="hidden" value="{{$trau->id}}" class="cart_product_id_{{$trau->id}}">
                                <input type="hidden" value="{{$trau->name}}" class="cart_product_name_{{$trau->id}}">
                                <input type="hidden" value="{{$trau->image}}" class="cart_product_image_{{$trau->id}}">
                                <input type="hidden" value="{{$trau->price}}" class="cart_product_price_{{$trau->id}}">
                                <input type="hidden" value="1" class="cart_product_qty_{{$trau->id}}">
                                <button type="button" name="add-to-cart" class="btn btn-primary add-to-cart" data-id_product="{{$trau->id}}"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                            </form>
                            <!-- end add to cart by ajax -->
                            </div>
                        </div>
                    </div>
                @endforeach 
                </div>     
            </div>
            <!-- hải sản -->
            <div class="seafood product row m-0 p-0">
                <h1 class="title-hot-product p-2 m-0 bg-success text-white">HẢI SẢN</h1> 
                <div class="test-reponsive"> 
                @foreach($hai_san as $seafood)        
                    <div class="col-12 col-md-2 my-2 ok">                                              
                        <div class="card" >
                            <a href="{{route('detail_product',$seafood->id)}}"><img height="220px" width="100%" src="{{url('/')}}/public/uploads/product/{{$seafood->image}}" alt="error"></a>
                            <div class="card-body">
                            <h3 class="card-text name-product">{{$seafood->name}}</h3>
                            <p class="price-product">Giá: {{number_format($seafood->price)}} VND</p>
                            <a href="{{route('detail_product',$seafood->id)}}">Chi tiết</a>
                            <!-- icon eyes trigger modal -->                         
                            <i type="button" class="fas fa-eye ms-3" data-bs-toggle="modal" data-bs-target="#quickview-{{$seafood->id}}"></i>
                            <!-- Modal -->
                            <div class="modal fade" id="quickview-{{$seafood->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog container">
                                    <div class="modal-content">
                                        <img width="100%" src="{{url('/')}}/public/uploads/product/{{$seafood->image}}" alt="hot product">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tên sản phẩm: {{$seafood->name}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Giá: <?php echo number_format($seafood->price) ?> VND
                                        </div>
                                        <div class="modal-body">
                                            Xuất xứ: {{$seafood->origin}}
                                        </div>
                                        <div class="modal-body">
                                            Hạn dùng: {{ \Carbon\Carbon::parse($seafood->exp)->format('d/m/Y')}}
                                        </div>
                                        <div class="modal-body">
                                            Đã bán: {{$seafood->count_sold}}
                                        </div>  
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"><a class="text-white" href="{{route('detail_product',$seafood->id)}}">Xem nhiều hơn</a></button>
                                        </div>     
                                    </div>                                                                                              
                                </div>
                            </div>
                            <!-- add to cart by ajax -->
                            <form>
                                @csrf
                                <input type="hidden" value="{{$seafood->id}}" class="cart_product_id_{{$seafood->id}}">
                                <input type="hidden" value="{{$seafood->name}}" class="cart_product_name_{{$seafood->id}}">
                                <input type="hidden" value="{{$seafood->image}}" class="cart_product_image_{{$seafood->id}}">
                                <input type="hidden" value="{{$seafood->price}}" class="cart_product_price_{{$seafood->id}}">
                                <input type="hidden" value="1" class="cart_product_qty_{{$seafood->id}}">
                                <button type="button" name="add-to-cart" class="btn btn-primary add-to-cart" data-id_product="{{$seafood->id}}"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                            </form>
                            <!-- end add to cart by ajax -->
                            </div>
                        </div>
                    </div>
                @endforeach     
                </div>
            </div>

            <!-- gạo sạch cao cấp -->
            <div class="spice product row m-0 p-0">
                <h1 class="title-hot-product p-2 m-0 bg-success text-white">GẠO SẠCH CAO CẤP</h1> 
                @foreach($gao_sach as $gs)        
                    <div class="col-12 col-md-2 my-2">                                              
                        <div class="card" >
                            <a href="{{route('detail_product',$gs->id)}}"><img height="220px" width="100%" src="{{url('/')}}/public/uploads/product/{{$gs->image}}" alt="error"></a>
                            <div class="card-body">
                            <h3 class="card-text name-product">{{$gs->name}}</h3>
                            <p class="price-product">Giá: {{number_format($gs->price)}} VND</p>
                            <a href="{{route('detail_product',$gs->id)}}">Chi tiết</a>
                            <!-- icon eyes trigger modal -->                         
                            <i type="button" class="fas fa-eye ms-3" data-bs-toggle="modal" data-bs-target="#quickview-{{$gs->id}}"></i>
                            <!-- Modal -->
                            <div class="modal fade" id="quickview-{{$gs->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog container">
                                    <div class="modal-content">
                                        <img width="100%" src="{{url('/')}}/public/uploads/product/{{$gs->image}}" alt="hot product">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tên sản phẩm: {{$gs->name}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Giá: <?php echo number_format($gs->price) ?> VND
                                        </div>
                                        <div class="modal-body">
                                            Xuất xứ: {{$gs->origin}}
                                        </div>
                                        <div class="modal-body">
                                            Hạn dùng: {{ \Carbon\Carbon::parse($gs->exp)->format('d/m/Y')}}
                                        </div>
                                        <div class="modal-body">
                                            Đã bán: {{$gs->count_sold}}
                                        </div>  
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"><a class="text-white" href="{{route('detail_product',$gs->id)}}">Xem nhiều hơn</a></button>
                                        </div>     
                                    </div>                                                                                              
                                </div>
                            </div>
                            <!-- add to cart by ajax -->
                            <form>
                                @csrf
                                <input type="hidden" value="{{$gs->id}}" class="cart_product_id_{{$gs->id}}">
                                <input type="hidden" value="{{$gs->name}}" class="cart_product_name_{{$gs->id}}">
                                <input type="hidden" value="{{$gs->image}}" class="cart_product_image_{{$gs->id}}">
                                <input type="hidden" value="{{$gs->price}}" class="cart_product_price_{{$gs->id}}">
                                <input type="hidden" value="1" class="cart_product_qty_{{$gs->id}}">
                                <button type="button" name="add-to-cart" class="btn btn-primary add-to-cart" data-id_product="{{$gs->id}}"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                            </form>
                            <!-- end add to cart by ajax -->
                            </div>
                        </div>
                    </div>
                @endforeach     
            </div>

            <!-- gia vị tẩm ướp -->
            <div class="spice product row m-0 p-0">
                <h1 class="title-hot-product p-2 m-0 bg-success text-white">GIA VỊ TẨM ƯỚP</h1> 
                @foreach($gia_vi as $gv)        
                    <div class="col-12 col-md-2 my-2">                                              
                        <div class="card" >
                            <a href="{{route('detail_product',$gv->id)}}"><img width="100%" src="{{url('/')}}/public/uploads/product/{{$gv->image}}" alt="error"></a>
                            <div class="card-body">
                            <h3 class="card-text name-product">{{$gv->name}}</h3>
                            <p class="price-product">Giá: {{number_format($gv->price)}} VND</p>
                            <a href="{{route('detail_product',$gv->id)}}">Chi tiết</a>
                            <button class="btn btn-primary" value="Thêm giỏ hàng"></button>
                            <!-- icon eyes trigger modal -->                         
                            <i type="button" class="fas fa-eye ms-3" data-bs-toggle="modal" data-bs-target="#quickview-{{$gv->id}}"></i>
                            <!-- Modal -->
                            <div class="modal fade" id="quickview-{{$gv->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog container">
                                    <div class="modal-content">
                                        <img width="100%" src="{{url('/')}}/public/uploads/product/{{$gv->image}}" alt="hot product">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tên sản phẩm: {{$gv->name}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Giá: <?php echo number_format($gv->price) ?> VND
                                        </div>
                                        <div class="modal-body">
                                            Xuất xứ: {{$gv->origin}}
                                        </div>
                                        <div class="modal-body">
                                            Hạn dùng: {{ \Carbon\Carbon::parse($gv->exp)->format('d/m/Y')}}
                                        </div>
                                        <div class="modal-body">
                                            Đã bán: {{$gv->count_sold}}
                                        </div>  
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"><a class="text-white" href="{{route('detail_product',$gv->id)}}">Xem nhiều hơn</a></button>
                                        </div>     
                                    </div>                                                                                              
                                </div>
                            </div>
                            <!-- add to cart by ajax -->
                            <form>
                                @csrf
                                <input type="hidden" value="{{$gv->id}}" class="cart_product_id_{{$gv->id}}">
                                <input type="hidden" value="{{$gv->name}}" class="cart_product_name_{{$gv->id}}">
                                <input type="hidden" value="{{$gv->image}}" class="cart_product_image_{{$gv->id}}">
                                <input type="hidden" value="{{$gv->price}}" class="cart_product_price_{{$gv->id}}">
                                <input type="hidden" value="1" class="cart_product_qty_{{$gv->id}}">
                                <button type="button" name="add-to-cart" class="btn btn-primary add-to-cart" data-id_product="{{$gv->id}}"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                            </form>
                            <!-- end add to cart by ajax -->
                            </div>
                        </div>
                    </div>
                @endforeach     
            </div>
        </div>
    </div>
</div>
@endsection