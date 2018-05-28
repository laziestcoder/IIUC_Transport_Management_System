<li class="dd-item" data-id="<?php echo e($branch[$keyName]); ?>">
    <div class="dd-handle">
        <?php echo $branchCallback($branch); ?>

        <span class="pull-right dd-nodrag">
            <a href="<?php echo e($path); ?>/<?php echo e($branch[$keyName]); ?>/edit"><i class="fa fa-edit"></i></a>
            <a href="javascript:void(0);" data-id="<?php echo e($branch[$keyName]); ?>" class="tree_branch_delete"><i class="fa fa-trash"></i></a>
        </span>
    </div>
    <?php if(isset($branch['children'])): ?>
    <ol class="dd-list">
        <?php $__currentLoopData = $branch['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make($branchView, $branch, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>
    <?php endif; ?>
</li>