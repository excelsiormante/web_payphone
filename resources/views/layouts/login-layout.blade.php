<!DOCTYPE html>
<html>
    <head>
        <title>PLDT Web Payphone</title>

         <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
         <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
         <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
          <script type="text/javascript" src="{{ asset('js/lib/jquery.js') }}"></script>
         <script type="text/javascript" src="{{ asset('js/lib/bootstrap.min.js') }}"> </script>
         <script type="text/javascript" src="{{ asset('js/lib/jquery-ui.min.js') }}"> </script>
    </head>

    <style>

       body {
                
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                position: relative;
                background: url(../images/<?php echo $selectedBg ?>) no-repeat center center scroll;
                background-attachment: fixed;
                background-size: cover;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
               
                }
                
    </style>

    
        <body>

             <nav class="navbar  navbar-inverse  navbar-fixed-top navbar-transparent">
              <div class="container">
              <button type="button" class="navbar-toggle"
              data-toggle="collapse"
              data-target=".navbar-collapse"
              >
              <span class="sr-only"> Toggle navigation</span>
              <span class="icon-bar"> </span>
              <span class="icon-bar"> </span>
              <span class="icon-bar"> </span>
              </button>
              
               <a class="navbar-brand" href="{{url('/')}}"><img src="{{URL::asset('images/logo.png')}}" class="img-responsive pull-left"><font color="white">WebPayPhone</font></a>
               
                   <div class="navbar-collapse collapse">
                       <ul class="nav navbar-nav navbar-right">
                         <li><a href="#" class="btn btn-round color3"><font color ="white">Want to buy credits?</font></a></li>
                         <li class=""><a href="#" class="button getcredits"><font color ="white">Get Free Credits </font></a></li>  
                       </ul>
                   </div>
              </div>
            </nav>


                    
             @yield('content');

              

  <div class="navbar  navbar-inverse navbar-fixed-bottom footer-opacity"> 
     <div class="container">
        <div class="col-md-3"></div>
       <div class="navbar-text footer-line col-md-4 centered">
        <p><a href="#"><font color="white">CLICK HERE </font></a><font color="white">to see credits needed for countries you want to call</font></p>
       </div>
          
     </div>
   </div>



        </body>
   

</html>
