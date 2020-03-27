<!DOCTYPE html>
<html>
@include('inc.header')
<body>
{!! csrf_field() !!}
<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100  p-b-20">
			@if (count($errors) > 0)
				@foreach ($errors->all() as $error)
					<div class="alert alert-danger" role="alert">
						<h5><i class="icon fa fa-ban"></i> Alert!</h5>
						{!! $error !!}
					</div>
				@endforeach
			@endif
			<form  class="form-horizontal" method="POST" action="{{ route('brokers.login.submit') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<span class="login100-form-avatar">
						<img src="{{asset('images/logo_sign.png')}}" alt="AVATAR">
					</span>
				<span class="login100-form-title p-b-20">
						Sign In As Broker
					</span>
				<div class="wrap-input100 validate-input m-t-65 m-b-35" data-validate = "Enter Email">
					<input class="input100 has-val" type="text" name="email" required >
					<span class="focus-input100" data-placeholder="Email"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
					<input class="input100 has-val" type="password" name="password" required>
					<span class="focus-input100" data-placeholder="Password"></span>

				</div>

				<div class="container-login100-form-btn">
					<button class="login100-form-btn"  type="submit"  style="font-family: Poppins-SemiBold, sans-serif; width: 100%;">
						Login
					</button>
				</div>
				<br>
				<ul class="login-more">
					<li class="m-b-8">
							<span class="txt1">
								Forgot
							</span>

						<a href="{{ route('broker.password.request') }}" class="txt2">
							Password?
						</a>
					</li>
			</form>
		</div>
	</div>
</div>
<div id="dropDownSelect1"></div>
</body>
</html>