@extends("admin.admin_layout")
@section("admin_page")
<!-- Thông tin người đặt hàng -->
<div class="container">
    <div class="table-agile-info">
    <a href="{{route('list_order')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i>Quay lại</a>
    <div class="panel panel-default">
        <div class="panel-heading">
        Thông tin người mua
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
                <th>Tên khách hàng</td>
                <th>Số điện thoại</th>
                <th>Email</th>           
            </tr>
            </thead>
            <tbody>                    
                        @foreach($info_user as $item)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td><p class="text-ellipsis name">{{$item->name}}</p></td>
                            <td><p class="text-ellipsis name">{{$item->phone}}</p></td>
                            <td><p class="text-ellipsis name">{{$item->email}}</p></td>                       
                            
                        </tr>
                        @endforeach    
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>
<!-- Thông tin giao hàng -->
<div class="container">
    <div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
        Thông tin giao hàng
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
                <th>Tên khách hàng</td>
                <th>Số điện thoại</th>
                <th>Email</th>      
                <th>Địa chỉ</th>
                <th>Cách thanh toán</th>      
                <th>Ghi chú</th>           
            </tr>
            </thead>
            <tbody>                    
                        @foreach($info_shipping as $item)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td><p class="text-ellipsis name">{{$item->name}}</p></td>
                            <td><p class="text-ellipsis name">{{$item->phone}}</p></td>
                            <td><p class="text-ellipsis name">{{$item->email}}</p></td> 
                            <td><p class="text-ellipsis name">{{$item->address}}</p></td>
                            <td><p class="text-ellipsis name">{{$item->pay_method}}</p></td>
                            <td><p class="text-ellipsis name">{{$item->notes}}</p></td>                                              
                        </tr>
                        @endforeach    
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>

<!-- Chi tiết sản phẩm -->
<div class="container">
    <div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
        Chi tiết sản phẩm
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
                <th>Tên sản phẩm</td>
                <th>Giá</th>
                <th>Số lượng</th>                
            </tr>
            </thead>
            <tbody>     
                        <?php $total_money=0; ?>            
                        @foreach($info_product as $item)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td><p class="text-ellipsis name">{{$item->product_name}}</p></td>
                            <td><p class="text-ellipsis name">{{number_format($item->product_price)}}</p></td>
                            <td><p class="text-ellipsis name">{{$item->product_quantyti}}</p></td>        
                           <?php $total_money=$total_money+$item->product_price*$item->product_quantyti;     ?>                
                        </tr>
                        @endforeach
                        
            </tbody>
            
        </table>
        
        </div>
        <?php echo "Tổng tiền: ".number_format($total_money).' VND' ; ?>
    </div>
    </div>
</div>
@stop