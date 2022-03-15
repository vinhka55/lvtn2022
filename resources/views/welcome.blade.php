<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{url('/')}}/public/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/')}}/public/frontend/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{url('/')}}/public/frontend/css/prettyPhoto.css" rel="stylesheet">
    <link href="{{url('/')}}/public/frontend/css/price-range.css" rel="stylesheet">
    <link href="{{url('/')}}/public/frontend/css/animate.css" rel="stylesheet">

    <link href="{{url('/')}}/public/frontend/css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/')}}/public/frontend/css/app.css">
    <link href="{{url('/')}}/public/frontend/css/sweetalert.css" rel="stylesheet">
    <link href="{{url('/')}}/public/frontend/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>THỰC PHẨM HỮU NGHỊ| Cung Cấp Thực Phẩm Sỉ Lẻ Uy Tín</title>
</head>
<body>
  
    <div class="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-nav-bar">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{url('/')}}">Trang chủ</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="">Giới thiệu</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Sản phẩm</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Tin tức</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Dịch vụ</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Liên hệ</a>
                  </li>
                </ul>            
              </div>
              <form class="d-flex" action="{{route('search_product')}}" method="post">
                    @csrf
                    <input class="form-control me-2" name="search" type="search" placeholder="Tìm sản phẩm" aria-label="Search">
                    <button class="btn btn-outline-warning" type="submit">Tìm kiếm</button>
                  
                </form> 
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

              <?php 
              if(Session::get('user_id')){
                ?>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
        </nav>
  
    </div>
    <div class="container-fluid mb-5">
            <div class="slider-top mt-3">
                <img width="100%" src="https://thucphamhuunghi.com/plugins/hinh-anh/banner/horizontal-404x-768-768-q1.webp" alt="top banner">
            </div>
            <div class="top-content row mx-0 px-0 mt-3">
                <div class="cate col-12 col-md-3">
                    <h3 class="p-3 bg-success text-white m-0">DANH MỤC SẢN PHẨM</h3>
                    <ul class="p-3 bg-white text-dark">
                        @foreach ($category as $cate)
                        <a href="{{route('danh_muc_san_pham',$cate->id)}}"><li>{{$cate->name}}</li></a>
                        @endforeach
                    </ul>
                </div>
                <div class="col-12 col-md-6">
                    <img class="img-fuild" src="{{url('/')}}/public/frontend/images/main-2022-1280-400-qbanner.jpg" alt="">
                </div>
                <div class="col-12 col-md-3">
                    <a href=""><img src="{{url('/')}}/public/frontend/images/rLE2AAo.gif" alt="gif image"></a>
                </div>
            </div>
    </div>
    @yield("content")
    
    <div class="footer">
        <div class="container-fluid bg-dark text-white border-top p-3">
            <div class="row m-0 p-0">
                <div class="col-md-3 col-6 border-right">
                    <h4 class="font-weight-bold">LIÊN HỆ</h4>
                    <h5>CÔNG TY TNHH XUẤT NHẬP KHẨU THỰC PHẨM HỮU NGHỊ</h5>
                    <p>Địa Chỉ: 9C10 KDC Nam Long, Hà Huy Giáp, KP3, p. Thạch Lộc, Q.12</p>
                    <p>Hotline: 0901 892 899  - MST : 031 333 6061</p>
                    <p>Email : nghivan86@gmail.com</p>
                </div>
                <div class="col-md-3 col-6 border-right">
                    <h4 class="font-weight-bold">ĐĂNG KÝ NHẬN EMAIL</h4>
                    <p>Đăng ký nhận email để nhận tin tức và thông tin khuyến mãi sớm nhất.</p>
                    <form class="form-inline">
                    <div class="form-group mb-2">
                        <input type="password" class="form-control" id="inputPassword2" placeholder="Email">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 mt-0">Đăng ký</button>
                    </form>
                </div>
                <div class="col-md-3 col-6 border-right">
                    <h4 class="font-weight-bold">QUY ĐỊNH CHÍNH SÁCH</h4>
                    <ul>
                        <li>Chính sách bảo mật thông tin</li>
                        <li>Chính sách giao hàng</li>
                        <li>Chính sách đổi trả</li>
                        <li>Chính sách thanh toán</li>
                        <li>Hướng dẫn mua hàng</li>
                    </ul>
                    <img src="https://thucphamhuunghi.com/template/orange/img/logoSaleNoti.png" alt="">
                </div>
            </div>
        </div>
        <div class="container-fluid text-center bg-dark text-white border-top py-2">
            <div id="copyright">© Copyright 2022 lvtn2022-levinhit</div>
        </div>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{url('/')}}/public/frontend/js/jquery.js"></script>
<script src="{{url('/')}}/public/frontend/js/bootstrap.min.js"></script>
<script src="{{url('/')}}/public/frontend/js/jquery.scrollUp.min.js"></script>
<script src="{{url('/')}}/public/frontend/js/price-range.js"></script>
<script src="{{url('/')}}/public/frontend/js/jquery.prettyPhoto.js"></script>
<script src="{{url('/')}}/public/frontend/js/main.js"></script>
<script src="{{url('/')}}/public/frontend/js/sweetalert.min.js"></script>


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
                console.log(data)
                $('.hover-cart').html(data)
            },
        error:function(xhr){
                console.log(xhr.responseText);
            }
        })
    }
        show_cart_menu()
        hover_cart_menu()
  $(document).ready(function(){
    $('.add-to-cart').click(function(e){       
        var id = $(this).data('id_product');
        var cart_product_id = $('.cart_product_id_' + id).val();
        var cart_product_name = $('.cart_product_name_' + id).val();
        var cart_product_image = $('.cart_product_image_' + id).val();
        var cart_product_price = $('.cart_product_price_' + id).val();
        var cart_product_qty = $('.cart_product_qty_' + id).val();
        var _token = $('input[name="_token"]').val();
        var info_product={cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token};
        $.ajax({
            url: "{{route('add-cart-by-ajax')}}",
            method: 'POST',
            data:info_product,
            success:function(){
                swal({
                    title: "Thêm thành công",
                    text: "Sản phẩm đã được thêm vào giỏ hàng",
                    icon: "success",
                    button: false,
                    timer:2000
                });
                show_cart_menu()
                hover_cart_menu()
            },
            error:function(xhr){
                console.log(xhr.responseText);
            }
        });
    });
  });
</script>


