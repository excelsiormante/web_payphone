<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Web Payphone Services</title>
    <meta name="description" content="This is a free Bootstrap landing page theme created for BootstrapZero. Feature video background and one page design." />
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
                <a class="navbar-brand" href="#one" id="header"><img src="{{asset('images/logo.png')}}" class="img-responsive pull-left"><font color="white"> WebPayPhone</font></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#call" id="call" class="navigate">Call</a>
                    </li>
                    <li>
                        <a href="#subscribe" id="subscribe" class="navigate">Subscribe</a>
                    </li>
                    <li>
                        <a href="#selectplan" id="selectplan" class="navigate">selectplan</a>
                    </li>
                    <li>
                        <a href="#dialer" id="dialer" class="navigate">Dialer</a>
                    </li>
                    <li>
                        <a href="#ewallet" id="ewallet" class="navigate">E-Wallet</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                       <!-- <a href="{{url('auth/logout')}}">Logout</a>  -->


                    </li>
                </ul>
            </div>
        </div>

        <button type="button" class="hamburger is-open" data-toggle="offcanvas">
                            <span class="hamb-top"></span>
                            <span class="hamb-middle"></span>
                            <span class="hamb-bottom"></span>
                        </button>

    </nav>
    
    @extends('layouts.section')
    @section('content')
        
    @include('modals.confirm_plan')
    @include('modals.add_speed_dial')
    @include('modals.payment')
    @include('modals.paypercall')

   

    <header id="top" class="header">

        <section id="tab_header" class="section">
                @include('tabs.header')
        </section>


        <section id="tab_subscribe" class="bg-04 section">

                @include('tabs.subscribe')
        </section>


        <section id="tab_selectplan" class="bg-01 section">

                @include('tabs.selectplan')
        </section>

        <section id="tab_dialer" class="bg-02 section">

                @include('tabs.dialer')
        </section>

        <section id="tab_call" class="bg-05 section">

                @include('tabs.call')
        </section>

        <section id="tab_ewallet" class="bg-03 section">

                @include('tabs.ewallet')

        </section>

         
    </header>

    <div class="overlay">
        <div class="centered-loading">
        <div class="cssload-loader"><div class="cssload-inner cssload-one"></div><div class="cssload-inner cssload-two"></div><div class="cssload-inner cssload-three"></div></div>
        </div>
    </div>

    @endsection
   
    <!-- @include('modals.confirm_plan'); -->

    <!--scripts loaded here from cdn for performance -->
    <script src="{{ asset('js/lib/jquery.js') }}"></script>
    <script src="{{ asset('js/lib/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/lib/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/lib/wow.js') }}"></script>
    <script src="{{ asset('js/lib/sidebar.js') }}"></script>
    <script src="{{ asset('js/call.js') }}"></script>
    <script src="{{ asset('js/mywallet.js') }}"></script>
    <script src="{{ asset('js/plans.js') }}"></script>
    <script src="{{ asset('js/myplan.js') }}"></script>
   <!-- <script src="{{ asset('js/lib/subscribe-flip.js') }}"></script> -->


        <!-- Custom Theme JavaScript -->
    <script type="text/javascript">
        $(document).ready(function(){

            //$('.navigate').click(function() {
                //$('body').css('background-image', 'url(images/bg-01.jpg)');
              //  $('body').addClass("bg-02");
              //});

            $("#tab_subscribe").hide();
            $("#tab_ewallet").hide();
            $("#tab_call").hide();
            $("#tab_dialer").hide();
            $("#tab_selectplan").hide();

            overlay = $('.overlay'),

            //tabs
            $("#dialer").click(function(){
                $(".section").fadeOut('slow');
                $("#tab_dialer").delay(400).fadeIn('slow');
            });

            $("#header").click(function(){
                $(".section").fadeOut('slow');
                $("#tab_header").delay(400).fadeIn('slow');
            });

            //dialer
            $('.num').click(function () {
                var num = $(this);
                var text = $.trim(num.find('.txt').clone().children().remove().end().text());
                var telNumber = $('#telNumber');
                $(telNumber).val(telNumber.val() + text);
            });


            $('.num-delete').click(function () {
                var str = $('#telNumber').val();
                $('#telNumber').val(str.substring(0, str.length - 1));
            });

            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });

        });

    </script>

    
  </body>

   

</html>