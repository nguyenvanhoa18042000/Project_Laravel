<!DOCTYPE html>
<html>
<head>
	<title>Đăng nhập</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="backend/css/css_form_login.css">
</head>
<body>
	<div class="title"><h1>SIGN IN FORM</h1></div>
	<div class="container">
		<div class="left"></div>
		<div class="right">
			<div class="formBox">
				<form method="POST" action="{{ route('login') }}">
                    @csrf
					<p>Email</p>
					<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
					@error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

					<p>Password</p>
					<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
					<input type="submit" name="" value="Sign In">
					<a href="#">Forget Password</a>
				</form>
			</div>
		</div>
	</div>
</body>
</html>