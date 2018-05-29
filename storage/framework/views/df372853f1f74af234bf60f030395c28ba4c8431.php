<div class="form-group">
    <label><?php echo e($label); ?></label>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control" id="<?php echo e($id['start']); ?>" placeholder="<?php echo e($label); ?>" name="<?php echo e($name['start']); ?>" value="<?php echo e(request($name['start'], array_get($value, 'start'))); ?>">
        <span class="input-group-addon" style="border-left: 0; border-right: 0;">-</span>
        <input type="text" class="form-control" id="<?php echo e($id['end']); ?>" placeholder="<?php echo e($label); ?>" name="<?php echo e($name['end']); ?>" value="<?php echo e(request($name['end'], array_get($value, 'end'))); ?>">
    </div>
</div>