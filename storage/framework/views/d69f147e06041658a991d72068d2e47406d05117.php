<?php $__env->startSection('content'); ?>

    <a href="/notices" class="btn btn-default">Go Back</a>
    <h1><?php echo e($notice->title); ?></h1>
    <img style="width:20%; height: 20%" src="/storage/cover_images/<?php echo e($notice->cover_image); ?>"
         alt="<?php echo e($notice->title); ?>">
    <div>
        <?php echo $notice->body; ?>

    </div>
    <hr>
    <small>Written on <?php echo e($notice->created_at); ?> by <?php echo e($notice->user->name); ?></small>
    <hr>
<?php if (!Auth::guest()): ?>
    <?php if (Auth::user()->id == $notice->user_id): ?>
        <a href="/notices/<?php echo e($notice->id); ?>/edit" class="btn btn-default">Edit</a>
        <?php echo Form::open(['action' => ['NoticesController@destroy', $notice->id], 'method' => 'POST', 'id' => 'delete', 'class' => 'pull', 'style' => 'display:inline', 'onclick' => 'function(){console.log("3");return confirm("Do you want to delete this item?");}']); ?>

        <?php echo e(Form::hidden('_method', 'DELETE')); ?>

        <?php echo e(csrf_field()); ?>

        <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle' => 'confirmation', 'data-placement' => 'top'])); ?>

        <?php echo Form::close(); ?>

    <?php endif; ?>
<?php endif; ?>


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
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>