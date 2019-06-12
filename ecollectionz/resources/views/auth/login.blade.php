
<body>

<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
			<img src="./images/logo.png" width="30%" style="margin:2% 0 0 3%;" />
			<div class="login100-form-title">
					<span class="login100-form-title-1">
						Sign In as CLIENT
					</span>
			</div>
			<hr>
			<form  class="form-horizontal" method="POST" action="{{ route('login') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
					<span class="label-input100">Email</span>
					<input class="input100" type="text" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter Email">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
					<span class="label-input100">Password</span>
					<input class="input100" type="password" name="password" placeholder="Enter password">
					<span class="focus-input100"></span>
				</div>

				<div class="flex-sb-m w-full p-b-30">
					<div>
						<a href="{{ route('password.request') }}" class="txt1">
							Forgot Password?
						</a>
					</div>
				</div>

				<div class="container-login100-form-btn">
					<button class="btn btn-warning" style='width:100%;'>
						Login
					</button>
				</div>
				<hr>

			</form>
			<hr>
			<center style='color:white'>Don't have an Account?! </center>
			<a class="btn btn-warning btn-block btn-flat" href='./register' >Sign UP</a>
		</div>
	</div>
</div>

<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>
</html>