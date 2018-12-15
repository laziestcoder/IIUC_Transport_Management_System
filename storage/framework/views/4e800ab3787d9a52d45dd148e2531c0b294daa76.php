<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <div class="container">
            <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <h1>
                <?php echo e($title, false); ?>

                <small>
                    Please attach a picture of the registered notice
                </small>
            </h1>
            <div class="container-fluid">
                <?php echo Form:: open(['action' => 'NoticesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']); ?>

                <div class="form-group">
                    <?php echo e(Form:: label('title', 'Title'), false); ?>

                    <?php echo e(Form:: text('title', '', ['class' => 'form-control', 'placeholder' => 'Title', 'required']), false); ?>

                </div>
                <div class="form-group">
                    <?php echo e(Form:: label('body', 'Body'), false); ?>

                    <?php echo e(Form:: textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text', 'required']), false); ?>

                </div>
                <div class="form-group">
                    <?php echo e(Form:: label('regno', 'Registartion No'), false); ?>

                    <?php echo e(Form:: text('regno', '', ['class' => 'form-control', 'placeholder' => 'Notice Registration No', 'required']), false); ?>

                </div>
                <div class="form-group">
                    <?php echo e(Form:: label('cover_image', 'Upload an Image '), false); ?>(not mandatory)
                    <?php echo e(Form::file('cover_image'), false); ?>

                </div>
                <?php echo e(Form:: submit('Submit', ['class' => 'btn btn-primary']), false); ?>

                <?php echo Form::close(); ?>

            </div>
        </div>
    </section>
    <section class="content">


    </section>
    <script src="<?php echo e(asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js'), false); ?>"></script>
    <script>
        CKEDITOR.replace('article-ckeditor');
    </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>