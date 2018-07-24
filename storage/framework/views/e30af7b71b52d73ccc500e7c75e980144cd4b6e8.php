<div class="input-group">
    <div class="input-group-addon">
        <i class="fa fa-<?php echo e($icon); ?>"></i>
    </div>
    <input type="<?php echo e($type); ?>" class="form-control <?php echo e($id); ?>" placeholder="<?php echo e($placeholder); ?>" name="<?php echo e($name); ?>" value="<?php echo e(request($name, $value)); ?>">
</div>