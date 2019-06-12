<head>
    <link href="{{ asset('images/favicon.png') }}" rel="shortcut icon" type="image/png">
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet">
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" 
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{asset('build/css/intlTelInput.css') }}">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

  <style>
    /* Made with love by Mutiullah Samim*/


html,body{
background-image: url("{{ asset('img/slide-4.jpg') }}");
background-size: cover;
background-repeat: no-repeat;
height: 100%;
}

.container{
height: 100%;
align-content: center;
}



.card{
height: 550px;
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
.alert {
  margin-top: 1%;
  position: absolute;
}

  </style>
    <script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>

</head>