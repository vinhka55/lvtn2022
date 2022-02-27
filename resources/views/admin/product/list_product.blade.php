@extends("admin.admin_layout")
@section("admin_page")
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách sản phẩm
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
            <th>Hình ảnh</td>
            <th>Tên sản phẩm</th>
            <th>Giá</th>           
            <th>Trạng thái</th>
            <th>Danh mục</th>
            <th>Còn lại</th>
            <th>Đã bán</th>
            <th>Hạn dùng</th>
            <th>action</th>
          </tr>
        </thead>
        <tbody>
                      
                    @foreach($product as $item)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td><p class="text-ellipsis name"><img width="35%" src="{{url('/')}}/public/uploads/product/{{$item->image}}" alt="product"></p></td>
                        <td><p class="text-ellipsis name">{{$item->name}}</p></td>
                        <td><p class="text-ellipsis name">{{number_format((int)$item->price)}}</p></td>                       
                        <td><span class="text-ellipsis desc">
                            @if($item->status=='1')<a title="click to edit" href="{{route('edit_status_product',$item->id)}}"><i class="far fa-thumbs-up"></i></a>
                            @else <a title="click to edit" href="{{route('edit_status_product',$item->id)}}"><i class="far fa-thumbs-down"></i></a>
                            @endif
                        </span></td>
                        <td><span class="text-ellipsis desc">
                            @foreach($category as $cate)
                                @if($cate->id==$item->category_id)
                                {{$cate->name}}
                                @endif
                            @endforeach
                        </span></td>
                        <td><p class="text-ellipsis">{{$item->count}}</p></td>
                        <td><p class="text-ellipsis">{{$item->count_sold}}</p></td>
                        <td><span class="text-ellipsis">{{ $item->exp }}</span></td>
                        <td>
                        <a title="click to edit" href="" ><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                        <a title="click to delete" onclick="return confirm('Are you sure?')" href="{{route('delete_product',$item->id)}}"><i class="fa fa-times text-danger text"></i></a>
                        </td>
                    </tr>
                    @endforeach
            
        </tbody>
      </table>
    </div>
    
    
  </div>
</div>

@stop