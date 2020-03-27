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


  <style>
    /* Made with love by Mutiullah Samim*/

    @font-face {
        font-family: Poppins-Regular;
        src: url('{{ asset('fonts/poppins/Poppins-Regular.ttf') }}');
    }

    @font-face {
        font-family: Poppins-Medium;
        src: url('{{ asset('fonts/poppins/Poppins-Medium.ttf') }}');
    }

    @font-face {
        font-family: Poppins-Bold;
        src: url('{{ asset('fonts/poppins/Poppins-Bold.ttf') }}');
    }

    @font-face {
        font-family: Poppins-SemiBold;
        src: url('{{ asset('fonts/poppins/Poppins-SemiBold.ttf') }}');
    }
html,body{
font-family: Poppins-Regular, sans-serif;
background-image: url("{{ asset('img/slide-4.jpg') }}");
background-size: cover;
background-repeat: no-repeat;
height: 100%;
}

h3 {
    text-align: center;
    font-family: Poppins-Bold, sans-serif;
}

.container{
height: 100%;
align-content: center;
}

.card{
height: 70%;
margin-top: auto;
margin-bottom: auto;
width: 50%;
background-color: #012F5C !important;
opacity: 0.9;
}

    @media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
        .card {
           max-height: 30% !important;
           margin-top: auto;
           margin-bottom: auto;
           width: 100% !important;
           background-color: #012F5C !important;
           opacity: 0.9;
       }

    }

.card-header h3{
color: white;
}


.input-group-prepend span{
width: 100%;
background-color: #FFC312;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

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