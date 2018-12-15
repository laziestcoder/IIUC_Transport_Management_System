@extends('layouts.app')

@section('content')
    <header id="home" class="masthead">
        <div class="container home-main">
            <div class="intro-text" style="padding-top: 140px; padding-bottom: 200px;">
                <div class="intro-lead-in" style="font-style: initial"><b>LOGIN</b></div>
                <div class="">
                    <!-- It's Nice To Meet You -->
                    <div class="container" style="padding:0px">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">
                                    <!-- <div class="panel-heading">Login</div> -->
                                    <div class="panel-body" style="background:#212529">
                                        <br>
                                        @if (session('confirmation-success'))
                                            <div class="alert alert-success">
                                                {{ session('confirmation-success') }}
                                            </div>
                                        @endif
                                        @if (session('confirmation-danger'))
                                            <div class="alert alert-danger">
                                                {!! session('confirmation-danger') !!}
                                            </div>
                                        @endif
                                        <form id="form" class="form-horizontal" role="form" method="POST"
                                              action="{{ url('/login') }}">
                                            {{ csrf_field() }}

                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control" name="email"
                                                           value="{{ old('email') }}" autofocus>

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
                                                           name="password">

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                            Remember Me
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group">
                                                 <div class="col-md-8 col-md-offset-4">
                                                     {!! Recaptcha::render() !!}
                                                 </div>
                                             </div>--}}
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <div id="recaptcha" class="g-recaptcha"
                                                         data-sitekey="6LcV-ngUAAAAAJqAknZhDgpgysYKlMJ9YSuKxWyb"></div>
                                                    @if ($errors->has('recaptcha'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('recaptcha') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-8 col-md-offset-4">
                                                    <button type="submit" class="btn btn-primary"
                                                            style="background-color: #bababa; border-color: #212529;">
                                                        Login
                                                    </button>

                                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                                        Forgot Your Password?
                                                    </a>
                                                </div>

                                            </div>

                                        </form>
                                        If you are new click for <a class="link"
                                                                    href="{{ route('register') }}">Register</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <!-- <div class="container"style="background:black; padding:50px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    @if (session('confirmation-success'))
        <div class="alert alert-success">
{{ session('confirmation-success') }}
                </div>
@endif
    @if (session('confirmation-danger'))
        <div class="alert alert-danger">
{!! session('confirmation-danger') !!}
                </div>
@endif
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

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
            <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
    @include('inc.recaptchaSubmitValidate')
@endsection
