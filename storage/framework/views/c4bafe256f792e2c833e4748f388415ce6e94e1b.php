<div class="form-group">
    <label><?php echo e($label); ?></label>
    <?php echo $__env->make($presenter->view(), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>