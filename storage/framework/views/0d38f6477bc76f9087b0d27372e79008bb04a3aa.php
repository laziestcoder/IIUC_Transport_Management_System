<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h1>
            <?php echo e($title); ?>

            <small><?php echo e($description); ?></small>
        </h1>
    </section>
    <section class="content">
        <h3><?php echo e($titlenew); ?>

            <small><?php echo e('Before you submit please check the data correctly.'); ?>

            </small>
        </h3>

        <div class="">
            <?php echo Form :: open(['action'=>'ScheduleController@store','method' => 'POST', 'enctype' => 'multipart/form-data' ]); ?>


            <div class="form-group">
                <?php echo e(Form :: label('title','Day')); ?>

                <select name="day" class = "form-control" required="true">
                    <?php if( count($days) > 0 ): ?>
                        <option selected="true" value="" disabled="true" required="true">Pick a day</option>
                        <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="$day->id"><?php echo e($day->dayname); ?></option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <option selected="true" >No Time Found</option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <?php echo e(Form :: label('title','Select Time')); ?>

                <select name="time" class = "form-control" required="true">
                <?php if( count($times) > 0 ): ?>
                        <option selected="true" value="" disabled="true" required="true">Pick a time</option>
                        <?php $__currentLoopData = $times; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="$time->id"><?php echo e(Carbon\Carbon::parse($time->time)->format('g:i A')); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                        <option selected="true" >No Time Found</option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <?php echo e(Form :: label('title','Bus For')); ?>

                <select name="user"  class = "form-control" required="true">
                        <option selected="true" value="" disabled="true" required="true">Pick a user</option>
                        <option value="1"><?php echo e("Students"); ?></option>
                        <option value="2"><?php echo e("Faculty"); ?></option>
                        <option value="3"><?php echo e("Officer/Staff"); ?></option>
                </select>
            </div>

            <fieldset>
                <legend>Choose Bus Criteria</legend>

                <div class="form-group">
                    <?php echo e(Form :: label('title','Male')); ?>

                    <?php echo e(Form :: checkbox('fromiiuc' , '1', ['class' => 'checkbox form-control',])); ?>

                </div>

                <div class="form-group">
                    <?php echo e(Form :: label('title','Female')); ?>

                    <?php echo e(Form :: checkbox('fromiiuc' , '1', ['class' => 'checkbox form-control',])); ?>

                </div>
            </fieldset>

            <div class="form-group">
                <?php echo e(Form :: label('title','Route')); ?>

                <select name="route"  class = "form-control" required="true">
                    <option selected="true" value="" disabled="true" required="true">Pick a route</option>
                    <option value="0"><?php echo e("All Route"); ?></option>
                    <option value="1"><?php echo e("AK Khan"); ?></option>
                </select>
            </div>
            <fieldset>
                <legend>Choose Bus Destination</legend>
            <div class="form-group">
                <?php echo e(Form :: label('title','To IIUC Campus')); ?>

                <?php echo e(Form :: checkbox('toiiuc' , '1', ['class' => 'checkbox form-control', ])); ?>

            </div>

            <div class="form-group">
                <?php echo e(Form :: label('title','From IIUC Campus')); ?>

                <?php echo e(Form :: checkbox('fromiiuc' , '1', ['class' => 'checkbox form-control',])); ?>

            </div>
            </fieldset>

            <?php echo e(Form :: submit('Submit',['class' => 'btn btn-primary'])); ?>

            <?php echo Form :: close(); ?>

        </div>

        

    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>