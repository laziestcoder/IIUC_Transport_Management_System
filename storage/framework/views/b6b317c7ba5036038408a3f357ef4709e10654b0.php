<?php if (count($errors) > 0): ?>
    <?php $__currentLoopData = $errors->all();
    $__env->addLoop($__currentLoopData);
    foreach ($__currentLoopData as $error): $__env->incrementLoopIndices();
        $loop = $__env->getLastLoop(); ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>

        </div>
    <?php endforeach;
    $__env->popLoop();
    $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php if (session('success')): ?>
    <div class='alert alert-success'>
        <?php echo session('success'); ?>

    </div>
<?php endif; ?>

<?php if (session('error')): ?>
    <div class='alert alert-danger'>
        <?php echo session('error'); ?>

    </div>
<?php endif; ?>