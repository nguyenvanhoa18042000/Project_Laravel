<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Thanh toán</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="csrf_token" content="{{ csrf_token() }}">
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/images/favicon.png')}}">
	<!-- Material Design Iconic Font-V2.2.0 -->
	<link rel="stylesheet" href="{{asset('frontend/css/material-design-iconic-font.min.css')}}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
	<!-- Font Awesome Stars-->
	<link rel="stylesheet" href="{{asset('frontend/css/fontawesome-stars.css')}}">
	<!-- Meanmenu CSS -->
	<link rel="stylesheet" href="{{asset('frontend/css/meanmenu.css')}}">
	<!-- owl carousel CSS -->
	<link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
	<!-- Slick Carousel CSS -->
	<link rel="stylesheet" href="{{asset('frontend/css/slick.css')}}">
	<!-- Animate CSS -->
	<link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
	<!-- Jquery-ui CSS -->
	<link rel="stylesheet" href="{{asset('frontend/css/jquery-ui.min.css')}}">
	<!-- Venobox CSS -->
	<link rel="stylesheet" href="{{asset('frontend/css/venobox.css')}}">
	<!-- Nice Select CSS -->
	<link rel="stylesheet" href="{{asset('frontend/css/nice-select.css')}}">
	<!-- Magnific Popup CSS -->
	<link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.css')}}">
	<!-- Bootstrap V4.1.3 Fremwork CSS -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<!-- Helper CSS -->
	<link rel="stylesheet" href="{{asset('frontend/css/helper.css')}}">
	<!-- Main Style CSS -->
	<link rel="stylesheet" href="{{asset('frontend/style.css')}}">
	<!-- Responsive CSS -->
	<link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/toastr/toastr.min.css')}}">
	<link rel="stylesheet" href="{{asset('frontend/css/my_css.css')}}">
	<!-- Modernizr js -->
	<script src="{{asset('frontend/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>
<body>
	<div class="body-wrapper">
		<!-- Navbar -->
		@include('frontend.includes.navbar')
		<!-- /.navbar -->

		<div class="content-header">
			<div class="breadcrumb-area">
				<div class="container">
					<div class="breadcrumb-content">
						<ul>
							<li><a href="{{route('frontend.home')}}">Trang chủ</a></li>
							<li><a href="{{route('frontend.list.cart')}}">Giỏ hàng</a></li>
							<li class="active">Thanh toán</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- /.content-header -->

		<!-- Main content -->
		<section class="content">
			<div class="container wrapper">
				<div class="row cart-head">
					<div class="container">
						<div class="row">
							<p></p>
						</div>
					</div>
				</div>    
				<div class="row cart-body mt-20 mb-60">
					<form class="form-horizontal" method="POST" action="{{route('frontend.save.info.shopping.cart')}}">
						@csrf
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
							<!--REVIEW ORDER-->
							<div class="panel panel-info">
								<div class="panel-heading">
									Danh sách sản phẩm <div class="pull-right"><small><a class="afix-1" href="{{route('frontend.list.cart')}}">Cập nhật</a></small></div>
								</div>
								<div class="panel-body">
									@foreach($products as $product)
									<div class="form-group">
										<div class="col-sm-3 col-xs-3">
											<img style="width: 100px;height: 75px;" class="img-responsive" src="{{asset($product->options->image)}}" />
										</div>
										<div class="col-sm-6 col-xs-6">
											<div class="col-xs-12"><a style="color: #3c9ece" href="{{route('frontend.detail_product',$product->options->slug)}}">{{$product->name}}</a></div>
											<div class="col-xs-12"><small>Số lượng x <span>{{$product->qty}}</span></small></div>
										</div>
										<div class="col-sm-3 col-xs-3 text-right">
											<h6 style="font-weight: normal;color: #e80f0f">{{number_format($product->qty * $product->price)}}₫</h6>
										</div>
									</div>
									<div class="form-group"><hr style="margin: 2%" /></div>
									@endforeach
									<div class="form-group">
										<div class="col-xs-12">
											<strong>Tổng tiền thanh toán : </strong>
											<div class="pull-right"><h6 style="color: #e80f0f">{{\Cart::subtotal()}}₫</h6></div>
										</div>
									</div>
								</div>
							</div>
							<!--REVIEW ORDER END-->
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
							<!--SHIPPING METHOD-->
							<div class="panel panel-info">
								<div class="panel-heading">Thông tin thanh toán</div>
								<div class="panel-body">
									<div class="form-group">
										<div class="col-md-12"><strong>Địa chỉ:</strong></div>
										<div class="col-md-12">
											<input type="text" class="form-control" name="address" value="" />
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12"><strong>Email:</strong></div>
										<div class="col-md-12">
											<input type="email" name="email" class="form-control" value="{{Auth::user()->email}}" />
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12"><strong>Số điện thoại:</strong></div>
										<div class="col-md-12">
											<input type="number" name="phone_number" class="form-control" value="{{Auth::user()->phone}}" />
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12"><strong>Ghi chú:</strong></div>
										<div class="col-md-12">
											<textarea name="note" id="" cols="30" rows="4" class="form-control"></textarea>
										</div>
									</div>
									<div>
										<button class="btn btn-success">Xác nhận thông tin</button>
									</div>
								</div>
							</div>
							<!--SHIPPING METHOD END-->
						</div>

					</form>
				</div>
				<div class="row cart-footer">

				</div>
			</div>
		</section>
		<!-- /.content -->

		<!-- footer -->
		@include('frontend.includes.footer')
		<!-- /.footer -->
	</div>
	<!-- jQuery-V1.12.4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper js -->
    <script src="{{asset('frontend/js/vendor/popper.min.js')}}"></script>
    <!-- Bootstrap V4.1.3 Fremwork js -->
    <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    <!-- Ajax Mail js -->
    <script src="{{asset('frontend/js/ajax-mail.js')}}"></script>
    <!-- Meanmenu js -->
    <script src="{{asset('frontend/js/jquery.meanmenu.min.js')}}"></script>
    <script src="{{asset('frontend/js/slick.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- Isotope js -->
    <script src="{{asset('frontend/js/isotope.pkgd.min.js')}}"></script>
    <!-- Imagesloaded js -->
    <script src="{{asset('frontend/js/imagesloaded.pkgd.min.js')}}"></script>
    <!-- Mixitup js -->
    <script src="{{asset('frontend/js/jquery.mixitup.min.js')}}"></script>
    <!-- Countdown -->
    <script src="{{asset('frontend/js/jquery.countdown.min.js')}}"></script>
    <!-- <script src="{{asset('frontend/js/waypoints.min.js')}}"></script> -->
    <!-- Barrating -->
    <script src="{{asset('frontend/js/jquery.barrating.min.js')}}"></script>
    <!-- Jquery-ui -->
    <script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script>
    <!-- Venobox -->
    <script src="{{asset('frontend/js/venobox.min.js')}}"></script>
    <!-- Nice Select js -->
    <script src="{{asset('frontend/js/jquery.nice-select.min.js')}}"></script>
    <!-- ScrollUp js -->
    <script src="{{asset('frontend/js/scrollUp.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/plugins/toastr/toastr.min.js')}}"></script>
    <!-- Main/Activator js -->
    <script src="{{asset('frontend/js/main.js')}}"></script>
    <script>
	@if(Session::has('message'))
	toastr.options = {
	  "closeButton": true,
	  "progressBar": true,
	  "timeOut": "3000",
	}
	var type="{{Session::get('alert-type')}}"
	switch(type){
	  case 'success':
	    toastr.success("{{ Session::get('message') }}");
	    break;
	  case 'error':
	    toastr.error("{{ Session::get('message') }}");
	    break;
	}
	@endif
	</script>
</body>
</html>
