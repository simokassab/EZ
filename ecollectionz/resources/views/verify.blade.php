<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Verify your number</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <style>
    /* Made with love by Mutiullah Samim*/

@import url('https://fonts.googleapis.com/css?family=Numans');

html,body{
background-image: url('http://ecollectionz.online/assets/images/slider/slide-4.jpg');
background-size: cover;
background-repeat: no-repeat;
height: 100%;
font-family: 'Numans', sans-serif;
}

.container{
height: 100%;
align-content: center;
}

.card{
height: 370px;
margin-top: auto;
margin-bottom: auto;
width: 400px;
background-color: #012F5C !important;
opacity: 0.9;
}

.social_icon span{
font-size: 60px;
margin-left: 10px;
color: #FFC312;
}

.social_icon span:hover{
color: white;
cursor: pointer;
}

.card-header h3{
color: white;
}

.social_icon{
position: absolute;
right: 20px;
top: -45px;
}

.input-group-prepend span{
width: 50px;
background-color: #FFC312;
color: black;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: black;
background-color: #FFC312;
width: 100px;
}

.login_btn:hover{
color: black;
background-color: white;
}

.links{
color: white;
}

.links a{
margin-left: 4px;
}

  </style>
</head>
<body>
  {!! csrf_field() !!}
<div class="container">  

	<div class="d-flex justify-content-center h-100">
		<div class="card">
      <img src="{{ asset('img/logo.png') }}" width="40%" style="margin:2% 0 0 3%;" /><br>
     
			<div class="card-header">  
				<h3 style="text-align: center;">Verify your Number</h3>
			</div>
			<div class="card-body">
				<form  class="form-horizontal" method="POST" action="{{ route('verify') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
                        <input id="code" type="text" class="form-control" name="code" required  placeholder="Code">
                    </div>
					<div class="form-group">
                    <button type="submit" class="btn float-right login_btn">Verify</button>
					</div>
				</form>
            </div>
            <div class="card-footer">
                <a href="./{{request()->phone}}/resendcode/" class="text-center " style="color:#FFC312;">Request new Code</a>
                <input type="hidden" name='phone' value="{{request()->phone}}">
            </div>
						<br><br><br>
						@if (\Session::has('success'))
								<div class="alert alert-success">
										<ul>
												<li>{!! \Session::get('success') !!}</li>
										</ul>
								</div>
						@endif
      <br/>
		</div>
	</div>
</div>
</body>
</html>