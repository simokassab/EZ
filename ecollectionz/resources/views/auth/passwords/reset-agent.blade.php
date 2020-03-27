<!DOCTYPE html>
<html>
@include('inc.header')
<body>
{!! csrf_field() !!}
<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100  ">
			@if (count($errors) > 0)
				@foreach ($errors->all() as $error)
					<div class="alert alert-danger" role="alert">
						<h5><i class="icon fa fa-ban"></i> Alert!</h5>
						{!! $error !!}
					</div>
				@endforeach
			@endif
			<form  class="form-horizontal" method="POST" action="{{ route('broker.password.request') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="token" value="{{$token}}">
				<span class="login100-form-avatar">
						<img src="{{asset('images/logo_sign.png')}}" alt="AVATAR">
					</span>
				<span class="login100-form-title p-b-20">
						New Password
				</span>
				<div class="row">
					<div class="col col-sm-12">
						<div class="form-group">
							<label for="email">Email:</label>
							<input id="email" type="email" class="input100 form-control" name="email" value="{{ $email or old('email') }}" required autofocus placeholder="Email">
							@if ($errors->has('email'))
								<span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
							@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col col-sm-12">
						<div class="form-group">
							<label for="password">New Password</label>
							<input id="password" type="password" class="input100 form-control" name="password" required  placeholder="Password">
							@if ($errors->has('password'))
								<span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
							@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col col-sm-12">
						<div class="form-group">
							<label for="password_confirmation">Confirm  Password</label>
							<input id="password-confirm" type="password" class=" input100 form-control" name="password_confirmation" required  placeholder="Confirm Password">
							@if ($errors->has('password_confirmation'))
								<span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
							@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col col-sm-12">
						<div class="container-login100-form-btn">
							<button class="login100-form-btn"  type="submit"  style="font-family: Poppins-SemiBold, sans-serif; width: 100%;">
								Login
							</button>
						</div>
					</div>
				</div>
				<br>
			</form>
		</div>
	</div>
</div>
<div id="dropDownSelect1"></div>
</body>
</html>