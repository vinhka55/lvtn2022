@extends("admin.admin_layout")
@section("admin_page")

<div class="row">
    <p>Thống kế doanh số</p>
    <form action="">
        @csrf
        <div class="col-md-2">
            <p><input type="text" id="datepickerFrom" class="form-control"></p>
        </div>
        <div class="col-md-2">
            <p><input type="text" id="datepickerTo" class="form-control"></p>
        </div>
        <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Tìm kiếm">
 
        <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="time-statistic">
            <option selected>Chọn khoảng thời gian</option>
            <option value="sub_seven_day">7 Ngày trước</option>
            <option value="this_month">Tháng này</option>
            <option value="last_month">Tháng trước</option>
          </select>
    </form>
    <div class="col-md-12">
        <div id="my-top-chart" style="height: 250px;">

        </div>
    </div>
    <div class="col-md-12">
        <table class="table table-dark table-striped table-visitors">
            <thead>
                <tr>
                  <th scope="col">Đang online</th>
                  <th scope="col">Tổng tháng này</th>
                  <th scope="col">Tổng tháng trước</th>
                  <th scope="col">Tổng một năm</th>
                  <th scope="col">Tổng truy cập</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</th>
                  <td>{{$visitor_this_month_count}}</td>
                  <td>{{$visitor_last_month_count}}</td>
                  <td>{{$visitor_one_year_count}}</td>
                  <td>{{$visitors_all_count}}</td>
                </tr>
              </tbody>
          </table>
    </div>
</div>

<script>
    $( function() {
        $( "#datepickerFrom" ).datepicker({
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat:"yy-mm-dd",
            dayNamesMin:["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
            duration:"slow"
        })
        $( "#datepickerTo" ).datepicker({
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat:"yy-mm-dd",
            dayNamesMin:["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
            duration:"slow"
        })
    } );
</script>
<script>
    
    var chart=new Morris.Bar({
    // ID of the element in which to draw the chart.
    element: 'my-top-chart',
    gridTextColor:'white',
    gridTextSize:'16px',
    hideHover:true,

    // The name of the data record attribute that contains x-values.
    xkey: 'period',
    // A list of names of data record attributes that contain y-values.
    ykeys: ['order','sales','profit','quantity'],
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ['Đơn hàng','Tổng thu','Lợi nhuận','Số lượng']
    });
    function getStatistic30Days(){
        $.ajax({
        url : "{{route('get_statistic_30days')}}",
            method: 'get',
            //headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            //data:{fromDay:fromDay,toDay:toDay},
            success:function(data){
                if(data=='empty')
                {
                    $('#my-top-chart').html('')
                    $('#my-top-chart').append('<p>empty record</p>')
                }
                else{
                    data=JSON.parse(data)
                    chart.setData(data)
                }
            }, 
            error: (xhr) => {
                console.log(xhr.responseText); 
                }
        })
    }
    getStatistic30Days()
    $('#btn-dashboard-filter').click(function(){
        fromDay=$('#datepickerFrom').val();
        toDay=$('#datepickerTo').val();
        $.ajax({
        url : "{{route('filter_turnover')}}",
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{fromDay:fromDay,toDay:toDay},
            success:function(data){
                if(data=='empty')
                {
                    $('#my-top-chart').html('')
                    $('#my-top-chart').append('<p class="text-center">empty record</p>')
                }
                else{
                    data=JSON.parse(data)
                    chart.setData(data)
                } 
            }, 
            error: (xhr) => {
                console.log(xhr.responseText); 
                }
        })
    })
</script>
<script>
    $('#time-statistic').change(function(){
        var value_time=$('#time-statistic').val()
        console.log(value_time)
        $.ajax({
        url : "{{route('get_statistic_with_time')}}",
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{value_time:value_time},
            success:function(data){
                //console.log(data)
                if(data=='empty')
                {
                    $('#my-top-chart').html('')
                    $('#my-top-chart').append('<p class="text-center">empty record</p>')
                }
                else{
                    data=JSON.parse(data)
                    chart.setData(data)
                }
            }, 
            error: (xhr) => {
                console.log(xhr.responseText); 
                }
        })
    })
</script>
@stop