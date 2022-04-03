<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css"/>
    <title>Lịch sử đơn hàng</title>
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
              <form class="d-flex mx-2" action="{{route('search_product')}}" method="post">
                    @csrf
                    <input class="form-control me-2" name="search" id="search-product" type="search" placeholder="Tìm sản phẩm" aria-label="Search">
                    <div id="return-result-search"></div>
                    <button class="btn btn-outline-light" type="submit">Search</button>              
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
    @if(count($data)==0)
    <div class="container" style="text-align:center"> 

        <h3>Bạn chưa có giao dịch nào</h3> 
        <img style="margin:auto;" width="60%" src="https://i.pinimg.com/originals/ae/8a/c2/ae8ac2fa217d23aadcc913989fcc34a2.png" alt="empty list oeder">
    </div>
    @else
    <div class="container">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading text-center h3">
                Lịch sử đơn hàng
                </div>

            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th style="width:20px;">
                        <label class="i-checks m-b-none">
                            <input type="checkbox"><i></i>
                        </label>
                        </th>
                        <th>Mã đơn hàng</td>
                        <th>Tổng giá tiền</th>
                        <th>Ngày đặt</th>
                        <th>Tình trạng</th>  
                        <th></th>         
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                                
                                @foreach($data as $item)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                                    <td><p class="text-ellipsis name">{{$item->order_code}}</p></td>
                                    <td><p class="text-ellipsis name">{{number_format($item->total_money)}} VND</p></td>                       
                                    <td>{{date('d-m-Y h:i:s', strtotime($item->created_at))}}</td>
                                    <td><p <?php 
                                    if($item->status=="Đã xử lý")echo "class='text-success'";
                                    else if($item->status=="Đang chờ xử lý")echo "class='text-warning'";
                                    else if($item->status=="Đã thanh toán-chờ nhận hàng")echo "class='text-info'";
                                    else if($item->status=="Đơn đã hủy")echo "class='text-danger'";
                                     ?>>{{$item->status}}</p></td>                      
                                    <td><a href="{{route('detail_my_order',$item->id)}}">Xem chi tiết</a></td>
                                    @if($item->status=="Đang chờ xử lý")
                                    <!-- <td><button class="btn btn-danger cancel-order">Hủy đơn</button></td> -->
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button  type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$item->id}}">
                                        Hủy đơn hàng
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Lý do hủy đơn</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                
                                                <div class="modal-body">
                                                    <textarea class="reason-cancel-area-{{$item->id}}" required cols="70" rows="7" placeholder="Làm ơn điền lý do hủy đơn hàng..."></textarea>
                                                    <p class="warning-not-null-reason-cancel text-danger"></p>
                                                </div>
                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary" onclick="cancel_order({{$item->id}})">Gửi</button>             
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach                    
                    </tbody>
                </table>
            </div>
        </div>
        
                    {{$data->links()}}

    </div>
    @endif   
    </div>
    <!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
                location.reload()
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