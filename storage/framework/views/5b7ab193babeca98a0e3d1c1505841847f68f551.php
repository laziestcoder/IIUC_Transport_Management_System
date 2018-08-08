<form <?php echo $attributes; ?>>
    <div class="box-body fields-group">

        <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $field->render(); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

    <!-- /.box-body -->
    <div class="box-footer">
    <?php if($method != 'GET'): ?>
        <input type="hidden" name="_token" value="<?php echo e(csrf_token(), false); ?>">
    <?php endif; ?>
        <div class="col-md-2"></div>

        <div class="col-md-8">
            <div class="btn-group pull-left">
                <button type="reset" class="btn btn-warning pull-right"><?php echo e(trans('admin.reset'), false); ?></button>
            </div>
            <div class="btn-group pull-right">
                <button type="submit" class="btn btn-info pull-right"><?php echo e(trans('admin.submit'), false); ?></button>
            </div>

        </div>

    </div>
</form>
