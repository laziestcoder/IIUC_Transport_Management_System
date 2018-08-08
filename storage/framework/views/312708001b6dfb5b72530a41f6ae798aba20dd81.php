<input type="checkbox" class="<?php echo e($selectAllName, false); ?>" />&nbsp;

<div class="btn-group">
    <a class="btn btn-sm btn-default">  <?php echo e(trans('admin.action'), false); ?></a>
    <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><a href="#" class="<?php echo e($action->getElementClass(false), false); ?>"><?php echo e($action->getTitle(), false); ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>