<?php $__env->startSection('content'); ?>
    
    <h1><?php echo e($BusRoute->routename); ?></h1>
    <hr>
        <a href="/admin/auth/routes/<?php echo e($BusRoute->id); ?>/edit" class="btn btn-default">Edit</a>
        <?php echo Form::open(['action' => ['BusRoutesController@destroy', $BusRoute->id], 'method' => 'POST', 'class' => 'pull-right' ]); ?>

            <?php echo e(Form::hidden('_method','DELETE')); ?>

            <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger'])); ?>

        <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>