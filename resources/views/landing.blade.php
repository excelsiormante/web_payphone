<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <title>Web Payphone Services</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Codeply">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css') }}" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.1.1/animate.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
    <link rel="stylesheet" href="{{asset('css/styles2.css')}}" />
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/simple-sidebar.css')}}" rel="stylesheet">
    <link href="{{ asset('css/loading.css')}}" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/subscribe-flip.css')}}" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

  </head>

   <body>

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="" id="header"><img src="{{asset('images/logo.png')}}" class="img-responsive pull-left"><font color="white"> WebPayPhone</font></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <!-- <a href="{{url('auth/logout')}}">Logout</a>  -->
                           <li>
                            <a href="{{url('auth/register')}}" id="call" class="navigate">Register</a>
                            </li>
                            <li>
                                <a href="{{url('auth/login')}}" id="subscribe" class="navigate">Login</a>
                            </li>

                        </li>
                    </ul>
                </div>
            </div>

        </nav>

        <header id="top" class="header">

            <section id="tab_header" class="section">

                    <div class="header-content">
                        <div class="inner">
                            <h1>Call from the Web Payphone</h1>
                            <h4>Call anywhere from the world through our web call services. Hassle no more on payments, you can pay your subscriptions through paypal, paymaya and other payment services</h4>
                            <hr>
                             <a href="#one" class="btn btn-primary btn-xl buycredits">Get Started</a>
                        </div>
                    </div>
                    <video autoplay="" loop="" class="fillWidth fadeIn wow collapse in" data-wow-delay="0.5s" poster="https://s3-us-west-2.amazonaws.com/coverr/poster/Traffic-blurred2.jpg" id="video-background">
                        <source src="https://s3-us-west-2.amazonaws.com/coverr/mp4/Traffic-blurred2.mp4" type="video/mp4">Your browser does not support the video tag. I suggest you upgrade your browser.
                    </video>

            </section>
             
        </header>


    <script src="{{ asset('js/lib/jquery.js') }}"></script>
    <script src="{{ asset('js/lib/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/lib/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/lib/wow.js') }}"></script>
    <script src="{{ asset('js/lib/sidebar.js') }}"></script>

    </body>


</html>
