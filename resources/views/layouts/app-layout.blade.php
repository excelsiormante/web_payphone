   
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

     
     {{ Form::hidden('landing_tab', $landing_tab) }}

     @if(Session::has('payment_success'))
     <div class="payment-alert notify successbox">
        <h4>Success!</h4>
        <p style="font-size:13px">Payment Successful</p>
    </div>
    @endif
    @if(Session::has('payment_fail'))
    <div class="payment-alert notify errorbox">
        <h4>Failed!</h4>
        <p style="font-size:13px">Payment attempt fail</p>
    </div>
    @endif

    <div class="shadow"></div>
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

 
    <div id="wrapper" class="toggled">
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
               <div class="row">
                        <div class="mediaprofile">
                            <a class="pull-left" href="#">
                                <img class="media-object dp img-circle" src="http://afirmio.com/wp-content/uploads/2014/10/maleprofilecircle2.jpg" style="width: 100px;height:100px;">
                            </a>
                            <div class="media-body text-center">
                                <h4 class="media-heading"><?php echo $fullname;  ?></h4>
                                <h5>E-Wallet Balance<br><strong><font color="#04ff00">$<?php echo $balance; ?></font></strong></h5>
                                <hr style="margin:8px auto">
                                <div class="col-md-6">
                                    <a class="btn btn-primary" href="#" id="profile-edit" style="font-size:10px">Edit Profile</a>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-primary" href="{{url('auth/logout')}}" style="font-size:10px">Logout</a>
                                </div>
                                
                                

                            </div>
                        </div>
                </div>

                 <!-- Contacts, Dial and recent -->
                 <div class="col-md-12 text-center bhoechie-tab-container">

                    <div class="list-group list-group-horizontal bhoechie-tab-menu">
                        <a href="#" class="list-group-item active text-center">
                        <div class="col-md-4">
                          <h4 class="glyphicon glyphicon-star-empty"></h4><br/>Recent
                        </div>
                        </a>
                        <a href="#" class="list-group-item text-center">
                        <div class="col-md-4">
                          <h4 class="glyphicon glyphicon-th-list"></h4><br/>Contacts
                        </div>
                        </a>
                        <a href="#" class="list-group-item text-center">
                        <div class="col-md-4">
                          <h4 class="glyphicon glyphicon-th"></h4><br/>Dial
                        </div>
                        </a>
                       
                    </div>


                     <div class="col-md-12 bhoechie-tab">
            
                        <div class="bhoechie-tab-content active" id="div_dialed_number"></div>
            
                        <div class="bhoechie-tab-content">
                           <a href="#">
                                <div class="media-body">
                                    <div class="col-md-3">
                                        <img class="media-object img-circle" src="http://mysunrisetravel.com/wp-content/uploads/2015/07/placeholder-profile-male.jpg" style="width: 50px;height:50px;">
                                    </div>
                                    <div class="col-md-9">
                                        <h4 class="pull-left" style="margin-top:0px">09955505018</h4><br>
                                        <h5 class="text-left"><span class="glyphicon glyphicon-earphone" style="color:#04ff00"></span><strong>&nbsp;&nbsp; Call</strong></h5>
                                    </div>
                                </div>
                            </a>
                            <a href="#">
                                <div class="media-body">
                                    <div class="col-md-3">
                                        <img class="media-object img-circle" src="http://mysunrisetravel.com/wp-content/uploads/2015/07/placeholder-profile-male.jpg" style="width: 50px;height:50px;">
                                    </div>
                                    <div class="col-md-9">
                                        <h4 class="pull-left" style="margin-top:0px">09955505018</h4><br>
                                        <h5 class="text-left"><span class="glyphicon glyphicon-earphone" style="color:#04ff00"></span><strong>&nbsp;&nbsp; Call</strong></h5>
                                    </div>
                                </div>
                            </a>
                            <a href="#">
                                <div class="media-body">
                                    <div class="col-md-3">
                                        <img class="media-object img-circle" src="http://mysunrisetravel.com/wp-content/uploads/2015/07/placeholder-profile-male.jpg" style="width: 50px;height:50px;">
                                    </div>
                                    <div class="col-md-9">
                                        <h4 class="pull-left" style="margin-top:0px">09955505018</h4><br>
                                        <h5 class="text-left"><span class="glyphicon glyphicon-earphone" style="color:#04ff00"></span><strong>&nbsp;&nbsp; Call</strong></h5>
                                    </div>
                                </div>
                            </a>
                        </div>
            
                        <!-- hotel search -->
                        <div class="bhoechie-tab-content">
                            <center>
                                <img class="media-object img-circle" src="http://mysunrisetravel.com/wp-content/uploads/2015/07/placeholder-profile-male.jpg" style="width: 50px;height:50px;">
                            </center>
                        </div>
                    </div>

                </div>

                <!-- Edit profile tab -->
                <div class="col-md-12 profile-form">
                    <div class="row">
                        <a href="#" class="btn btn-primary pull-right" style="border:0px; font-size:14px;" id="return-contacts"><span class="fa fa-arrow-left fa-2x"></span></a>
                        <div class="col-md-12">
                            <h4 class="page-header" style="margin-top:0px">Profile</h4>
                            <form role="form" id="formprofile">
                                <div class="form-group float-label-control">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
                                </div>
                                <div class="form-group float-label-control">
                                    <label for="">Middle Name</label>
                                    <input type="text" class="form-control" name="middlename" placeholder="Middle Name" required>
                                </div>
                                <div class="form-group float-label-control">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
                                </div>
                                <div class="form-group float-label-control">
                                    <label for="">Mobile Number</label>
                                    <input type="number" class="form-control" name="mobileno" placeholder="Mobile Number" required>
                                </div>
                                <div class="form-group float-label-control">
                                    <label for="">Gender</label>
                                        <div class="radio">
                                          <label class="radio-inline"><input type="radio" name="gender" value="male" required>Male</label>
                                        </div>
                                        <div class="radio">
                                          <label class="radio-inline"><input type="radio" name="gender" value="female" required>Female</label>
                                        </div>
                                </div>
                                <div class="form-group float-label-control">
                                    <label for="">Birth Date</label>
                                    <input type="text" class="form-control" name="birthdate" placeholder="Birthdate" required>
                                </div>

                                <div class="form-group float-label-control">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="Address" required>
                                </div>

                                <div class="form-group float-label-control">
                                    <label for="">City</label>
                                    <input type="text" class="form-control" name="city" placeholder="City" required>
                                </div>
                                <div class="form-group float-label-control">
                                    <label for="">State</label>
                                    <input type="text" class="form-control" name="state" placeholder="State" required>
                                </div>    
                                <div class="form-group float-label-control">
                                    <label for="">Postal Code</label>
                                    <input type="text" class="form-control" name="postal" placeholder="Postal Code" required>
                                </div>
                                <div class="form-group float-label-control">
                                    <label for="">Country</label>
                                    <select class="form-control" id="country" name="country" required></select>
                                </div>

                                <button type="submit" class="btn btn-primary pull-right">Submit</button>

                            </form>
                        </div>
                    </div>

                </div>

            </ul>
        </nav>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
           

            @yield('content')

        </div>
    </div>
    <!-- /#wrapper -->



     <!-- @include('modals.confirm_plan'); -->

    <!--scripts loaded here from cdn for performance -->
    <script src="{{ asset('js/lib/jquery.js') }}"></script>
    <script src="{{ asset('js/lib/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/lib/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/lib/wow.js') }}"></script>
    <script src="{{ asset('js/lib/sidebar.js') }}"></script>
    <script src="{{ asset('js/lib/countries.js') }}"></script>
    <script src="{{ asset('js/call.js') }}"></script>
    <script src="{{ asset('js/mywallet.js') }}"></script>
    <script src="{{ asset('js/plans.js') }}"></script>
    <script src="{{ asset('js/myplan.js') }}"></script>
    <script src="{{ asset('js/dialer.js') }}"></script>
    <script src="{{ asset('js/profile.js') }}"></script>
   <!-- <script src="{{ asset('js/lib/subscribe-flip.js') }}"></script> -->


        <!-- Custom Theme JavaScript -->
    <script type="text/javascript">
        $(document).ready(function(){

            $( ".payment-alert" ).delay(5000).fadeOut(4000);
            
            $('.navigate').click(function() {
                //$('body').css('background-image', 'url(images/bg-01.jpg)');
                var num = Math.floor(Math.random() * (6 - 1 + 1)) + 1;
                //$('.dark_fade').delay(500).fadeIn('fast');
                $('body').removeClass('bg-01 bg-02 bg-03 bg-04 bg-05 bg-06');
                $('body').addClass("bg-0"+num+"");
                //$('.dark-fade').fadeOut('fast');

              });  

             //edit profile
            $(".profile-form").hide();

            //overlay
            $("#dark_fade").hide();

            //tabs
            $("#tab_ewallet").hide();
            $("#tab_call").hide();
            $("#tab_dialer").hide();
            $("#tab_selectplan").hide();

            //sidebar contacts
            $('#return-contacts').click(function(){
                $(".profile-form").delay(50).fadeOut('fast');
                $(".bhoechie-tab-container").delay(50).fadeIn('fast');
            });

            overlay = $('.overlay');

            $("#header").click(function(){
                
            });

            //toggle sidebar
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });

            //trigger subscribe click event on login success
            $( "#subscribe" ).trigger( "click" );            

        });

    </script>

    
  </body>

   

</html>



