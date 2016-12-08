 <div id="loginModal" class="modal fade" role="dialog" aria-hidden="true" >
        <div class="modal-dialog">
        <div class="modal-content" style="max-width:700px;">
        	<div class="modal-body">
        		
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

                        <div class="panel panel-primary panel-transparent">
                            <div class="panel-heading">
                                <h3 class="panel-title">Login via site</h3>
                            </div>

                                <form role="form" action="auth/login" method="POST">
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
                                <center><h4><font color="white">Login via</font></h4></center>
                                
                                <div class="col-md-12">
                                    <center>
                                    <ul class="social-network social-circle">
                                        <li><a href="{{url('redirect/facebook')}}" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="{{url('redirect/google')}}" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="{{url('redirect/linkedin')}}" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>   
                                    </center>
                                    <hr/>            
                                </div>

                              
                                <div>
                                    <center><h5><font color="white">Don't have an account yet?</font></h5>
                                    <a href="{{url('auth/register')}}"><font color="white">Register</font></a></center>
                                    <hr/>
                                </div>

                                <center><h4><font color="white">Or</font></h4></center>
                                <input class="btn btn-lg btn-primary btn-block" type="submit" value="Login as Guest">
                                    
                        
                        </div>
             
        	</div>
        </div>
        </div>
    
    </div>