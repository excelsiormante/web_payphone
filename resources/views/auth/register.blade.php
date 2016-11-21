@extends('layouts.login-layout')

@section('content')

 <div class="container">
                
                <div class="row top-buffer">

                    <div class="col-md-8">
                    </div>

                    <div class="col-md-4">
                        <div class="panel panel-primary panel-transparent">
                            <div class="panel-heading">
                                <h3 class="panel-title">Register</h3>
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

                <form class="form-horizontal" role="form" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label class="col-md-4 control-label"><font color="white">Name</font></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label"><font color="white">E-Mail Address</font></label>
                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email_address" value="{{ old('email_address') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label"><font color="white">Password</font></label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label"><font color="white">Confirm Password</font></label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                    	   <font color="white">Register</font>
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>


@endsection