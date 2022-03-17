<div class="container-fluid my-5">
            <div class="slider-top mt-3">
                <img width="100%" src="https://thucphamhuunghi.com/plugins/hinh-anh/banner/horizontal-404x-768-768-q1.webp" alt="top banner">
            </div>
            <div class="top-content row mx-0 px-0 mt-3">
                <div class="cate col-12 col-md-3">
                    <h3 class="p-3 bg-success text-white m-0">DANH MỤC SẢN PHẨM</h3>
                    <ul class="p-3 bg-white text-dark">
                        @foreach ($category as $cate)
                        <a href="{{route('danh_muc_san_pham',$cate->id)}}"><li>{{$cate->name}}</li></a>
                        @endforeach
                    </ul>
                </div>
                <div class="col-12 col-md-6">
                    <img class="img-fluid" src="{{url('/')}}/public/frontend/images/main-2022-1280-400-qbanner.jpg" width="100%" alt="">
                </div>
                <div class="col-12 col-md-3">
                    <a href=""><img src="{{url('/')}}/public/frontend/images/rLE2AAo.gif" class="img-fluid" width="100%" alt="gif image"></a>
                </div>
            </div>
    </div>