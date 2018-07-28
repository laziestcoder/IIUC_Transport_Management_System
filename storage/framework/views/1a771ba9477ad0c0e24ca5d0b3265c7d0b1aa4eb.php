<?php $__env->startSection('content'); ?>
    <div class="jumbotron text-center">
        <h1> <?php echo e($title); ?> </h1>
        <?php if (count($services) > 0): ?>
            <ul class="list-group">
                <?php $__currentLoopData = $services;
                $__env->addLoop($__currentLoopData);
                foreach ($__currentLoopData as $service): $__env->incrementLoopIndices();
                    $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item"><?php echo e($service); ?></li>
                <?php endforeach;
                $__env->popLoop();
                $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>