<?php if($help): ?>
<span class="help-block">
    <i class="fa <?php echo e(array_get($help, 'icon')); ?>"></i>&nbsp;<?php echo array_get($help, 'text'); ?>

</span>
<?php endif; ?>