<!DOCTYPE html>
<html>
<head>
    <title>{!! $title !!}</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="{{ asset ('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

     <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="header-title">
    <div id="logo-title" style="width: 595px; text-align:center; margin: auto;">
        <h2 style="color: green;"><img style="width: 5%; height: 5%; margin: auto;"
                                       src="storage/img/logos/iiuc-logo.png"
                                       alt="International Islamic University Chittagong"/>
            International Islamic University Chittagong
            <h4 style="color: black;"><br>Kumira, Sitakunda, Chittagong</h4>
            <h3> Bus Schedule for <b>Students</b></h3>
        </h2>
    </div>
</div>
<div class="container" style="width: 595px; height: 842px; margin: auto;">
    @yield('content')
</div>
</body>
</html>