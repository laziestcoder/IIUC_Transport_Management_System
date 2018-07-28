<?php $__env->startSection('content'); ?>
    <header id="home" class="masthead">
        <div class="container">
            <div class="intro-text" style="padding-top: 140px; padding-bottom: 200px;">
                <div class="intro-lead-in" style="font-style: initial">Welcome <i><?php echo e(Auth::user()->name); ?> </i></div>
                <!-- <div class="intro-heading text-uppercase">It's Nice To Meet You</div> -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel panel-default">
                                <!-- <div class="panel-heading">Dashboard</div> -->

                                <div class="panel-body" style="background:#212529">
                                    <?php if(session('status')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session('status')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <a href="/dashboard" class="btn btn-primary">Profile</a>
                                    <a href="/management" class="btn btn-primary">Edit Schedule</a>
                                    <!-- <a href="/notices/create" class="btn btn-primary">Create Notice</a>
                                    <a href="/settings" disabled='True' class="btn btn-primary">Settings</a>
                                    <a href="/statistics" disabled='True' class="btn btn-primary">Statistics</a>
                                    <a href="/dashboard" class="btn btn-primary">Dashboard</a>    -->
                                    <a href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="btn btn-primary">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                          style="display: none;">
                                        <?php echo e(csrf_field()); ?>

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

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>