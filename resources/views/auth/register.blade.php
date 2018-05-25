@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('Register') }}</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gender" class="col-md-4 control-label">{{ __('Gender') }}</label>

                            <div class="col-md-6" >
                                <div class="radio-inline">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" value="1" name="gender" required>Male
                                    </label>
                                  </div>
                                  <div class="radio-inline">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" value="2" name="gender" required>Female
                                    </label>
                                  </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="role" class="col-md-4 control-label">{{ __('Register As') }}</label>

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
                                    {{ __('Register') }}
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
