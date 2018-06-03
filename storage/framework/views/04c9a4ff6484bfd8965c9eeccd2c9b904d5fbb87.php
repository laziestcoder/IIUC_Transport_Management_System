<div class="<?php echo e($viewClass['form-group']); ?> <?php echo !$errors->has($errorKey) ? '' : 'has-error'; ?>">

    <label for="<?php echo e($id); ?>" class="<?php echo e($viewClass['label']); ?> control-label"><?php echo e($label); ?></label>

    <div class="<?php echo e($viewClass['field']); ?>">

        <?php echo $__env->make('admin::form.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <input type="file" class="<?php echo e($class); ?>" name="<?php echo e($name); ?>" <?php echo $attributes; ?> />

        <?php echo $__env->make('admin::form.help-block', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </div>
</div>
