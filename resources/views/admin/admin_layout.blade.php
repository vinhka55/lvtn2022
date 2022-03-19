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
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{url('/')}}/public/backend/css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{url('/')}}/public/backend/css/style.css" rel='stylesheet' type='text/css' />
<link href="{{url('/')}}/public/backend/css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{url('/')}}/public/backend/css/font.css" type="text/css"/>
<link href="{{url('/')}}/public/backend/css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="{{url('/')}}/public/backend/css/morris.css" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{url('/')}}/public/backend/css/monthly.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="{{url('/')}}/public/backend/css/admin.css">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{url('/')}}/public/backend/js/jquery2.0.3.min.js"></script>
<script src="{{url('/')}}/public/backend/js/raphael-min.js"></script>
<script src="{{url('/')}}/public/backend/js/morris.js"></script>
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
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('add_category')}}">Thêm danh mục sản phẩm</a></li>
						<li><a href="{{route('list_category')}}">Danh sách danh mục sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fas fa-book-open"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('add_product')}}">Thêm sản phẩm</a></li>
						<li><a href="{{route('list_product')}}">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fas fa-book-open"></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('insert_coupon')}}">Thêm mã giảm giá</a></li>
						<li><a href="{{route('list_coupon')}}">Danh sách mã giảm giá</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fas fa-book-open"></i>
                        <span>Quản lý đơn hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('list_order')}}">Danh sách đơn hàng</a></li>
						
                    </ul>
                </li>  
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fas fa-book-open"></i>
                        <span>Quản lý bình luận</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('list_comment')}}">Danh sách bình luận</a></li>
						
                    </ul>
                </li> 
                @hasrole('admin')
                <li class="sub-menu">
                    <a href="javascript:;">
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
<script src="{{url('/')}}/public/backend/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="{{url('/')}}/public/backend/js/scripts.js"></script>
<script src="{{url('/')}}/public/backend/js/jquery.slimscroll.js"></script>
<script src="{{url('/')}}/public/backend/js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{url('/')}}/public/backend/js/jquery.scrollTo.js"></script>
<!-- morris JavaScript -->	
<script src="{{url('/')}}/public/backend/js/jquery.min.js"></script>	
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- <script>
    ClassicEditor
	.create( document.querySelector( '#description-by-ckeditor' ), {
		ckfinder: {
			uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
		},
		toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
	} )
	.catch( error => {
		console.error( error );
	} );
</script> -->

<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{url('/')}}/public/backend/js/monthly.js"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
    <script type="text/javascript">
    $('.order_details').change(function(){
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
                                alert('Thay đổi tình trạng đơn hàng thành công');
                                location.reload();
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
    var order_product_qty=$('.order_product_qty_'+id_detail).val()
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url : "{{route('update_qty_product_in_order')}}",
            method: 'POST',
            data:{_token:_token, id_detail:id_detail ,order_product_qty:order_product_qty},
            success:function(data){
                alert('Cập nhật số lượng thành công');
                location.reload();
            },
            error: (error) => {
                console.log(JSON.stringify(error)); 
            }
    });

})
</script>

<script type="text/javascript">
$('.delete-user').click(function(e) {
    e.preventDefault()
    var id_remove=$(this).data('id_remove')
    var id_login=$(this).data('id_login')
    var route_del="http://localhost/lvtn2022/".concat(id_remove.toString())
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
        url : "{{route('admin_rep')}}",
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
</body>
</html>
