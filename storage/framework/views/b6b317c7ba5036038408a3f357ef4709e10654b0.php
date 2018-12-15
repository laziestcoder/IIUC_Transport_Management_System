<?php if (session('success')): ?>
    <div class='alert alert-success'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <strong>
            <?php echo session('success'); ?>

        </strong>
    </div>
<?php endif; ?>

<?php if (session('error')): ?>
    <?php if (count($errors) > 0): ?>
        <?php $__currentLoopData = $errors->all();
        $__env->addLoop($__currentLoopData);
        foreach ($__currentLoopData as $error): $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>
            <div class="alert alert-danger">
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <strong>
                    <?php echo $error; ?>

                </strong>
            </div>
        <?php endforeach;
        $__env->popLoop();
        $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <strong>
                <?php echo session('error'); ?>

            </strong>
        </div>
    <?php endif; ?>
<?php endif; ?>