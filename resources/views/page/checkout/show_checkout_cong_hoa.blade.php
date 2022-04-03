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

    <title>Thanh toán</title>
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
            <div class="col-md-8 col-12 bg-white">
                <h1 class="text-light bg-success p-2 ps-3 m-0 fs-4"><i class="fa-solid fa-cart-shopping-fast"></i>THÔNG TIN GIAO HÀNG</h1>
                <form class="row g-3">
                  <div class="col-md-6">
                  @foreach($info as $item)
                    <label for="name" class="form-label">Họ & Tên</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$item->name}}">
                  </div>
                  <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{$item->email}}">
                  </div>
                  <div class="col-12">
                    <label for="phone" class="form-label">Số Điện Thoại</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{$item->phone}}">
                  </div>
                  <div class="col-12">
                    <label for="address-re" class="form-label">Địa Chỉ</label>
                    <input type="text" class="form-control" id="address-re" name="address_re" placeholder="Apartment, studio, or floor">
                    <p><small id="error-address-null" class="text-danger"></small></p>
                  </div>
                  <div class="col-12">
                    <label for="notes" class="form-label">Ghi chú</label>
                    <textarea  type="textarea" class="form-control" id="notes" name="notes"> </textarea>
                  </div>
                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck">
                      <label class="form-check-label" for="gridCheck">
                        Lưu hồ sơ
                      </label>
                    </div>
                  </div>
                </form>
            </div>
            <div class="col-md-4 col-12">
                <div class="row p-2 mx-0 mb-2 bg-warning bg-opacity-25">
                    <p class="p-0 m-0 fw-bold fs-6 text-secondary">TỔNG CỘNG (CHƯA VAT)</p>
                    <p class="h3 fw-bolder"><?php echo number_format(Cart::total()).' VND' ?></p>
                    <hr>
                    <p class="h3 fw-bolder"><span class="badge bg-light text-dark">VAT</span><?php echo number_format(0.1*Cart::total()).' VND' ?></p>
                    <p class="h3 fw-bolder"><span class="badge bg-light text-dark">Giảm giá</span><?php echo number_format(Session::get('discount')).' VND' ?></p>
                    <hr>
                    <p class="p-0 m-0 fw-bold fs-6 text-secondary">THÀNH TIỀN</p>
                    <p class="h3 fw-bolder text-danger">
                        <?php $total=Cart::total()+0.1*Cart::total()-Session::get('discount'); 
                        echo number_format($total).' VND' ?>
                    </p>
                </div>
                <div class="row p-2 mx-0 mb-2 bg-info bg-opacity-25">
                  <div class="btn-group btn-group-vertical text-start" role="group">
                    <p>Chọn phương thức thanh toán</p>
                    <form id="pay_online_method">
                        <input type="radio" id="cash" name="pay" value="cash">
                        <label for="cash"> Tiền mặt</label><br>
                        <input type="radio" id="atm" name="pay" value="atm">
                        <label for="atm"> ATM</label><br>
                        <?php
                            //đoạn code tạo unique mã đơn hàng lấy trên mạng
                            $stamp = strtotime("now");
                            $order_code = 'order_'.$stamp;
                        ?>	 
                        <input type="hidden" value="{{$order_code}}" id="order_code">							 
                    </form>			
                    <p><small id="error-pay-null" class="text-danger"></small></p>
                    @endforeach
                    <div class="nut-thanh-toan" style="display:flex;">
                        <!-- Thanh toán bình thường -->
                        <button class="btn btn-primary checkout-now">Thanh toán ngay</button>
                        <!-- Thanh toán momo -->
                        <form method="post" action="{{route('momo')}}">									
                            @csrf
                            <input type="hidden" name="total_money" value="{{$total}}">		
                            <style>
                                .button-momo { 
                                background-color: #004A7F;                               
                                -webkit-border-radius: 10px;                              
                                border-radius: 10px;                                  
                                border: none;                                 
                                color: #FFFFFF;                                 
                                cursor: pointer;                                 
                                display: inline-block;                                
                                font-family: Arial;                                
                                font-size: 20px;                                 
                                padding: 5px 10px;                                
                                text-align: center;                                
                                text-decoration: none;
                                margin-top: 9px;
                                margin-left: 2px;                           
                                }
                                @-webkit-keyframes glowing {
                                0% { background-color: #004A7F; -webkit-box-shadow: 0 0 3px #004A7F; }
                                50% { background-color: #0094FF; -webkit-box-shadow: 0 0 10px #0094FF; }
                                100% { background-color: #004A7F; -webkit-box-shadow: 0 0 3px #004A7F; }
                                }
                                
                                @-moz-keyframes glowing {
                                0% { background-color: #004A7F; -moz-box-shadow: 0 0 3px #004A7F; }
                                50% { background-color: #0094FF; -moz-box-shadow: 0 0 10px #0094FF; }
                                100% { background-color: #004A7F; -moz-box-shadow: 0 0 3px #004A7F; }
                                }
                                
                                @-o-keyframes glowing {
                                0% { background-color: #004A7F; box-shadow: 0 0 3px #004A7F; }
                                50% { background-color: #0094FF; box-shadow: 0 0 10px #0094FF; }
                                100% { background-color: #004A7F; box-shadow: 0 0 3px #004A7F; }
                                }
                                
                                @keyframes glowing {
                                0% { background-color: #004A7F; box-shadow: 0 0 3px #004A7F; }
                                50% { background-color: #0094FF; box-shadow: 0 0 10px #0094FF; }
                                100% { background-color: #004A7F; box-shadow: 0 0 3px #004A7F; }
                                }
                                
                                .button-momo {
                                -webkit-animation: glowing 1500ms infinite;
                                -moz-animation: glowing 1500ms infinite;
                                -o-animation: glowing 1500ms infinite;
                                animation: glowing 1500ms infinite;
                                }
                            </style>						
                            <button type="submit" name="payUrl" class="button-momo ">Thanh toán Online</button>
                        </form>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('#pay_online_method input').on('change', function() {
            var order_code=$('#order_code').val()
            $( ".id-bank" ).remove();
        if($('input[name=pay]:checked', '#pay_online_method').val()=='atm'){
            $('#pay_online_method').append('<div class="id-bank border border-primary p-3"><p>Chủ tài khoản: Lê Hữu Vinh STK: 189200331 Ngân hàng: VPBANK </p><p>Chủ tài khoản: Lê Hữu Vinh STK: 123456778 Ngân hàng: VIETCOMBANK </p><p class="text-danger h4">Nội dung chuyển khoản là mã đơn hàng của bạn: '+order_code+'</p></div>')
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.checkout-now').click(function(){ 
                $("#error-name-null").html("")
                $("#error-phone-null").html("")
                $("#error-email-null").html("")
                $("#error-address-null").html("")
                $("#error-pay-null").html("")
                if($('#name').val()==""){
                    $("#error-name-null").html("Tên không được bỏ trống")    
                }
                else if($('#phone').val()==""){
                    $("#error-phone-null").html("Sô điện thoại không được bỏ trống")
                }
                else if($('#email').val()==""){
                    $("#error-email-null").html("Email không được bỏ trống")
                }
                else if($('#address-re').val()==""){
                    $("#error-address-null").html("Địa chỉ không được bỏ trống")
                }
                else if($('input[name="pay"]:checked','#pay_online_method').val()==undefined){
                    $("#error-pay-null").html("Chọn 1 phương thức thanh toán")
                }
                else{
                    var name=$('#name').val()
                    var phone=$('#phone').val()
                    var email=$('#email').val()
                    var address_re=$('#address-re').val()
                    var notes=$('#notes').val()
                    var _token = $('input[name="_token"]').val()
                    var order_code=$('#order_code').val()
                    var pay=$('input[name="pay"]:checked','#pay_online_method').val()
                    var data={name:name,email:email,phone:phone,address_re:address_re,notes:notes,_token:_token,pay:pay,order_code:order_code}
                
                    swal({
                    title: "Bạn chắc chắn đặt hàng?",
                    text: "Bấm OK để xác nhận đặt hàng, nếu chưa chắc chắn hãy bấm Cancel",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('order_place')}}",
                            method: 'POST',
                            data:data,
                            success:function(data){
                                console.log("ok")
                            },
                            error:function(xhr){
                                console.log(xhr.responseText);
                            }
                        });
                        swal("Cảm ơn bạn đã mua hàng!", {
                        icon: "success",
                        });
                        window.location.href = "{{url('/')}}/don-hang-cua-toi";
                        }
                    });          
                }    
            })
        })
    </script>
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