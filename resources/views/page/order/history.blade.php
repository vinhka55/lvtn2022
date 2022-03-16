@extends("welcome")
@section("content")
<div style="margin-top:80px;">
    @if(count($data)==0)
    <div class="container" style="text-align:center"> 
        <h3>Bạn chưa có giao dịch nào</h3> 
        <img style="margin:auto;" width="60%" src="https://i.pinimg.com/originals/ae/8a/c2/ae8ac2fa217d23aadcc913989fcc34a2.png" alt="empty list oeder">
    </div>
    @else
    <div class="container">
        <div class="table-agile-info">
        <div class="panel panel-default">
                <h3 class="text-center">Lịch sử đơn hàng</h3>
                <div class="row w3-res-tb">
                    <div class="col-sm-5 m-b-xs">
                        <select class="input-sm form-control w-sm inline v-middle" style="line-height:20px;">
                            <option value="trang-thai">Trạng thái</option>
                            <option value="sort-a-to-z">Tên a->z</option>
                        </select>
                        <br>
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
                                    <td><p class="text-ellipsis name">{{number_format($item->total_money)}} VND</p></td>                       
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format("d-m-Y H:i:s") }}</td>
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
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:50px;">
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
</div>
@stop