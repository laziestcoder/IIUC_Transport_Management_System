<?php $__env->startSection('content'); ?>
    <br><br><br><br><br><br>
    <div class="jumbotron text-center">
        <h1> <?php echo $title; ?> </h1>
        <p>This is about page</p>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>