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

  </head>
  <body>

    <nav id="topNav" class="navbar navbar-default navbar-fixed-top">
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
            <div class="navbar-collapse collapse" id="bs-navbar">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#call" id="call">Call</a>
                    </li>
                    <li>
                        <a href="#subscribe" id="subscribe">Subscribe</a>
                    </li>
                    <li>
                        <a href="#selectplan" id="selectplan">selectplan</a>
                    </li>
                    <li>
                        <a href="#dialer" id="dialer">Dialer</a>
                    </li>
                    <li>
                        <a href="#ewallet" id="ewallet">E-Wallet</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{url('auth/logout')}}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        
    </nav>

    @include('modals.confirm_plan')
    @include('modals.payment')
    @include('modals.paypercall')


    <header id="top" class="header">

        <section id="tab_header" class="section">
                @include('tabs.header')
        </section>


        <section id="tab_call" class="bg-05 section">

                @include('tabs.call')
        </section>

        <section id="tab_subscribe" class="bg-04 section">

                @include('tabs.subscribe')
        </section>

        <section id="tab_selectplan" class="container-fluid bg-06 section">

            @include('tabs.selectplan')

        </section>

        <section id="tab_dialer" class="bg-02 section">

                @include('tabs.dialer')

        </section>

        <section id="tab_ewallet" class="bg-03 section">

                @include('tabs.ewallet')

        </section>

    </header>
    <!-- @include('modals.confirm_plan'); -->

    <!--scripts loaded here from cdn for performance -->
    <script src="{{ asset('js/lib/jquery.js') }}"></script>
    <script src="{{ asset('js/lib/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/lib/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/lib/wow.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/plans.js') }}"></script>

        <!-- Custom Theme JavaScript -->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#tab_call").hide();
            $("#tab_subscribe").hide();
            $("#tab_selectplan").hide();
            $("#tab_dialer").hide();
            $("#tab_ewallet").hide();

            $("#header").click(function(){
                $(".section").fadeOut('slow');
                $("#tab_header").delay(400).fadeIn('slow');
            });

            $("#call").click(function(){
                $(".section").fadeOut('slow');
                $("#tab_call").delay(400).fadeIn('slow');
            });

            $("#selectplan").click(function(){
                $(".section").fadeOut('slow');
                $("#tab_selectplan").delay(400).fadeIn('slow');
            });

            $("#dialer").click(function(){
                $(".section").fadeOut('slow');
                $("#tab_dialer").delay(400).fadeIn('slow');
            });
      

            $("#ewallet").click(function(){
                $(".section").fadeOut('slow');
                $("#tab_ewallet").delay(400).fadeIn('slow');
                
                $.ajax({
                      type: 'GET',
                      url: 'api/getwallet',
                      beforeSend:function(){
                        // this is where we append a loading image
                        $('#div_balance').html('<div class="loading"><img src="{{asset("images/loading.gif")}}" alt="Loading..." /></div>');
                      },
                      success:function(response){
                        $('#div_balance').empty();
                        var data = jQuery.parseJSON(response);
                        $('#div_balance').append('<h1 class="text-left"><strong>$'+data['balance']+'</strong></h1>');
                        $('#div_balance').append('<p class="text-left">As of today 7:14pm</p>');
                      },
                      error:function(){
                          
                      }
                });
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