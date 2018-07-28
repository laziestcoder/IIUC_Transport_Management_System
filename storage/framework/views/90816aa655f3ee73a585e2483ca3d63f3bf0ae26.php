<div class="btn-group" data-toggle="buttons">
    <?php $__currentLoopData = $options;
    $__env->addLoop($__currentLoopData);
    foreach ($__currentLoopData as $option => $label): $__env->incrementLoopIndices();
        $loop = $__env->getLastLoop(); ?>
        <label class="btn btn-default btn-sm <?php echo e(\Request::get('type', 'inbox') == $option ? 'active' : ''); ?>">
            <input type="radio" class="message-type" value="<?php echo e($option); ?>"><?php echo e($label); ?>

        </label>
    <?php endforeach;
    $__env->popLoop();
    $loop = $__env->getLastLoop(); ?>
</div>