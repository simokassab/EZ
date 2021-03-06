<!DOCTYPE html>
<html>
 @include('inc.header')
<body>
  {!! csrf_field() !!}
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
		<div class="card">
      <img src="{{ asset('img/logo.png') }}" width="40%" style="margin:2% 0 0 3%;" /><br>
			<div class="card-header">  
				<h3 style="text-align: center;">Broker Reset Password</h3>
			</div>
			<div class="card-body">
			
			<form class="form-horizontal" method="POST" action="{{ route('broker.password.email') }}">
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-warning">Send Password Reset Link</button>
						@if (session('status'))
                        <div class="alert alert-success" style='z-index:10;' >
                            {{ session('status') }}
                        </div>
				</div>
				</form>
			</div>
			<div class="card-footer">
				
			 </div>
			  <br/>
    		</div>
	</div>
</div>
</body>
</html>
