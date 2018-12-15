<?php $__env->startSection('content'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>

    <section class="content-header">

        <script>
            $(document).ready(function () {
                $('[data-toggle=confirmation]').confirmation({
                    rootSelector: '[data-toggle=confirmation]',
                    onConfirm: function (event, element) {
                        element.closest('form').submit();
                    }
                });
            });

        </script>
        <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h1>
            <?php echo e($title, false); ?>

            <small>
                <?php echo $description ? $description : 'All Notice Posts'; ?>


            </small>
        </h1>
        <br>
        <a href="/admin/auth/notices/create" class="btn btn-facebook">New Notice</a>


        <br><br>

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
                                     alt="<?php echo e($notice->title, false); ?>">
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
                            <?php if (Admin::user()): ?>
                                <?php if ((Admin::user()->id == $notice->user_id) || (DB::table('admin_role_users')->where('user_id', (Admin::user()->id))->first()->role_id <= 4)): ?>
                                    <a href="/admin/auth/notices/<?php echo e($notice->id, false); ?>/edit"
                                       class="btn btn-default">Edit</a>

                                    <?php echo Form::open(['action' => ['NoticesController@destroy', $notice->id], 'method' => 'POST', 'class' => 'pull', 'id' => 'delete', 'style' => 'display:inline']); ?>

                                    <?php echo e(Form::hidden('_method', 'DELETE'), false); ?>

                                    <?php echo e(csrf_field(), false); ?>

                                    <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle' => 'confirmation', 'data-placement' => 'top']), false); ?>

                                    <?php echo Form::close(); ?>

                                <?php endif; ?>
                            <?php endif; ?>
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

    </section>
    <section class="content">


    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>