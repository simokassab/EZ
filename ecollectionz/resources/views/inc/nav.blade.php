

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('build/css/intlTelInput.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href={{asset('css/animate.css')}}>
    <link rel="stylesheet" type="text/css" href={{asset('dist/css/smart_wizard.css')}}>
    <link rel="stylesheet" type="text/css" href={{asset('dist/css/smart_wizard_theme_circles.css')}}>
    <link rel="stylesheet" type="text/css" href={{asset('dist/css/smart_wizard_theme_arrows.css')}}>
    <link rel="stylesheet" type="text/css" href={{asset('dist/css/smart_wizard_theme_dots.css')}}>

    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('vendor/countdowntime/countdowntime.js')}}"></script>
    <script src="{{asset('dist/js/jquery.smartWizard.min.js')}}"></script>
    <script src="{{asset('vendor/select2/select2.min.js')}}"></script>
    <script src="{{asset('js/wow.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="{{asset('vendor/animsition/js/animsition.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('vendor/select2/select2.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('vendor/daterangepicker/daterangepicker.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('vendor/countdowntime/countdowntime.js')}}"></script>
    <!--===============================================================================================-->

    <style>
        .mySlides1 span {
            color:  #fad500;
            padding-bottom: 15px;
            text-align: center;
        }

        #phone {
            width: 255% !important;
        }
        .HomeSection{
            padding-top: 165px;
            padding-bottom: 0px;
        }
        .mySlides1 p {
            font-weight: bold;
            color: #1d3357;
            margin-bottom: 42px;
        }

        .prev, .next {
            top: 37%;
        }
        .HomeSection .col-md-6.to{
            margin-left: -16%;

        }
        #tofix{
            margin-left: 12%;
        }

        .contact {
            margin-left: 14%;
            margin-right: 25%;
            margin-bottom: 50px;
        }
        @media (max-width: 991px)
        {
            .HomeSection {
                padding-top: 66px;
            }
            .HomeSection .col-md-6.to{
                margin-left: 0;
            }

        }
        @media (max-width: 768px){
            #tofix{
                margin-left: 3%;
            }
            #phone {
                width: 117% !important;
            }

        }
        @media (max-width: 991px){
            .HomeSection .col-md-6.to{
                /*  max-width: 100%;*/
            }
            .mySlides1 span {
                font-size: 13px;
            }
            .mySlides1 p{
                text-align: left;
            }

        }
        @media (min-width: 767px) and (max-width: 991px){
            .HomeSection .col-md-6.to{
                /*   max-width: 50%;*/
            }
        }

    </style>
</head>