<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container">
            <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <h1>
                <?php echo $title; ?>

                <small>
                    <?php echo $description ? $description : 'All Notice Posts'; ?>

                </small>
            </h1>

            <?php if (count($notices) > 0): ?>
                <?php $count = 0; ?>
                <?php $__currentLoopData = $notices;
                $__env->addLoop($__currentLoopData);
                foreach ($__currentLoopData as $notice): $__env->incrementLoopIndices();
                    $loop = $__env->getLastLoop(); ?>
                    <?php $count = $count + 1; ?>
                    <div class="well">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <a href="/admin/auth/notices/<?php echo $notice->id; ?>">
                                    <img style="width:50%; height: 50%"
                                         src="/storage/cover_images/<?php echo $notice->cover_image; ?>"
                                         alt="<?php echo e($notice->title); ?>">
                                </a>
                            </div>
                            <div class="col-md-8 col-sm-8">

                                <h3><?php echo $count; ?>. <a
                                            href="/admin/auth/notices/<?php echo $notice->id; ?>"><?php echo $notice->title; ?></a>
                                    <br>
                                    <small>
                                        Written on: <?php echo $notice->created_at; ?>

                                        <br>
                                        Posted
                                        by: <?php echo DB::table('admin_users')->where('id', $notice->user_id)->first()->name; ?>

                                    </small>
                                </h3>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
                $__env->popLoop();
                $loop = $__env->getLastLoop(); ?>
                <?php echo $notices->links(); ?>

            <?php else: ?>
                <div class="well">
                    <div class="row">
                        <h4>No notices found</h4>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <section class="content">


    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>