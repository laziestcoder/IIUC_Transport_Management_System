<?php $__env->startSection('content'); ?>
    <header id="home" class="masthead">
        <div class="container home-main">
            <div class="intro-text" style="padding-top: 140px; padding-bottom: 200px;">
                <div class="intro-lead-in" style="font-style: initial">Welcome <i><?php echo e(Auth::user()->name, false); ?> </i></div>
                <!-- <div class="intro-heading text-uppercase">It's Nice To Meet You</div> -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel panel-default">
                                <!-- <div class="panel-heading">AdminDashboard</div> -->

                                <div class="panel-body" style="background:#212529">
                                    <?php if(session('status')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session('status'), false); ?>

                                        </div>
                                    <?php endif; ?>
                                    <a href="/dashboard" class="btn btn-info">Profile</a>
                                    <a href="/management" class="btn btn-success">Edit Profile</a>
                                    <a href="/bus-schedules" class="btn btn-warning">Bus Schedules</a>
                                    <a href="/bus-routes" class="btn btn-default">Bus Routes</a>
                                    <a href="<?php echo e(route('logout'), false); ?>"
                                       onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="btn btn-danger">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout'), false); ?>" method="POST"
                                          style="display: none;">
                                        <?php echo e(csrf_field(), false); ?>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo $__env->yieldContent('usercontent'); ?>
                </div>
            </div>
        </div>
    </header>
    <script>
        /* $(document).ready(function () {        
        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.closest('form').submit();
            }
        });   
    }); */
        $("#delete").on("submit", function () {
            return confirm("Do you want to delete this item?");
        });

    </script>
    <!-- <div class="intro-lead" >NEXT BUS<div>
    </br>Male:
    </br>Female: -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>