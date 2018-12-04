<!DOCTYPE html>
<html>
<head>
    <title>{!! $title !!}</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="{{ asset ('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
</head>
<body>
<div class="container" style="text-align:center; margin: auto;">
    <div id="header-title" >
        <img src="storage/img/logos/iiuc.png" alt="International Islamic University Chittagong"/>
        <h4>Kumira, Chittagong</h4>
    </div>
    @yield('content')
</div>
</body>
</html>