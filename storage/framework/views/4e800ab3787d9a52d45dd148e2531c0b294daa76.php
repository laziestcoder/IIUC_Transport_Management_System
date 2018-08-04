<?php $__env->startSection('content'); ?>
    
    <section class="content-header">
        <div class="container">
            <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <h1>
                <?php echo e($title); ?>

                <small>
                    Please attach a picture of the registered notice
                </small>
            </h1>
            <div class="container-fluid">
                <?php echo Form :: open(['action' => 'NoticesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]); ?>

                <div class="form-group">
                    <?php echo e(Form :: label('title','Title')); ?>

                    <?php echo e(Form :: text('title' , '', [ 'class' => 'form-control', 'placeholder' => 'Title', ])); ?>

                </div>
                <div class="form-group">
                    <?php echo e(Form :: label('body','Body')); ?>

                    <?php echo e(Form :: textarea('body' , '', ['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Body Text', ])); ?>

                </div>
                <div class="form-group">
                    <?php echo e(Form::file('cover_image')); ?>

                </div>
                <?php echo e(Form :: submit('Submit',['class' => 'btn btn-primary'])); ?>

                <?php echo Form::close(); ?>

            </div>
        </div>
    </section>
    <section class="content">
        
        
    </section>
    <script src="<?php echo e(asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')); ?>"></script>
    <script>
        CKEDITOR.replace('article-ckeditor');
    </script>

    
    
    
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>