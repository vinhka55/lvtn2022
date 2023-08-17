<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="THỰC PHẨM HỮU NGHỊ chuyên cung cấp thịt đông lạnh nhập khẩu, thịt tươi sạch chất lượng, uy tín, giá rẻ. Tất cả các sản phẩm đều qua kiểm dịch."/>
    <meta name="keywords" content="thưc phẩm, thức ăn, tươi sạch, food"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <meta name="title" content="THỰC PHẨM HỮU NGHỊ | Cung Cấp Thực Phẩm Nhập Khẩu Ngon Và Sạch"/>

    <meta property="og:image" content="https://baoquocte.vn/stores/news_dataimages/phamthuan/022022/26/16/lo-ngai-it-co-co-hoi-gianh-danh-hieu-ronaldo-co-kha-nang-roi-man-utd.jpg?rt=20220226165204" >
    <meta property="og:site_name" content="lvtnhoa.com" >
    <meta property="og:description" content="Sản phẩm này đảm bảo an toàn vệ sinh thực phẩm được chứng nhận an toàn vệ sinh thực phẩm ISO-2000, được người tiêu dùng lựa chọn nhiều nhất" >
    <meta property="og:title" content="Thực Phẩm Nhập Khẩu Tươi Ngon Và Sạch" >
    <meta property="og:url" content="{{url()->current()}}" >
    <meta property="og:type" content="website" >

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{url('/')}}/public/frontend/css/lightSlider.css">
    <link rel="stylesheet" href="{{url('/')}}/public/frontend/css/prettify.css">

    <script src="{{url('/')}}/public/frontend/js/jquery.js"></script>
    <script src="{{url('/')}}/public/frontend/js/lightslider.js"></script>
    <script src="{{url('/')}}/public/frontend/js/prettify.js"></script>

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <link  rel="canonical" href="{{url()->current()}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{url('/')}}/public/frontend/css/sweetalert.css" rel="stylesheet">
    <link href="{{url('/')}}/public/frontend/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>THỰC PHẨM HỮU NGHỊ| Cung Cấp Thực Phẩm Sỉ Lẻ Uy Tín</title>
</head>
<body>
   
    <div class="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-nav-bar">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{url('/')}}">TRANG CHỦ</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="">Giới thiệu</a>
                  </li>
                  <li class="nav-item item-products">
                    <a class="nav-link active" aria-current="page" href="#">Sản phẩm</a>
                    <ul class="list-category-product">
                        @foreach($category as $cate_nav)
                        <a href="{{route('show_product_with_category',$cate_nav->slug)}}"><li style="background-color:#198754;margin-top:1px;color:white;">{{$cate_nav->name}}</li></a>
                        @endforeach
                    </ul> 
                  </li>
                  <li class="nav-item item-news">
                    <a class="nav-link active" aria-current="page" href="#">Tin tức</a>
                    <ul class="list-category-news">
                        @foreach($category_news as $cate_news)
                        <a href="{{route('show_news_with_category',$cate_news->slug)}}"><li style="background-color:#198754;margin-top:1px;color:white;">{{$cate_news->name}}</li></a>
                        @endforeach
                    </ul> 
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Dịch vụ</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Liên hệ</a>
                  </li>
                </ul>
                            
              </div>
              <!-- tim kiem san pham -->
              <div class="form-search-product">
                <form class="d-flex mx-2" action="{{route('search_product')}}" method="post">
                    @csrf
                    <input class="form-control me-2" name="search" id="search-product" type="search" placeholder="Search" aria-label="Search">
                    <div id="return-result-search"></div>
                    <button class="btn btn-outline-light" type="submit">Search</button>             
                </form>
            </div>
            <!-- giỏ hàng -->
            <?php 
              if(Session::get('user_id')){
                ?>
                <div class="content-cart-menu">
                    <a href="{{route('shopping_cart')}}" class='ms-2 me-2'><i class="fal fa-cart-arrow-down"></i><span id="count-cart"></span></a>   
                    <ul class="hover-cart p-1 m-0">                    
                    </ul>  
                </div>
                <div class="notifications" style="position:relative;">
                    <i class="fas fa-bell show-notifications"></i><span id="count-notifications" style="color:red;"></span>
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
        </nav>
    </div>
    
    @yield("content")
    <div class="footer">
        <div class="container-fluid bg-dark text-white border-top pt-3">
            <div class="row">
                <div class="col-md-3 col-6 border-right">
                    <h4 class="font-weight-bold">LIÊN HỆ</h4>
                    <h5>CÔNG TY TNHH XUẤT NHẬP KHẨU THỰC PHẨM VINH-HOA</h5>
                    <p>Địa Chỉ: 9C10 KDC Nam Long, Hà Huy Giáp, KP3, p. Thạch Lộc, Q.12</p>
                    <p>Hotline: 0901 892 899  - MST : 031 333 6061</p>
                    <p>Email : nghivan86@gmail.com</p>
                </div>
                <div class="col-md-3 col-6 border-right">
                    <h4 class="font-weight-bold">ĐĂNG KÝ NHẬN EMAIL</h4>
                    <p>Đăng ký nhận email để nhận tin tức và thông tin khuyến mãi sớm nhất.</p>
                    <form class="form-inline">
                        <div class="form-group mb-2">
                            <input type="email" class="form-control" id="inputPassword2" placeholder="Email">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Đăng ký</button>
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
        <div class="container-fluid text-center bg-dark text-white border-top">
            <div id="copyright">© Copyright 2023 lvtn2023-levinhit</div>
        </div>
    </div>
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "104404878885917");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v13.0'
        });
      };
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

{{-- <script src="{{url('/')}}/public/frontend/js/bootstrap.min.js"></script> --}}
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
                //console.log(data)
                $('.hover-cart').html(data)
            },
        error:function(xhr){
                console.log(xhr.responseText);
            }
        })
    }
    function count_notifications() {
        $.ajax({
            url:"{{route('count_notifications')}}",
            method:'get',
            success:function(data){
                    $('#count-notifications').html(data)           
            }
        })
    }
        show_cart_menu()
        hover_cart_menu()
        count_notifications()
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
                    window.location.href = "{{route('my_order')}}";
                    }
                });          
            }    
        })
    })
</script>
<script>
    $('#pay_online_method input').on('change', function() {       
        var order_code=$('#order_code').val()
        $( ".id-bank" ).remove();
        if($('input[name=pay]:checked', '#pay_online_method').val()=='atm'){
            $('#pay_online_method').append('<div class="id-bank border border-primary p-3"><p>Chủ tài khoản: Lê Hữu Vinh STK: 189200331 Ngân hàng: VPBANK </p><p>Chủ tài khoản: Lê Hữu Vinh STK: 123456778 Ngân hàng: VIETCOMBANK </p><p class="text-danger h4">Nội dung chuyển khoản là mã đơn hàng của bạn: '+order_code+'</p></div>')
        }
    });
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
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script>       
    $(document).ready(function(){
    // Khởi tạo một đối tượng Pusher với app_key
    var pusher = new Pusher('9156c186f5a7eb69923c', {
        cluster: 'ap1',
        encrypted: true
    });
    //Đăng ký với kênh chanel-demo-real-time mà ta đã tạo trong file DemoPusherEvent.php
    var channel = pusher.subscribe('Notifications-realtime');
    //Bind một function addMesagePusher với sự kiện DemoPusherEvent
    channel.bind('App\\Events\\InboxPusherEvent', addMessage);
    });
    //function add message
    function addMessage(data) {
        console.log(123)
        $.ajax({
                url: "{{route('insert_notification')}}",                
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{content:data.message},
                success:function(data){
                    console.log(456)
                    $('#count-notifications').html(data)
                    
                },
                error:function(xhr){
                    console.log(xhr.responseText);
                }
            });
    }   window.count_click_notification = 1
</script>
<script> 
    $('.show-notifications').click(function() {
        count_click_notification++
        $.ajax({
            url: "{{route('show_notifications')}}",                
            method: 'get',
            success:function(data){
                if(count_click_notification%2!=0){
                    $('.status-order').toggleClass('toggle-notifications')
                }
                else{
                    $('.status-order').remove()
                    $('.notifications').append(data)
                    count_notifications()
                }                
            },
            error:function(xhr){
                console.log(xhr.responseText);
            }
        });
    })
</script>

{{-- Trang check_product --}}
<script>
    function show_comment() {
        var id_product = $('#id-product-hidden').val()
        var _token = $('input[name="_token"]').val()
        $.ajax({
            url: "{{route('show_comment')}}",
            method: 'POST',
            data: {
                id_product: id_product,
                _token: _token
            },
            success: function(data) {
                $('.show-comment').html(data)
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    show_comment()
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".send-comment").on('click', function() {
            if ($("#your_comment").val().length == 0) {
                $("#empty_comment").html("Bình luận không được bỏ trống")
            } else {
                var product_id = $("#product_id").val()
                var content = $("#your_comment").val()
                var _token = $('input[name="_token"]').val()
                var data = {
                    product_id: product_id,
                    content: content,
                    _token: _token
                }
                $.ajax({
                    url: "{{route('send_comment')}}",
                    method: 'POST',
                    data: data,
                    success: function(data) {
                        show_comment()
                        $("#your_comment").val("")
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        })
    })
    </script>
    
    <script>
    function handle_send_rep(id_comment) {
        $(".empty-rep").html("")
        var content_reply = $(".txtarea-content-rep").val()
        if(content_reply.length==0){
            $(".empty-rep").append("Vui lòng điền nội dung")
            return;
        }
        var _token = $('input[name="_token"]').val()
        var name = $('.name-' + id_comment).val()
        var avatar = $('.avatar-' + id_comment).val()
        var data = {
            content_reply: content_reply,
            id_comment: id_comment,
            _token: _token
        }
        //get time now in js
        const today = new Date();
        const yyyy = today.getFullYear();
        let mm = today.getMonth() + 1; // Months start at 0!
        let dd = today.getDate();
        let h=today.getHours();
        let i=today.getMinutes();
        let s=today.getSeconds();
    
        if (dd < 10) dd = '0' + dd;
        if (mm < 10) mm = '0' + mm;
    
        const time_now = dd + '-' + mm + '-' + yyyy+' '+h+':'+i+':'+s;
    
        $.ajax({
            url: "{{route('rep_comment')}}",
            method: 'POST',
            data: data,
            success: function(data) {
                $(".comment-reply-" + id_comment).html("")
                $(".append-reply-" + id_comment).append(
                '<div class="row mt-2"><div class="col-3"><a class="me-3" href="#"><img class="rounded-circle shadow-1-strong" src="' + '{{url("/")}}/public/uploads/avatar/' + avatar + '"alt="avatar" width="65" height="65" /> </a></div> <div class="flex-grow-1 flex-shrink-1 col-9"><div class="d-flex justify-content-between align-items-center"> <p class="mb-1 text-success">@ ' + name + ' <span class="small"> ' + time_now + '</span> </p></div><p class="small mb-0"> ' + content_reply + '</p></div></div></div>')             
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    
    function rep(id_comment) {
        if($('#user_id_hidden').val()==undefined){
            $(".comment-reply-" + id_comment).html(
            "<small class='text-danger'>Đăng nhập để trả lời comment</small>"
            )
        }
        else{
            $(".comment-reply-" + id_comment).html(
            "<p><textarea class='txtarea-content-rep'></textarea><p class='empty-rep text-danger'></p><button onclick='handle_send_rep(" + id_comment +
            ")'>Gửi</button></p>"
            )
        }
    }
    </script>

{{-- hủy đơn hàng --}}
<script type="text/javascript">
    function cancel_order(order_id) {
        var reason_cancel_order=$('.reason-cancel-area-'+order_id).val();
        if($('.reason-cancel-area-'+order_id).val()!=""){
            $.ajax({
            url: "{{route('customer_cancel_order')}}",
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{reason_cancel_order:reason_cancel_order,order_id:order_id,},
            
            success:function(){
                    // addMessage({message:"Bạn đã hủy đơn hàng "})
                    toastr.success('Hủy đơn hàng thành công', 'Thành công');
                    $('.btn-cancel-'+order_id).hide()
                    $('.wait-status-'+order_id).html('<p class="text-danger">Đơn đã hủy</p>')
                    // $('#exampleModal-'+order_id).hide()
                },
            error:function(xhr){
                    console.log(xhr.responseText);
                }
            });
        }
        else{
            $('.warning-not-null-reason-cancel').text("Không được để trống lý do")
        }
    }
    </script>

    {{-- check-now page --}}
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
                                console.log(data)
                            },
                            error:function(xhr){
                                console.log(xhr.responseText);
                            }
                        });
                        swal({
                            title: "Cảm ơn bạn đã mua hàng",
                            icon: "success",
                            buttons: ["Tiếp tục mua", "Lịch sử mua"],
                            dangerMode: true,
                            
                            })
                            .then((willDelete) => {
                            if (willDelete) {
                                window.location.href = "{{url('/')}}/don-hang-cua-toi"
                            } else {
                                window.location.href = "{{url('/')}}"
                            }
                            });
                        //window.location.href = "{{url('/')}}/don-hang-cua-toi";
                        }
                    });          
                }    
            })
        })
    </script>
    <script>
  $(document).ready(function() {
 
    $('#lightSlider').lightSlider({
    gallery: true,
    item: 1,
    loop:true,
    slideMargin: 0,
    thumbItem: 9
}); 
 
  });
  </script>
  <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
  <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  {!! Toastr::message() !!}
  