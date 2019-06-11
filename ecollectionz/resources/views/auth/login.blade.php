
<!DOCTYPE html>
<html>
 @include('inc.header')
<body>
  {!! csrf_field() !!}
<div class="container" >
      @include('inc.messages')
	<div class="d-flex justify-content-center h-100">
		<div class="card">
      <img src="{{ asset('img/logo.png') }}" width="40%" style="margin:2% 0 0 3%;" /><br>
			<div class="card-header">  
				<h3 style="text-align: center;">Sign In As Client</h3>
			</div>
			<div class="card-body">
				<form  class="form-horizontal" method="POST" action="{{ route('login') }}">
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
					</div>
					<div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" required  placeholder="Password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
					</div>
					<div class="row align-items-center remember">
						 <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
					</div>
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center">
					<a style="color: white" href="{{ route('password.request') }}">Forgot your password?</a>
				</div>
                <a class="btn btn-danger btn-block btn-flat" href='./register' >Sign UP</a>
      </div>
      <br/>
     
		</div>
	</div>
</div>
</body>
</html>