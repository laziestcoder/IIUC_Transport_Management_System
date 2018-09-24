<!-- Navigation -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<nav class="navbar navbar-expand-xl navbar-default navbar-fixed-top" id="mainNav">
    
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="/">
            <img src="/storage/img/logos/itms-logo.png" alt="IIUC TMD LOGO">
        </a>
        
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

                <!-- <li class="nav-item"><a class="nav-link" href="/admin">Admin Panel</a></li>
                <li class="nav-item"><a class="nav-link" href="/test">Test</a></li>
                 -->
            
            
            
            
            
            
            
            
            
            <!-- <li class="nav-item"><a class="nav-link" data-toggle="modal" href="#exampleModal1">Login</a></li> -->
                <?php if(auth()->guard()->guest()): ?>
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>

                <?php else: ?>
                    <li class="nav-item dropdown">
                        <a href="/dashboard" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false" aria-haspopup="true" v-pre>
                        <?php echo e(Auth::user()->name, false); ?>

                        <!-- <span class="caret"></span> -->
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="/dashboard" disabled='True'>Profile</a></li>
                            <!-- <li><a href="/notices/create">Create Notice</a></li>
                            <li><a href="/management">Management</a></li>
                            <li><a href="/settings" disabled='True'>Settings</a></li>
                            <li><a href="/statistics" disabled='True'>Statistics</a></li>
                            <li><a href="/dashboard">AdminDashboard</a></li>    -->
                            <li>
                                <a href="<?php echo e(route('logout'), false); ?>"
                                   onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="<?php echo e(route('logout'), false); ?>" method="POST"
                                      style="display: none;">
                                    <?php echo e(csrf_field(), false); ?>

                                </form>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>


<!-- Modal -->


<!--    student form-->
<!-- <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

</div> -->


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





