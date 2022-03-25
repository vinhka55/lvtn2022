<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="{{url('/')}}/public/frontend/css/main.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
    <style>
    .list-group {
        flex-direction: row;

    }

    .list-group {
        -webkit-box-sizing: inherit;
        -moz-box-sizing: inherit;
        box-sizing: inherit;
    }

    .list-group:before,
    .list-group:after {
        -webkit-box-sizing: inherit;
        -moz-box-sizing: inherit;
        box-sizing: inherit;
    }
    </style>
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
                    <input class="form-control me-2" name="search" id="search-product" type="search" placeholder="Tìm sản phẩm" aria-label="Search">
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
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
    <div class="container-fluid p-2">
        <div class="product-details row p-0 m-0">
            <!--product-details-->
            @foreach($product as $item)
            <div class="col-12 col-md-5">
                <div class="view-product">
                    <img src="{{url('/')}}/public/uploads/product/{{$item->image}}" alt="image" width="100%" />
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
                                
                                <input class="rounded-pill w-100" type="text" id="your_comment" placeholder="Điền bình luận của bạn">
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
    </div>
    @endforeach
</body>

</html>

<script src="{{url('/')}}/public/jquery/jquery-3.6.0.min.js"></script>
<script src="https://kit.fontawesome.com/4e34373e01.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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