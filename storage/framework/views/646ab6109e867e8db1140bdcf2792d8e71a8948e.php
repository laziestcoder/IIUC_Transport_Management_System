<?php $__env->startComponent('mail::layout'); ?>
    
    <?php $__env->slot('header'); ?>
        <?php $__env->startComponent('mail::header', ['url' => config('app.url')]); ?>
            <?php echo e(config('app.name'), false); ?>

        <?php echo $__env->renderComponent(); ?>
    <?php $__env->endSlot(); ?>

    
    <?php echo e($slot, false); ?>


    
    <?php if(isset($subcopy)): ?>
        <?php $__env->slot('subcopy'); ?>
            <?php $__env->startComponent('mail::subcopy'); ?>
                <?php echo e($subcopy, false); ?>

            <?php echo $__env->renderComponent(); ?>
        <?php $__env->endSlot(); ?>
    <?php endif; ?>

    
    <?php $__env->slot('footer'); ?>
        <?php $__env->startComponent('mail::footer'); ?>
            © <?php echo e(date('Y'), false); ?> <?php echo e(config('app.name'), false); ?>. All rights reserved.
        <?php echo $__env->renderComponent(); ?>
    <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
