<div class="form-group">
    <label class="col-sm-2 control-label"> <?php echo e($label, false); ?></label>
    <div class="col-sm-8">
        <?php echo $__env->make($presenter->view(), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
</div>