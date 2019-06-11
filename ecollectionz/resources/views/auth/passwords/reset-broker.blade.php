<!DOCTYPE html>
<html>
 @include('inc.header')
<body>
<div class="container">
       @if (count($errors) > 0)
          @foreach ($errors->all() as $error)
          <div class="alert alert-danger" role="alert">
                  <h5><i class="icon fa fa-ban"></i> Alert!</h5>
                   {!! $error !!}
                </div>
          @endforeach
        @endif
	<div class="d-flex justify-content-center h-100">
		<form class="form-horizontal" method="POST" action="{{ route('broker.password.request') }}" >
		<div class="card">
      <img src="{{ asset('img/logo.png') }}" width="40%" style="margin:2% 0 0 3%;" /><br>
			<div class="card-header">  
				<h3 style="text-align: center;">Broker Reset Password</h3>
			</div>
			<div class="card-body">

					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="token" value="{{$token}}">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus placeholder="Email">
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
					<div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required  placeholder="Confirm Password">
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
					</div>
			</div>
			<div class="card-footer">
				<div class="form-group">
						<input type="submit" value="Reset Password" class="btn float-right btn-warning">
				</div>
		  	</div>

			  <br/>
		</div>
		</form>
	</div>
</div>
</body>
</html>
