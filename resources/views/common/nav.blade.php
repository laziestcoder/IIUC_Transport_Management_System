<!-- Navigation -->
<nav class="navbar navbar-expand-xl navbar-default navbar-fixed-top" id="mainNav">
    {{--<nav class="navbar navbar-expand-lg navbar-dark navbar-fixed-top"  id="mainNav">--}}
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="/">
            <img src="/storage/img/logos/itms-logo.png" alt="IIUC TMD LOGO">
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/#home">Home</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/#services">Emergency</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/#schedule">Schedule</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/#notice">News</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/#contact">Report</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/#about">About</a></li>

                <!-- <li class="nav-item"><a class="nav-link" href="/admin">Admin Panel</a></li>
                <li class="nav-item"><a class="nav-link" href="/test">Test</a></li>
                 -->
                {{--<li class="nav-item dropdown">--}}
                    {{--<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"--}}
                       {{--aria-haspopup="true" aria-expanded="false">Bus schidule</a>--}}
                    {{--<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">--}}
                        {{--<a class="dropdown-item" href="#">friday</a>--}}
                        {{--<a class="dropdown-item" href="#">Another action</a>--}}
                        {{--<a class="dropdown-item" href="#">Something else here</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
                <!-- <li class="nav-item"><a class="nav-link" data-toggle="modal" href="#exampleModal1">Login</a></li> -->
                @guest
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>

                @else
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false" aria-haspopup="true" v-pre>
                        {{ Auth::user()->name }}
                        <!-- <span class="caret"></span> -->
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="/dashboard" disabled='True'>Profile</a></li>
                            <!-- <li><a href="/notices/create">Create Notice</a></li>
                            <li><a href="/management">Management</a></li>
                            <li><a href="/settings" disabled='True'>Settings</a></li>
                            <li><a href="/statistics" disabled='True'>Statistics</a></li>
                            <li><a href="/dashboard">Dashboard</a></li>    -->
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


<!-- Modal -->


<!--    student form-->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                stu

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Login</button>
                <button type="button" class="btn btn-primary">Register</button>
            </div>
        </div>
    </div>

</div>


<!--   teacher form-->
<!-- <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
            </div>
            <div class="modal-body">

                tcher
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>

</div> -->


<!--    stuf form-->
<!-- <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
            </div>
            <div class="modal-body">

                stuf
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>

</div> -->





