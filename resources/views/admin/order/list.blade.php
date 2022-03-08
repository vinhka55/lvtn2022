@extends("admin.admin_layout")
@section("admin_page")
<div class="container">
    <div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
        Danh sách đơn hàng
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
                <th>Tình trạng</th>           
                <th>Hiển thị</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                        
                        @foreach($data as $item)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td><p class="text-ellipsis name"><?php echo 'ORDER'.$item->id ?></p></td>
                            <td><p class="text-ellipsis name">{{number_format($item->total_money)}}</p></td>                       
                            <td>{{$item->status}}</td>                       
                            <td>
                            <a title="click to edit" href=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                            <a title="click to delete" onclick="return confirm('Are you sure?')" href="{{route('delete_order',$item->id)}}"><i class="fa fa-times text-danger text"></i></a>
                            </td>
                            <td><a href="{{route('detail_order',$item->id)}}">Detail</a></td>
                        </tr>
                        @endforeach
                
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>
@stop