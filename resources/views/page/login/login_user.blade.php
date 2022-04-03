<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css"/>

    <title>Giỏ hàng của bạn</title>

	<style>
		.or{
			background: #198754;
			border-radius: 40px;
			color: #FFFFFF;
			font-family: 'Roboto', sans-serif;
			font-size: 16px;
			height: 50px;
			line-height: 50px;
			margin-top: 5px;
			text-align: center;
			width: 50px;
		}
	</style>
    <style>
        .hover-cart {
            border-radius: 8%;
            margin-top: 4px;
            width: 126px;
            background-color: greenyellow;
            position: absolute;
            display: none;
        }
        .content-cart-menu:hover .hover-cart{
        display: inherit;
        }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll font-weight-bold" style="--bs-scroll-height: 100px;">
              <li class="nav-item border-end border-light">
                <a class="nav-link active" aria-current="page" href="{{url('/')}}">TRANG CHỦ</a>
              </li>
              <li class="nav-item border-end border-light">
                <a class="nav-link" href="#">GIỚI THIỆU</a>
              </li>
              <li class="nav-item border-end border-light">
                <a class="nav-link" href="#">SẢN PHẨM</a>
              </li>
              <li class="nav-item border-end border-light">
                <a class="nav-link" href="#">TIN TỨC</a>
              </li>
              <li class="nav-item border-end border-light">
                <a class="nav-link" href="#">DỊCH VỤ</a>
              </li>
              <li class="nav-item border-end border-light">
                <a class="nav-link" href="#">LIÊN HỆ</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    <section id="form"><!--form-->
	<h3 class="text-center p-2 mt-2 bg-success text-white">Hãy đăng nhập hoặc đăng kí một tài khoản để có thể mua hàng</h3>
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<div class="container-fluid my-2">
			<div class="row p-0 m-0">
				<div class="col-12 col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2 class="p-2 m-0 bg-success text-white">Đăng nhập</h2>						
						<form action="{{route('handle_login_customer')}}" method="post">
							@csrf
							<input class="form-control mt-1" type="email" name="email" placeholder="Email Address" />
                            <input class="form-control mt-1" type="password" name="password" placeholder="Password" />
							<p>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</p>
							<button  type="submit" class="btn btn-primary">Login</button>							
							<p><a href="{{route('login_google')}}">Login with google account</a></p>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-12 col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-12 col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2 class="p-2 m-0 bg-success text-white">Đăng kí mới</h2>
						
						<form action="{{route('register_customer')}}" method="post">
                            @csrf
							<input class="form-control mt-1" type="text" name='name' placeholder="Name"/>
							<input class="form-control mt-1" type="email" name='email' placeholder="Email Address"/>
							<input class="form-control mt-1" type="password" name='password' placeholder="Password"/>
                            <input class="form-control mt-1" type="password" name='repassword' placeholder="Retype Password"/>
                            <input class="form-control mt-1" type="text" name='phone' placeholder="Phone"/>
							<button type="submit" class="btn btn-primary mt-1">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	</body>
	  <!-- Swiper JS -->
	  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>