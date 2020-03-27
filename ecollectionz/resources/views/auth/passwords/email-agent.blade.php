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
			<form  class="form-horizontal" method="POST" action="{{ route('broker.password.email') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<span class="login100-form-avatar">
						<img src="{{asset('images/logo_sign.png')}}" alt="AVATAR">
					</span>
					<span class="login100-form-title p-b-30">
						Reset Password
					</span>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="email">Email: </label>
								<input id="email" type="email" class="input100 form-control" name="email" value="{{ old('email') }}" required>
								@if ($errors->has('email'))
									<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
								@endif
							</div>
							<br>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<button type="submit" class="login100-form-btn">Send Password Reset Link</button>
								@if (session('status'))
									<div class="alert alert-success" style='z-index:10;' >
										{{ session('status') }}
									</div>
								@endif
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