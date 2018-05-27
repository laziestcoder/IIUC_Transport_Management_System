@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    @if (session('confirmation-success'))
                        <div class="alert alert-success">
                            {{ session('confirmation-success') }}
                        </div>
                    @else
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user-gender" class="col-md-4 control-label">Gender</label>
    
                                <div class="col-md-6">
                                    <div class="radio-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="0" name="gender" required>Male
                                        </label>
                                        </div>
                                        <div class="radio-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="1" name="gender" required>Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user-gender" class="col-md-4 control-label">Register As</label>
    
                                <div class="col-md-6">
                                    <div class="radio-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="1" name="userrole" required>Student
                                        </label>
                                    </div>
                                    <div class="radio-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="2" name="userrole" required>Faculty
                                        </label>
                                    </div>
                                    <div class="radio-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="3" name="userrole" required>Officer/Staff
                                        </label>
                                    </div> 
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
