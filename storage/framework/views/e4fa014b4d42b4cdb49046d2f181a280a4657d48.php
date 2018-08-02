<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h1>
            <?php echo e($title); ?>

            <small><?php echo e('Here you will get available bus schedule information. You can also add, remove and edit Bus Schedules.'); ?></small>
        </h1>
    </section>

    <section class="content">
        <h3><?php echo e($titleinfo); ?>

            <small>
                <?php echo e('Before delete a schedule please ensure the schedule is not used in any other data.'); ?>

            </small>
        </h3>


    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>