@extends('layouts.master')

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
                    <label class="col-md-4 control-label"><font color="white">First Name</font></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label"><font color="white">Middle Name</font></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="middlename" value="{{ old('middlename') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label"><font color="white">Last Name</font></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-4 control-label"><font color="white">E-Mail Address</font></label>
                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email_address" value="{{ old('email_address') }}">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-4 control-label"><font color="white">Subscription Type</font></label>
                    <div class="col-md-6">
                        <?php echo $cmb_subs_type; ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-4 control-label"><font color="white">Address</font></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-4 control-label"><font color="white">Birthday</font></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="bday" value="{{ old('bday') }}">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-4 control-label"><font color="white">City</font></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="city" value="{{ old('city') }}">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-4 control-label"><font color="white">State</font></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="state" value="{{ old('state') }}">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-4 control-label"><font color="white">Postal Code</font></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="postal" value="{{ old('postal') }}">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-4 control-label"><font color="white">Country</font></label>
                    <div class="col-md-6">
                        <?php echo $cmb_country; ?>
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