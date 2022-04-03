<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css"/>

    <title>Giỏ hàng của bạn</title>
    <style>
        .hover-cart {
            border-radius: 8%;
            margin-top: 4px;
            width: 126px;
            background-color: greenyellow;
            position: absolute;
            display: none;
        }
        .content-cart-menu:hover .hover-cart{
        display: inherit;
        }
    </style>
  </head>
  <body class="bg-light bg-gradient">
    <!--Header-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll font-weight-bold" style="--bs-scroll-height: 100px;">
              <li class="nav-item border-end border-light">
                <a class="nav-link active" aria-current="page" href="{{url('/')}}">TRANG CHỦ</a>
              </li>
              <li class="nav-item border-end border-light">
                <a class="nav-link" href="#">GIỚI THIỆU</a>
              </li>
              <li class="nav-item border-end border-light">
                <a class="nav-link" href="#">SẢN PHẨM</a>
              </li>
              <li class="nav-item border-end border-light">
                <a class="nav-link" href="#">TIN TỨC</a>
              </li>
              <li class="nav-item border-end border-light">
                <a class="nav-link" href="#">DỊCH VỤ</a>
              </li>
              <li class="nav-item border-end border-light">
                <a class="nav-link" href="#">LIÊN HỆ</a>
              </li>
            </ul>
            <!-- tim kiem san pham -->
            <form class="d-flex mx-2" action="{{route('search_product')}}" method="post">
                @csrf
                <input class="form-control me-2" name="search" id="search-product" type="search" placeholder="Search" aria-label="Search">
                <div id="return-result-search"></div>
                <button class="btn btn-outline-light" type="submit">Search</button>             
            </form>
            <!-- giỏ hàng -->
            <?php 
              if(Session::get('user_id')){
                ?>
                <div class="content-cart-menu">
                    <a href="{{route('shopping_cart')}}" class='btn btn-info me-2'><i class='fa fa-shopping-cart'></i>Giỏ hàng <span id="count-cart"></span></a>   
                    <div class="hover-cart bg-white p-5 m-0">                    
                    </div>  
                </div>                      
              <?php }
              else { ?>
                <a href="{{route('login')}}" class="btn btn-info me-2"><i class="fa fa-shopping-cart"></i>Giỏ hàng</a>
              <?php } ?>
            <!-- user -->
            <?php 
              if(Session::get('user_id')){
                ?>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                    {{Session::get('name_user')}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <a href="{{route('info_user')}}"><button class="dropdown-item" type="button">Thông tin tài khoản</button></a>
                        <a href="{{route('my_order')}}"><button class="dropdown-item" type="button">Lịch sử đơn hàng</button></a>
                        <a href="{{route('logout')}}"><button class="dropdown-item" type="button">Đăng xuất</button></a>
                    </div>
                </div>               
              <?php }
              else { ?>
              <a href="{{route('login')}}" class="btn btn-info">Đăng nhập</a>
              <?php } ?>
          </div>
        </div>
    </nav>
    <div class="container mx-auto my-5 py-4">
        <div class="row m-0 p-0">
            <div class="col-md-8 col-12 table-responsive">
                <form action="{{route('update_cart')}}" method="post">
					@csrf
					<?php														
						$content=Cart::items()->original;
					?>
                <h1 class="text-light bg-success p-2 ps-3 m-0 fs-4"><i class="fa-solid fa-cart-shopping-fast"></i> GIỎ HÀNG</h1>
                <table class="table text">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">HÌNH</th>
                        <th scope="col">TÊN SP</th>
                        <th scope="col">GIÁ</th>
                        <th class="text-center" scope="col">SỐ LƯỢNG</th>
                        <th scope="col">TỔNG TIỀN</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $index=1 ?>
                    @foreach($content as $item)	
                      <tr>
                        <th scope="row">{{$index}}</th>
                        <td><img width="50" src="{{url('/')}}/public/uploads/product/{{$item['thumb']}}" alt=""></td>
                        <td>{{$item['name']}}</td>
                        <td>{{number_format($item['price'])}} VNĐ</td>
                        <td class="text-center">
                            <input value="{{$item['qty']}}" class="w-25 me-1 form-control-sm border-0 bg-success bg-opacity-10" type="number" min="1" name="quantity[{{$item['uid']}}]">
                            <input type="hidden" name="uid[{{$item['uid']}}]" value="{{$item['uid']}}">
                        </td>
                        <td>
                            <?php
                                $subtotal=$item['qty']*$item['price'];
                                echo number_format($subtotal).' '.'VND';
                            ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning"><a class="cart_quantity_delete" href="{{route('delete_product_in_cart',$item['uid'])}}">Xóa</a></button>
                        </td>
                      </tr>
                      <?php $index=$index+1; ?>
                      @endforeach	
                    </tbody>
                  </table>
                    <div class="flex m-2">
						<button type='submit' class='btn btn-primary'>Cập nhật giỏ hàng</button>
						<a href="{{route('delete-all-product-in-cart')}}" class="btn btn-primary">Xóa tất cả</a>
				    </div>
                    </form>
            </div>
            <div class="col-md-4 col-12">
                <div class="row p-2 mx-0 mb-2 bg-warning bg-opacity-25">
                    <p class="p-0 m-0 fw-bold fs-6 text-secondary">TỔNG CỘNG (CHƯA VAT)</p>
                    <p class="h3 fw-bolder">{{number_format(Cart::total())}} VND</p>
                    <hr>
                    <p class="h3 fw-bolder"> <span class="badge bg-light text-dark">VAT</span>
                        <?php 
                            $tax= 0.1*Cart::total();
                            echo number_format($tax).' VND';
                        ?>
                    </p>
                    <p class="h3 fw-bolder">Phí vận chuyển: 0 VND</p>
                    @if($coupon)
                            <p class="h3 fw-bolder">Giảm giá <span>
							@foreach($coupon as $item)								
								@if($item->condition=='percent')
								<?php 
								$discount= $item->rate*(Cart::total()+$tax)/100;
								echo number_format($discount). 'VND';
								Session::put('discount',$discount);							
								?>
								@else
								<?php 
								$discount= $item->rate;
								echo number_format($discount).' VND';	
								Session::put('discount',$discount);							
								?>
								@endif
							@endforeach
							</span></p>
							@else
								<?php $discount=0;
								Session::put('discount',0);
								?>					
							@endif
                    <hr>
                    <p class="p-0 m-0 fw-bold fs-6 text-secondary">THÀNH TIỀN</p>
                        <p class="p-0 m-0 fw-bold fs-6 text-secondary">
                            <?php
                                $total=Cart::total()+$tax-$discount;
                                echo number_format($total).' VND';
                            ?>
                        </p>
                    <button type="button" class="btn btn-danger"><a href="{{route('pay_product')}}">Tiếp Tục ></a></button>
                </div>
                <div class="row p-2 mx-0 mb-2 bg-info bg-opacity-25">
                    <div class="input-group mb-3">
                        <form action="{{route('discount')}}" method="post">
                            {{ csrf_field() }}
                            <p class="text-danger">{{Session::get('error')}}</p>
                            @if(Session::has('incorrect_coupon'))
                            <p class="text-danger">{{Session::get('incorrect_coupon')}}</p>
                            {{Session::put('incorrect_coupon',null)}}
                            @endif
                            <input type="text" name="code_coupon" class="form-control" placeholder="Nhập Mã Khuyến Mãi" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-info text-light" type="submit" id="button-addon2">Áp Dụng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script type="text/javascript">
        function show_cart_menu() {
            $.ajax({
            url:"{{route('show_cart_menu')}}",
            method:'get',
            success:function(data){
                $('#count-cart').html(data)
                }
            })
        }
        function hover_cart_menu() {
            $.ajax({
            url:"{{route('hover_cart_menu')}}",
            method:'get',
            success:function(data){
                    //console.log(data)
                    $('.hover-cart').html(data)
                },
            error:function(xhr){
                    console.log(xhr.responseText);
                }
            })
        }
        show_cart_menu()
        hover_cart_menu()
    </script>
    <script>
    $('#search-product').keyup(function() {
        var content_search=$(this).val()
        if(content_search!=''){
                $.ajax({
                url: "{{route('autocomplete_search')}}",                
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{content_search:content_search},
                success:function(data){
                    $('#return-result-search').fadeIn();
                    $('#return-result-search').html(data)
                },
                error:function(xhr){
                    console.log(xhr.responseText);
                }
            });
        }
        else{
            $('#return-result-search').fadeOut();
        }
    })
</script>
  </body>
</html>