<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h1>
            <?php echo e("BUSINFORMATION HEADER TITLE"); ?>

            <small><?php echo e('Here you will get available route information. You can also add, remove and edit Bus Routes.'); ?></small>
        </h1>
    </section>
    <br><br>
    <section class="content">
        <h1><?php echo e("BUS INFORMATION"); ?></h1>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        {{--<?php $flag = 0; ?>--}}
        
        {{--<tr> <?php $bus = 0; $studentSum = 0; $seat = 0;?>--}}
        
        
        
        
        
        
        
        
        
        
        
        
        
        {{--<?php $student = $studentSum; ?>--}}
        
        {{--<?php--}}
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>