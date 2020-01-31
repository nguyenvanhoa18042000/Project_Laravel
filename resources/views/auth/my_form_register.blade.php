<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Đăng kí tài khoản</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="backend/css/css_form_register.css">
</head>
<body>
	<div class="wrapper">
		<div class="header-area">
			<h2>HÒA PHÁT</h2>
			<p>Chúng tôi luôn cố gắng hơn</p>
		</div>
		<div class="social-area">
			<i class="fa fa-dribbble"></i>
			<i class="fa fa-pinterest"></i>
			<i class="fa fa-linkedin"></i>
			<i class="fa fa-twitter"></i>
		</div>
		<div class="form-area">
			<form method="POST" action="{{ route('register') }}">
            @csrf
            	<i class="fa fa-user"></i>
            	<input type="text" name="name" placeholder="Nhập họ và tên..." value="{{ old('name') }}" required>
            	<p style="margin: 0">
            	@error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong style="font-size: 15px;font-style: italic;color: red;">{{ $message }}</strong>
                    </span>
                @enderror
            	</p>

            	<i class="fa fa-envelope"></i>
            	<input type="email" name="email" placeholder="Nhập email đăng kí..." value="{{ old('email') }}" required>
            	<p style="margin: 0">
            	@error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong style="font-size: 15px;font-style: italic;color: red;">{{ $message }}</strong>
                    </span>
                @enderror
            	</p>

            	<i class="fa fa-key"></i>
            	<input type="password" name="password" placeholder="Nhập mật khẩu của bạn..." required>
            	<p style="margin: 0;">
            	@error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong style="font-size: 15px;font-style: italic;color: red;">{{ $message }}</strong>
                    </span>
                @enderror
            	</p>

            	<i class="fa fa-key"></i>
            	<input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu của bạn..." required>
            	
            	<i class="fa fa-phone"></i>
            	<input type="" name="phone" placeholder="Nhập số điện thoại của bạn..." value="{{ old('phone') }}" required>
            	<p style="margin: 0;">
            	@error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong style="font-size: 15px;font-style: italic;color: red;">{{ $message }}</strong>
                    </span>
                @enderror
            	</p>

            	<i class="fa fa-address-card"></i>
            	<input type="text" name="address" placeholder="Nhập địa chỉ của bạn..." value="{{ old('address') }}" required>
            	<p style="margin: 0;">
            	@error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong style="font-size: 15px;font-style: italic;color: red;">{{ $message }}</strong>
                    </span>
                @enderror
            	</p>
            	<a href="{{route('login')}}">Tôi đã có tài khoản</a>
            	<input type="submit" name="" value="Đăng kí">
        	</form>
		</div>
	</div>
</body>
</html>