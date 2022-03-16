<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Lịch sử đơn hàng</title>
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

    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{url('/')}}/public/backend/js/jquery2.0.3.min.js"></script>
    <script src="{{url('/')}}/public/backend/js/raphael-min.js"></script>
    <script src="{{url('/')}}/public/backend/js/morris.js"></script>
</head>
<body>
    
    @if(count($data)==0)
    <div class="container" style="text-align:center"> 

        <h3>Bạn chưa có giao dịch nào</h3> 
        <img style="margin:auto;" width="60%" src="https://i.pinimg.com/originals/ae/8a/c2/ae8ac2fa217d23aadcc913989fcc34a2.png" alt="empty list oeder">
    </div>
    @else
    <div class="container">
        <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Lịch sử đơn hàng
                </div>
                <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <select class="input-sm form-control w-sm inline v-middle">
                    <option value="trang-thai">Trạng thái</option>
                    <option value="sort-a-to-z">Tên a->z</option>
                    </select>
                    <a href="" class="btn btn-sm btn-default">Chọn</a>                
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Tìm kiếm</button>
                    </span>
                    </div>
                </div>
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
                                    <td><p class="text-ellipsis name"><?php echo 'ORDER'.$item->id ?></p></td>
                                    <td><p class="text-ellipsis name">{{number_format($item->total_money)}}</p></td>                       
                                    <td>{{$item->created_at}}</td>
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
                                        <button  type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                        Hủy đơn hàng
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Lý do hủy đơn</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                
                                                <div class="modal-body">
                                                    <textarea class="reason-cancel-area" required cols="70" rows="7" placeholder="Làm ơn điền lý do hủy đơn hàng..."></textarea>
                                                    <p class="warning-not-null-reason-cancel text-danger"></p>
                                                </div>
                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
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
        <footer class="panel-footer">
            <div class="row">     
                <div class="col-sm-7 text-right text-center-xs">                
                <ul class="pagination pagination-sm m-t-none m-b-none">
                    {!!$data->links()!!}
                </ul>
                </div>
            </div>
        </footer>
    </div>
    @endif   
    </div>
</body>
</html>

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

<script type="text/javascript">
    function cancel_order(order_id) {
        var reason_cancel_order=$('.reason-cancel-area').val();
        if($('.reason-cancel-area').val()!=""){
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