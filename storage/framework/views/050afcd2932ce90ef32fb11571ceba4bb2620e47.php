<?php $__env->startSection('content'); ?>
    <div class="jumbotron text-center">
        <h1><?php echo e($title); ?></h1>
        <p>This is the Laravel Application from "Laravel From Scratch"</p>
        <?php if (auth()->guard()->guest()): ?>
            <p>
                <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
                <a class="btn btn-success btn-lg" href="/register" role="button">Register</a>
            </p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>