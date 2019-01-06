<!-- Navigation -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<nav class="navbar navbar-expand-xl navbar-default navbar-fixed-top" id="mainNav">
    {{--<nav class="navbar navbar-expand-lg navbar-dark navbar-fixed-top"  id="mainNav">--}}
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="/">
            <img src="/storage/img/logos/itms-logo.png" alt="IIUC TMD LOGO">
        </a>
        {{-- 4508 app.css--}}
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/#home">Home</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/#emergency">Emergency</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/#schedule">Schedule</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/#notice">News</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/#report">Report</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/#about-us">About</a></li>
                @guest
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>

                @else
                    <li class="nav-item dropdown">
                        <a href="/dashboard" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false" aria-haspopup="true" v-pre>
                           {!! $image !!} {{ Auth::user()->name }} 
                           
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="/dashboard" disabled='True'>Profile</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>




