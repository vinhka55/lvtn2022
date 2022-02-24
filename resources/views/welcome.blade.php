<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('/')}}/public/frontend/css/app.css">
    <title>THỰC PHẨM HỮU NGHỊ| Cung Cấp Thực Phẩm Sỉ Lẻ Uy Tín</title>
</head>
<body>
    <div class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-success">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{url('/')}}">Trang chủ</a>
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
                <form class="d-flex">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-warning" type="submit">Tìm kiếm</button>
                </form>
              </div>
            </div>
        </nav>
    </div>
    <div class="slider-top">
            SẼ BỔ SUNG SAU
        </div>
        <div class="top-content row">
            <div class="col-3">
                <h3>DANH MỤC SẢN PHẨM</h3>
                <ul>
                    @foreach ($category as $cate)
                      <a href="{{route('danh_muc_san_pham',$category->name)}}"><li>{{$cate->name}}</li></a>
                    @endforeach
                </ul>
            </div>
            <div class="col-6">
                <a href=""><img src="{{url('/')}}/public/frontend/images/main-2022-1280-400-qbanner.jpg" alt=""></a>
            </div>
            <div class="col-3">
                <a href=""><img src="{{url('/')}}/public/frontend/images/rLE2AAo.gif" alt="gif image"></a>
            </div>
        </div>
    @yield("content")
    <div class="footer">
        <div class="container-fluid bg-dark text-white border-top pt-3">
            <div class="row">
                <div class="col-md-3 col-6 border-right">
                    <h4 class="font-weight-bold">LIÊN HỆ</h4>
                    <h5>CÔNG TY TNHH XUẤT NHẬP KHẨU THỰC PHẨM HỮU NGHỊ</h5>
                    <p>Địa Chỉ: 9C10 KDC Nam Long, Hà Huy Giáp, KP3, p. Thạch Lộc, Q.12</p>
                    <p>Hotline: 0901 892 899  - MST : 031 333 6061</p>
                    <p>Email : nghivan86@gmail.com</p>
                </div>
                <div class="col-md-3 col-6 border-right">
                    <h4 class="font-weight-bold">ĐĂNG KÝ NHẬN EMAIL</h4>
                    <p>Đăng ký nhận email để nhận tin tức và thông tin khuyến mãi sớm nhất.</p>
                    <form class="form-inline">
                    <div class="form-group mb-2">
                        <input type="password" class="form-control" id="inputPassword2" placeholder="Email">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Đăng ký</button>
                    </form>
                </div>
                <div class="col-md-3 col-6 border-right">
                    <h4 class="font-weight-bold">QUY ĐỊNH CHÍNH SÁCH</h4>
                    <ul>
                        <li>Chính sách bảo mật thông tin</li>
                        <li>Chính sách giao hàng</li>
                        <li>Chính sách đổi trả</li>
                        <li>Chính sách thanh toán</li>
                        <li>Hướng dẫn mua hàng</li>
                    </ul>
                    <img src="https://thucphamhuunghi.com/template/orange/img/logoSaleNoti.png" alt="">
                </div>
            </div>
        </div>
        <div class="container-fluid text-center bg-dark text-white border-top">
            <div id="copyright">© Copyright 2022 lvtn2022-levinhit</div>
        </div>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>