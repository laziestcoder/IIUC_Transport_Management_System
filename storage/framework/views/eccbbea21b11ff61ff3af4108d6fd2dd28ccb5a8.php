<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <div class="container">
            <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <h1><?php echo e($title); ?>

                <small>
                    Please attach a picture of the registered notice
                </small>
            </h1>
            <div class="container-fluid">
                <?php echo Form:: open(['action' => ['NoticesController@update', $notice->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']); ?>

                <div class="form-group">
                    <?php echo e(Form:: label('title', 'Title')); ?>

                    <?php echo e(Form:: text('title', $notice->title, ['class' => 'form-control', 'placeholder' => 'Title',])); ?>

                </div>
                <div class="form-group">
                    <?php echo e(Form:: label('body', 'Body')); ?>

                    <?php echo e(Form:: textarea('body', $notice->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text',])); ?>

                </div>
                <div class="form-group">
                    <?php echo e(Form::file('cover_image')); ?>

                </div>
                <?php echo e(Form::hidden('_method', 'PUT')); ?>

                <?php echo e(Form:: submit('Save', ['class' => 'btn btn-primary'])); ?>

                <?php echo Form::close(); ?>

            </div>
        </div>
    </section>
    <br>
    <section class="content">


    </section>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('article-ckeditor');
    </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>