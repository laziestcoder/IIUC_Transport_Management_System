<div class="box">

    <div class="box-header">

        <div class="btn-group">
            <a class="btn btn-primary btn-sm <?php echo e($id, false); ?>-tree-tools" data-action="expand">
                <i class="fa fa-plus-square-o"></i>&nbsp;<?php echo e(trans('admin.expand'), false); ?>

            </a>
            <a class="btn btn-primary btn-sm <?php echo e($id, false); ?>-tree-tools" data-action="collapse">
                <i class="fa fa-minus-square-o"></i>&nbsp;<?php echo e(trans('admin.collapse'), false); ?>

            </a>
        </div>

        <?php if($useSave): ?>
        <div class="btn-group">
            <a class="btn btn-info btn-sm  <?php echo e($id, false); ?>-save"><i class="fa fa-save"></i>&nbsp;<?php echo e(trans('admin.save'), false); ?></a>
        </div>
        <?php endif; ?>

        <?php if($useRefresh): ?>
        <div class="btn-group">
            <a class="btn btn-warning btn-sm <?php echo e($id, false); ?>-refresh"><i class="fa fa-refresh"></i>&nbsp;<?php echo e(trans('admin.refresh'), false); ?></a>
        </div>
        <?php endif; ?>

        <div class="btn-group">
            <?php echo $tools; ?>

        </div>

        <?php if($useCreate): ?>
        <div class="btn-group pull-right">
            <a class="btn btn-success btn-sm" href="<?php echo e($path, false); ?>/create"><i class="fa fa-save"></i>&nbsp;<?php echo e(trans('admin.new'), false); ?></a>
        </div>
        <?php endif; ?>

    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <div class="dd" id="<?php echo e($id, false); ?>">
            <ol class="dd-list">
                <?php echo $__env->renderEach($branchView, $items, 'branch'); ?>
            </ol>
        </div>
    </div>
    <!-- /.box-body -->
</div>
