<!DOCTYPE html>
<html>
    <head>
        <title>PLDT Web Payphone</title>

         <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
         <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
          <script type="text/javascript" src="{{ asset('js/lib/jquery.js') }}"></script>
         <script type="text/javascript" src="{{ asset('js/lib/bootstrap.min.js') }}"> </script>
         <script type="text/javascript" src="{{ asset('js/lib/jquery-ui.min.js') }}"> </script>

        <style>
            html, body {
                height: 100%;
            }

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



                        .white{
                color:#000;
                background-color:#fff;
            }

            .btn-facebook {
                color: #ffffff;
                -webkit-text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
                text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
                background-color: #2b4b90;
                *background-color: #133783;
                background-image: -moz-linear-gradient(top, #3b5998, #133783);
                background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#3b5998), to(#133783));
                background-image: -webkit-linear-gradient(top, #3b5998, #133783);
                background-image: -o-linear-gradient(top, #3b5998, #133783);
                background-image: linear-gradient(to bottom, #3b5998, #133783);
                background-repeat: repeat-x;
                border-color: #133783 #133783 #091b40;
                border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff3b5998', endColorstr='#ff133783', GradientType=0);
                filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
            }

                .btn-facebook:hover,
                .btn-facebook:focus,
                .btn-facebook:active,
                .btn-facebook.active,
                .btn-facebook.disabled,
                .btn-facebook[disabled] {
                    color: #ffffff;
                    background-color: #133783 !important;
                    *background-color: #102e6d !important;
                }

                .btn-facebook:active,
                .btn-facebook.active {
                    background-color: #0d2456 \9 !important;
                }



            .panel-transparent {
                background: none;
                border: 0px;
            }

            .panel-transparent .panel-heading{
                background: rgba(122, 130, 136, .5)!important;
                border: 0px;
            }

            .panel-transparent .panel-body{
                background: rgba(46, 51, 56, .5)!important;
            }


            .top-buffer{
                margin-top: 8em;
            }

            .navbar-transparent{
                background: rgba(46, 51, 56, .5)!important;
                border: 0px;
            }

            .footer-opacity{
                background: rgba(0, 0, 0, 0.5)!important;
                border: 0px;
            }
            .footer-line{
                white-space: nowrap;

            }



            .wrap {
                  position: absolute;
                  top: 50%;
                  left: 50%;
                  margin-top: -86px;
                  margin-left: -89px;
                  text-align: center;
                }

                a.getcredits{
                  -webkit-transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
                  -moz-transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
                  -ms-transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
                  -o-transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
                  transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
                  display: block;
                  margin: 10px;
                  max-width: 180px;
                  text-decoration: none;
                  border-radius: 0px;
                  padding: 0px 0px 0px 0px;
                }

                a.button {
                  color: rgba(255, 255, 255, 0.6);
                  box-shadow: rgba(255, 255, 255, 5) 0 0px 0px 2px inset;
                }

                a.button:hover {
                  color: rgba(255, 255, 255, 0.85);
                  box-shadow: rgba(30, 22, 54, 0.7) 0 0px 0px 40px inset;
                }


                .btn-round.color3 {
                    background-color:#FFB745;
                    border-color:#FFB745;
                }


                .btn.btn-round {
                    margin: 10px auto;
                    padding: 8px 25px;   
                    text-shadow: none;
                    box-shadow: none;
                    transition: all 0.12s linear 0s !important; 
                    color: #fff;
                    font-weight: 600;   
                    border-radius: 20px;
                        -webkit-border-radius: 20px;
                        -moz-border-radius: 20px;
                }


                .btn.btn-round:focus, .btn.btn-round:hover {
                    color:#fff;   
                }





/*=========================
  Icons
 ================= */

/* footer social icons */
ul.social-network {
    list-style: none;
    display: inline;
    margin-left:0 !important;
    padding: 0;
}
ul.social-network li {
    display: inline;
    margin: 0 5px;
}


/* footer social icons */
.social-network a.icoRss:hover {
    background-color: #F56505;
}
.social-network a.icoFacebook:hover {
    background-color:#3B5998;
}
.social-network a.icoTwitter:hover {
    background-color:#33ccff;
}
.social-network a.icoGoogle:hover {
    background-color:#BD3518;
}
.social-network a.icoVimeo:hover {
    background-color:#0590B8;
}
.social-network a.icoLinkedin:hover {
    background-color:#007bb7;
}
.social-network a.icoRss:hover i, .social-network a.icoFacebook:hover i, .social-network a.icoTwitter:hover i,
.social-network a.icoGoogle:hover i, .social-network a.icoVimeo:hover i, .social-network a.icoLinkedin:hover i {
    color:#fff;
}
a.socialIcon:hover, .socialHoverClass {
    color:#44BCDD;
}

.social-circle li a {
    display:inline-block;
    position:relative;
    margin:0 auto 0 auto;
    -moz-border-radius:50%;
    -webkit-border-radius:50%;
    border-radius:50%;
    text-align:center;
    width: 50px;
    height: 50px;
    font-size:20px;
}
.social-circle li i {
    margin:0;
    line-height:50px;
    text-align: center;
}

.social-circle li a:hover i, .triggeredHover {
    -moz-transform: rotate(360deg);
    -webkit-transform: rotate(360deg);
    -ms--transform: rotate(360deg);
    transform: rotate(360deg);
    -webkit-transition: all 0.2s;
    -moz-transition: all 0.2s;
    -o-transition: all 0.2s;
    -ms-transition: all 0.2s;
    transition: all 0.2s;
}
.social-circle i {
    color: #fff;
    -webkit-transition: all 0.8s;
    -moz-transition: all 0.8s;
    -o-transition: all 0.8s;
    -ms-transition: all 0.8s;
    transition: all 0.8s;
}

.navbar-brand{
  font-family: 'Questrial','Helvetica Neue',Arial,sans-serif;
}



        </style>
    </head>

    
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
