  
@extends('layouts.login-layout')

@section('content')
  <!--login-->
            <div class="container">
                
                <div class="row top-buffer">

                    <div class="col-md-8">
                    </div>

                    <div class="col-md-4">
                        <div class="panel panel-primary panel-transparent">
                            <div class="panel-heading">
                                <h3 class="panel-title">Login via site</h3>
                            </div>
                            <div class="panel-body">

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(Session::has('failed_message'))
                                    <div>
                                        <p style="font-size:13px; color: red;">{{Session::get('failed_message')}}</p>
                                    </div>
                                @endif
                                
                                <form role="form" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <fieldset>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail">
                                    </div>
                                    <div class="form-group">
                                       <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me"><font color="white">Remember Me</font>
                                        </label>
                                    </div>
                                    <a href="/password/email"><font color="white">Forgot your password?</font></a><br>
                                    <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                                </fieldset>
                                </form>
                                  <hr/>
                                <center><h4><font color="white">Or Login via</font></h4></center>
                                <div class="col-md-12">
                                    <ul class="social-network social-circle">
                                        <li><a href="{{url('redirect/facebook')}}" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="{{url('redirect/google')}}" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="{{url('redirect/linkedin')}}" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>   
                                    <hr/>            
                                </div>         
                                <center><h5><font color="white">Don't have an account yet?</font></h5>&nbsp;
                                <a href="{{url('auth/register')}}"><font color="white">Register</font></a></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- login end-->

@endsection