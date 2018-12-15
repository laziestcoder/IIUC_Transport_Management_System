<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="{{ asset('/vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/vendor/bootstrap/css/bootstrap-grid.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/bootstrap/css/bootstrap-grid.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/vendor/bootstrap/css/bootstrap-reboot.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/bootstrap/css/bootstrap-reboot.min.css') }}" rel="stylesheet">

    <link href="{{ asset ('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ITMS') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--@yield('index')--}}
    <link href="{{ asset('css/agency.css') }}" rel="stylesheet">
    <link href="{{ asset('css/agency.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src='https://www.google.com/recaptcha/api.js'></script>


</head>
<body>
<div id="app">

    @include('common.nav')
    @yield('content')
    <footer class="row">
        @include('common.footer')
    </footer>
</div>


<!-- Scripts -->

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('article-ckeditor');
</script>
@include('common.script')
</body>
</html>
