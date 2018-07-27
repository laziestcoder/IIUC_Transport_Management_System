<?php $__env->startSection('content'); ?>
    
    <section class="content-header">
        <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <a href="/admin/auth/notices" class="btn btn-default">Go Back</a>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1><?php echo e($notice->title); ?></h1>
                    <img style="width:60%; height:60%" src="/storage/cover_images/<?php echo e($notice->cover_image); ?>"
                         alt="<?php echo e($notice->title); ?>">
                    <?php echo $notice->body; ?>


                    <hr>
                    <small>Written on <?php echo e($notice->created_at); ?>

                        by <?php echo e(DB::table('admin_users')->where('id', $notice->user_id)->first()->name); ?></small>
                    <hr>
                    <?php if(Admin::user()): ?>
                        <?php if(Admin::user()->id == $notice->user_id): ?>
                            <a href="/admin/auth/notices/<?php echo e($notice->id); ?>/edit" class="btn btn-default">Edit</a>
                            <?php echo Form::open(['action' => ['NoticesController@destroy', $notice->id], 'method' => 'POST','id' =>'delete', 'class' => 'pull','style'=>'display:inline','onclick' => 'function(){console.log("3");return confirm("Do you want to delete this item?");}' ]); ?>

                            <?php echo e(Form::hidden('_method','DELETE')); ?>

                            <?php echo e(csrf_field()); ?>

                            <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle'=>'confirmation','data-placement'=>'top'])); ?>

                            <?php echo Form::close(); ?>

                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            console.log("1");
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function (event, element) {
                    element.closest('form').submit();
                }
            });

        });
        $("#delete").on("submit", function () {
            console.log("2");
            return confirm("Do you want to delete this item?");
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>