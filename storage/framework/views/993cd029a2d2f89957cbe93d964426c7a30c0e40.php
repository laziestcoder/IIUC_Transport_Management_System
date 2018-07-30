<?php $__env->startSection('content'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
    <script>
        // $(document).ready(function () {
        //     console.log("1");
        //     $('[data-toggle=confirmation]').confirmation({
        //         rootSelector: '[data-toggle=confirmation]',
        //         onConfirm: function (event, element) {
        //             element.closest('form').submit();
        //         }
        //     });
        //
        // });
        // $("#delete").on("submit", function () {
        //     console.log("2");
        //     return confirm("Do you want to delete this item?");
        // });

        $(document).ready(function () {
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function (event, element) {
                    element.closest('form').submit();
                }
            });
        });

    </script>
    <section class="content-header">
        <div class="container">
            <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <a href="/admin/auth/notices" class="btn btn-primary">Go Back</a>
            <div class="row">
                <div class="col-md-10">
                    <h1><?php echo $notice->title; ?>
                        <small></small>
                    </h1>
                    <div class="col-md-10 col-md">
                        <img style="width:60%; height:60%"
                             src="/storage/cover_images/<?php echo $notice->cover_image; ?>"
                             alt="<?php echo $notice->title; ?>">
                    </div>
                    <div class="col-md-10 col-md">
                        <article>
                            <?php echo $notice->body; ?>

                        </article>
                    </div>
                    <div class="col-md-10 col-md">
                        Written on: <?php echo $notice->created_at; ?>

                        <br>
                        Posted by: <?php echo DB::table('admin_users')->where('id', $notice->user_id)->first()->name; ?>

                        <small>
                            (
                            <?php if (Admin::user()->id == $notice->user_id): ?>
                                <?php echo ' Yourself '; ?>

                            <?php else: ?>
                                <?php echo ' Other Admin '; ?>

                            <?php endif; ?>
                            )
                        </small>
                    </div>
                </div>
            </div>
            <?php if (Admin::user()): ?>
                <?php if (Admin::user()->id == $notice->user_id): ?>
                    <a href="/admin/auth/notices/<?php echo e($notice->id); ?>/edit" class="btn btn-default">Edit</a>

                    <?php echo Form::open(['action' => ['NoticesController@destroy', $notice->id], 'method' => 'POST', 'class' => 'pull', 'id' => 'delete', 'style' => 'display:inline']); ?>

                    <?php echo e(Form::hidden('_method', 'DELETE')); ?>

                    <?php echo e(csrf_field()); ?>

                    <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle' => 'confirmation', 'data-placement' => 'top'])); ?>

                    <?php echo Form::close(); ?>

                <?php endif; ?>
            <?php endif; ?>

        </div>
    </section>
    <section class="content">


    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>