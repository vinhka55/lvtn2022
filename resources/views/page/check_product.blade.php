<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{url('/')}}/public/frontend/css/main.css" rel="stylesheet">
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
                            <p>Hạn sử dụng: {{$item->exp}}</p>
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
        <div class="col-4">
            <div class="list-group d-flex" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list"
                    href="#list-home" role="tab" aria-controls="list-home">Mô tả</a>
                <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list"
                    href="#list-profile" role="tab" aria-controls="list-profile">Bình luận</a>
            </div>
        </div>
        <div class="col-8">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                    <?php echo htmlspecialchars_decode($item->description); ?>
                </div>
                <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                    <!-- <div class="row" style="border: 2px solid black;">                                
                                <div class="col-md-3" style="border: 2px solid black;">
                                <img width="50%" src="{{url('/')}}/public/uploads/avatar/{{$my_avatar}}" alt="my avatar">
                                </div>
                                <input type="hidden" id="product_id" name="product_id" value="{{$item->id}}">
                                
                                <div class="col-md-9">
                                    <input type="text" id="your_comment" placeholder="Điền bình luận của bạn">
                                    <p class="text-danger" id="empty_comment"></p>
                                    <button class="btn btn-info send-comment">Gửi</button>
                                </div>                                                            
                            </div>                           -->
                    <div class="d-flex flex-start">
                        <input type="hidden" id="product_id" name="product_id" value="{{$item->id}}">
                        <img class="rounded-circle shadow-1-strong me-3"
                            src="{{url('/')}}/public/uploads/avatar/{{$my_avatar}}" alt="avatar" width="65"
                            height="65" />
                        <div class="flex-grow-1 flex-shrink-1">
                            <div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-1">
                                        {{Session::get('name_user')}}
                                    </p>
                                </div>
                                <p class="small mb-0">
                                    <input type="text" id="your_comment" placeholder="Điền bình luận của bạn">
                                <p class="text-danger" id="empty_comment"></p>
                                <button class="btn btn-info send-comment">Gửi</button>
                                </p>
                            </div>
                            <!-- end comment -->
                        </div>
                    </div>
                    <div class="show-comment row">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
</script>
<script src="{{url('/')}}/public/jquery/jquery-3.6.0.min.js"></script>
<script src="https://kit.fontawesome.com/4e34373e01.js" crossorigin="anonymous"></script>
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
    var content_reply = $(".txtarea-content-rep").val()
    var _token = $('input[name="_token"]').val()
    var name = $('.name-' + id_comment).val()
    var avatar = $('.avatar-' + id_comment).val()
    var data = {
        content_reply: content_reply,
        id_comment: id_comment,
        _token: _token
    }
    $.ajax({
        url: "{{route('admin_rep')}}",
        method: 'POST',
        data: data,
        success: function(data) {
            $(".comment-reply-" + id_comment).html("")
            $(".append-reply-" + id_comment).append(
            '<a class="me-3" href="#"><img    class="rounded-circle shadow-1-strong"   src="' +   '{{url("/")}}/public/uploads/avatar/' + avatar +  '"  alt="avatar"   width="65"   height="65" />  </a> <div class="flex-grow-1 flex-shrink-1"> <div> <div class="d-flex justify-content-between align-items-center"> <p class="mb-1"> ' + name + ' <span class="small"> ' + new Date().toLocaleDateString() + '</span>  </p> </div> <p class="small mb-0"> ' + content_reply + '  </p>  </div></div>')             
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
}

function rep(id_comment) {
    $(".comment-reply-" + id_comment).html(
        "<p><textarea class='txtarea-content-rep'></textarea><button onclick='handle_send_rep(" + id_comment +
        ")'>Gửi</button></p>"
    )
}
</script>