<select class="form-control <?php echo e($class, false); ?>" name="<?php echo e($name, false); ?>" style="width: 100%;">
    <option></option>
    <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $select => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($select, false); ?>" <?php echo e((string)$select === request($name, $value) ?'selected':'', false); ?>><?php echo e($option, false); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>