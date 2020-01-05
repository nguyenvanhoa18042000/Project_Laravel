<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="frontend/css/css_registration.css">
</head>
<body>
	<div id="snow">
	<div class="box">
		<!-- <img src="public/public_blog/images/avatar_doraemon.jpg" class="avatar"> -->
		<h1>Đăng kí</h1>
		<form method="POST" action="{{ route('register') }}">
			@csrf
			<input required type="text" name="name" placeholder="Họ và tên">
			<input required type="email" name="email" placeholder="Email">
			<input required type="text" name="phone" placeholder="Số điện thoại">
			<input required type="text" name="address" placeholder="Địa chỉ">
			<input required type="password" name="password" placeholder="Mật khẩu">
			<input type="submit" name="submit" value="Đăng ký">
			<a href="#">Quên mật khẩu</a>
		</form>
	</div>
	</div>
</body>
</html>
<script type="text/javascript" src="frontend/js/particles.js"></script>
<script type="text/javascript" src="frontend/js/app.js"></script>