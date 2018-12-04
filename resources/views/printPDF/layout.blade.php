<!DOCTYPE html>
<html>
<head>
    <title>{!! $title !!}</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div id="Header-title" style="text-align:center;">
        <img style="width: auto" src="storage/img/logos/iiuc.png" alt="International Islamic University Chittagong"/>
    {{--<h1>International Islamic University Chittagong</h1>--}}
    <h4>Kumira, Chittagong</h4>
    </div>
    @yield('content')
</div>
</body>
</html>