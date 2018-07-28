<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h1><?php echo e($title); ?></h1>
        <?php if (count($notices) > 0): ?>
            <?php $count = 0; ?>
            <?php $__currentLoopData = $notices;
            $__env->addLoop($__currentLoopData);
            foreach ($__currentLoopData as $notice): $__env->incrementLoopIndices();
                $loop = $__env->getLastLoop(); ?>
                <?php $count = $count + 1; ?>
                <div class="well">
                    <div class="row">
                        <b><?php echo e($count); ?></b>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <img style="width:50%; height: 50%"
                                 src="/storage/cover_images/<?php echo e($notice->cover_image); ?>"
                                 alt="<?php echo e($notice->title); ?>">
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h3>
                                <a href="/admin/auth/notices/<?php echo e($notice->id); ?>"><?php echo e($notice->title); ?></a>
                            </h3>
                            <small>Written on <?php echo e($notice->created_at); ?>
                                by <?php echo e(DB::table('admin_users')->where('id', $notice->user_id)->first()->name); ?></small>
                        </div>
                    </div>

                </div>
            <?php endforeach;
            $__env->popLoop();
            $loop = $__env->getLastLoop(); ?>
            <?php echo e($notices->links()); ?>

        <?php else: ?>
            <h4>No notices found</h4>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>