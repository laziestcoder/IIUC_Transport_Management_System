@extends('layouts.app')

@section('content')
    <header id="home" class="masthead">
        <div class="container">
            <div class="intro-text" style="padding-top: 140px; padding-bottom: 200px;">
                <div class="intro-lead-in" style="font-style: initial"><b>REGISTRATION</b></div>
                <!-- <div class="intro-heading text-uppercase">It's Nice To Meet You</div> -->
                <div class="container" style="padding:0px 0px 0px 0px;">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel panel-default">
                                <!-- <div class="panel-heading">Register</div> -->
                                <div class="panel-body" style="padding-top: 50px; background:#212529">
                                    @if (session('confirmation-success'))
                                        <div class="alert alert-success">
                                            {{ session('confirmation-success') }}
                                        </div>
                                    @else
                                        <form class="form-horizontal" role="form" method="POST"
                                              action="{{ url('/register') }}">
                                            {{ csrf_field() }}

                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label for="name" class="col-md-4 control-label">Name</label>

                                                <div class="col-md-6">
                                                    <input id="name" type="text" class="form-control" name="name"
                                                           placeholder=" Enter Your Full Name "
                                                           value="{{ old('name') }}" required autofocus>

                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('jobid') ? ' has-error' : '' }}">
                                                <label for="jobid" class="col-md-4 control-label">ID</label>

                                                <div class="col-md-6">
                                                    <input id="jobid" type="text" class="form-control" name="jobid"
                                                           placeholder=" Enter Your Varsity ID "
                                                           value="{{ old('jobid') }}" required>

                                                    @if ($errors->has('jobid'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('jobid') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control" name="email"
                                                           placeholder=" Enter Your Valid Email ID "
                                                           value="{{ old('email') }}" required>

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
                                                    <input id="password" type="password" class="form-control"
                                                           placeholder=" Enter Password Atleast Six Characters "
                                                           name="password" required>

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="password-confirm" class="col-md-4 control-label">Confirm
                                                    Password</label>

                                                <div class="col-md-6">
                                                    <input id="password-confirm" type="password" class="form-control"
                                                           placeholder=" Confirm Your Password "
                                                           name="password_confirmation" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="user-gender" class="col-md-4 control-label">Gender</label>

                                                <div class="col-md-6">
                                                    <div class="radio-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" value="0"
                                                                   name="gender" required>Male
                                                        </label>
                                                    </div>
                                                    <div class="radio-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" value="1"
                                                                   name="gender" required>Female
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="user-gender" class="col-md-4 control-label">Register
                                                    As</label>

                                                <div class="col-md-6">
                                                    <div class="radio-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" value="1"
                                                                   name="userrole" required>Student
                                                        </label>
                                                    </div>
                                                    <div class="radio-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" value="2"
                                                                   name="userrole" required>Faculty
                                                        </label>
                                                    </div>
                                                    <div class="radio-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" value="3"
                                                                   name="userrole" required>Officer/Staff
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <button type="submit" class="btn btn-primary"
                                                            style="background-color: #bababa; border-color: #212529;">
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
            </div>
        </div>
    </header>
    <!-- <div class="container">
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
            </div> -->
@endsection


