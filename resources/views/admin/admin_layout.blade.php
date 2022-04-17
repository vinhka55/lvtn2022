<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
<title>Admin Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{url('/')}}/public/backend/css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{url('/')}}/public/backend/css/style.css" rel='stylesheet' type='text/css' />
<link href="{{url('/')}}/public/backend/css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
{{-- <link rel="stylesheet" href="{{url('/')}}/public/backend/css/font.css" type="text/css"/>
<link href="{{url('/')}}/public/backend/css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="{{url('/')}}/public/backend/css/morris.css" type="text/css"/> --}}
<!-- calendar -->
<link rel="stylesheet" href="{{url('/')}}/public/backend/css/monthly.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="{{url('/')}}/public/backend/css/admin.css">

{{-- datepicker --}}
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

{{-- morris chart --}}
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<!-- //calendar -->
<!-- //font-awesome icons -->
{{-- <script src="{{url('/')}}/public/backend/js/jquery2.0.3.min.js"></script>
<script src="{{url('/')}}/public/backend/js/raphael-min.js"></script> --}}

<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

<link rel="stylesheet" href="{{url('/')}}/public/backend/css/admin.css">
<style>
    .sub {display: none;}
</style>

</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="#" class="logo">
        VISITORS
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="">
                <span class="username">
                    <?php
                        if(Auth::check()) echo Auth::user()->name;                       
                    ?>
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="{{route('admin_logout')}}"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>

<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a href="{{route('admin')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;" class="collapsible">
                        <i class="fa fa-book"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('add_category')}}">Thêm danh mục sản phẩm</a></li>
						<li><a href="{{route('list_category')}}">Danh sách danh mục sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="collapsible">
                        <i class="fas fa-book-open"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('add_product')}}">Thêm sản phẩm</a></li>
						<li><a href="{{route('list_product')}}">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="collapsible">
                        <i class="fas fa-book-open"></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('insert_coupon')}}">Thêm mã giảm giá</a></li>
						<li><a href="{{route('list_coupon')}}">Danh sách mã giảm giá</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="collapsible">
                        <i class="fas fa-book-open"></i>
                        <span>Quản lý đơn hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('list_order')}}">Danh sách đơn hàng</a></li>
						
                    </ul>
                </li>  
                <li class="sub-menu">
                    <a href="javascript:;" class="collapsible">
                        <i class="fas fa-book-open"></i>
                        <span>Quản lý bình luận</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('list_comment')}}">Danh sách bình luận</a></li>
						
                    </ul>
                </li> 
                
                <li class="sub-menu">
                    <a href="javascript:;" class="collapsible">
                        <i class="fas fa-book-open"></i>
                        <span>Quản lý tin tức</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('add_category_news')}}">Thêm danh mục tin tức</a></li>	
						<li><a href="{{route('list_category_news')}}">Danh sách danh mục tin tức</a></li>						
						<li><a href="{{route('add_news')}}">Thêm tin tức</a></li>						
						<li><a href="{{route('list_news')}}">Danh sách tin tức</a></li>						
                    </ul>
                </li> 
                @hasrole('admin')
                <li class="sub-menu">
                    <a href="javascript:;" class="collapsible">
                        <i class="fas fa-book-open"></i>
                        <span>Quản lý user</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('list_user')}}">Danh sách user</a></li>
						
                    </ul>
                </li> 
                @endhasrole                
            </ul>  
</aside>

<section id="main-content">
    
	<section class="wrapper">
        @yield("admin_page")
        
        <!-- content admin page here -->
    </section>
 <!-- footer -->
    <div class="footer">
        <div class="wthree-copyright">
            <p>© 2021 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">Drangon Team</a></p>
        </div>
    </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{url('/')}}/public/backend/js/bootstrap.js"></script>

{{-- <script src="{{url('/')}}/public/backend/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="{{url('/')}}/public/backend/js/scripts.js"></script>
<script src="{{url('/')}}/public/backend/js/jquery.slimscroll.js"></script>
<script src="{{url('/')}}/public/backend/js/jquery.nicescroll.js"></script> --}}
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
{{-- <script src="{{url('/')}}/public/backend/js/jquery.scrollTo.js"></script> --}}
<!-- morris JavaScript -->	
{{-- <script src="{{url('/')}}/public/backend/js/jquery.min.js"></script>	 --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}

<script type="text/javascript">
    $('.order_details').change(function(){
        $(this).prop('disabled', true);
        var order_status = $(this).val();
        var order_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();
        //lay ra so luong
        quantity = [];
        $("input[name='product_sales_quantity']").each(function(){
            quantity.push($(this).val());
        });
        //lay ra product id
        order_product_id = [];
        $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
        });
        j = 0;
        // for(i=0;i<order_product_id.length;i++){
        //     //so luong khach dat
        //     var order_qty = $('.order_qty_' + order_product_id[i]).val();
        //     //so luong ton kho
        //     var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();
        //     if(parseInt(order_qty)>parseInt(order_qty_storage)){
        //         j = j + 1;
        //         if(j==1){
        //             alert('Số lượng bán trong kho không đủ');
        //         }
        //         $('.color_qty_'+order_product_id[i]).css('background','#000');
        //     }
        // }
        if(j==0){
        
                $.ajax({
                        url : "{{route('update_status_of_product_in_order')}}",
                            method: 'POST',
                            data:{_token:_token, order_status:order_status ,order_id:order_id ,quantity:quantity, order_product_id:order_product_id},
                            success:function(data){
                                
                                //alert('Thay đổi tình trạng đơn hàng thành công');
                                $('.action-delete-product').hide()
                                $('.update-amount-product-in-order').hide()
                                $('.qty-product-detail-order').addClass('disable-input')
                                // for(product_id of order_product_id){
                                //     alert(product_id)
                                //     amount_count=$('.amount-product-'+product_id).text()
                                //     amount_count=parseInt(amount_count)
                                    
                                // }
                                for(var i=0;i<order_product_id.length;i++){
                                    amount_count=$('.amount-product-'+order_product_id[i]).text()
                                    $('.amount-product-'+order_product_id[i]).html(parseInt(amount_count)+parseInt(quantity[i]))
                                }
                                toastr.success('Thay đổi tình trạng đơn hàng thành công', 'Thành công');
                                //location.reload();
                            },
                            error: (error) => {
                                console.log(JSON.stringify(error));
                            }
                });           
        }
    });
</script>
<script type="text/javascript">
$('.update-amount-product-in-order').click(function(e) {
    e.preventDefault()
    var id_detail=$(this).data('id_detail')
    var id_product=$(this).data('id_product')
    var count_product=$(this).data('count_product')
    var initial_value=$(this).data('initial_value')
    var price_product=$(this).data('price_product')
    var order_product_qty=$('.order_product_qty_'+id_detail).val()
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url : "{{route('update_qty_product_in_order')}}",
            method: 'POST',
            data:{_token:_token, id_detail:id_detail ,order_product_qty:order_product_qty,initial_value:initial_value},
            success:function(data){
                toastr.success('Cập nhật thành công', 'Thành công');
                if(order_product_qty>initial_value){
                    qty=count_product-(order_product_qty-initial_value)
                    $('.amount-product-'+id_product).html(qty)
                }
                else{
                    qty=count_product+(initial_value-order_product_qty)
                    $('.amount-product-'+id_product).html(qty)
                }
                total_money=price_product*order_product_qty
                vat=0.1*total_money
                all=total_money+vat
                $('.total-money-order').text(total_money+' VND')
                $('.vat-order').text(vat+ ' VND')
                $('.all-this-order').text(all+' VND')
            },
            error: (xhr) => {
                console.log(xhr.responseText); 
            }
        });
    })
</script>

<script type="text/javascript">
$('.delete-user').click(function(e) {
    e.preventDefault()
    var id_remove=$(this).data('id_remove')
    var id_login=$(this).data('id_login')
    var route_del="http://localhost/test/".concat(id_remove.toString())
    if(id_remove==id_login){
        swal({
            icon: "warning",
            title:"Không được xóa chính mình",
        });
    }
    else{
    $.ajax({
        url : "{{url('/')}}/delete-user/"+id_remove.toString(),
            method: 'get',
            success:function(data){
                alert('Xoa thanh cong')
                location.reload();
            },
            error: (xhr) => {
                console.log(xhr.responseText); 
                }
            });
        }
    })
</script>
<script>
    function ok(id_comment){
        var content_reply=$(".txtarea-content-admin-rep").val()
        var _token = $('input[name="_token"]').val();
        $.ajax({
        url : "{{route('rep_comment')}}",
            method: 'post',
            data:{id_comment:id_comment,content_reply:content_reply,_token:_token},
            success:function(){
                location.reload()
            },
            error: (xhr) => {
                console.log(xhr.responseText); 
                }
        });
    }
    $('.admin-reply').click(function(){
        var id_comment=$(this).data('id_comment')
        $(".all-reply-comment-"+id_comment).hide()
        $(".content-reply-"+id_comment).html(
            "<textarea class='txtarea-content-admin-rep' placeholder='Admin trả lời'></textarea><button onclick='ok("+id_comment+")' data-id_send='"+id_comment+"' class='btn-xs btn-info send-reply-comment'>Gửi</button>"
        )      
    })
</script>
<script type="text/javascript">
    function select_gallery() {
        var product_id=$('#product_id').val()
        var _token = $('input[name="_token"]').val()
        $.ajax({
        url : "{{route('select_gallery')}}",
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{product_id:product_id},
            success:function(data){
                $('#select-gallery').html(data)
            }, 
            error: (xhr) => {
                console.log(xhr.responseText); 
                }
        })
    }
    select_gallery()
    function delete_gallery(id_gallery) {
        $.ajax({
        url : "{{route('delete_gallery')}}",
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{id_gallery:id_gallery},
            success:function(data){
                select_gallery()
            }, 
            error: (xhr) => {
                console.log(xhr.responseText); 
                }
        })
    }
    function change_image_gallery(id_gallery) {
        var image_data= $('#file-gallery-'+id_gallery).val()
        var form_data=new FormData(document.getElementById('formID'))
        form_data.append('image'+id_gallery,$('#file-gallery-'+id_gallery).val())
        form_data.append('id_gallery',id_gallery)
        console.log(form_data)
        $.ajax({
        url : "{{route('change_image_gallery')}}",
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:form_data,
            contentType: false,
            cache : false,
            processData: false,
            success:function(data){
                alert(data)
                select_gallery()
            }, 
            error: (xhr) => {
                console.log(xhr.responseText); 
                }
        })
    }
</script>
<script>
    $('#search-with-status').change(function() {
        window.location.href=this.value
    })
    </script>
<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var sub = this.nextElementSibling;
        if (sub.style.display === "block") {
            sub.style.display = "none";
        } else {
            sub.style.display = "block";
        }
    });
    }
</script>

</body>
</html>
