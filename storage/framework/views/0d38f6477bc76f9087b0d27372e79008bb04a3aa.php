<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h1>
            <?php echo e($title, false); ?>

            <small><?php echo e($description, false); ?></small>
        </h1>
    </section>
    <section class="content">
        <h3><?php echo e($titlenew, false); ?>

            <small><?php echo e('Before you submit please check the data correctly.', false); ?>

            </small>
        </h3>

        <?php echo Form :: open(['action'=>'ScheduleController@store','method' => 'POST', 'enctype' => 'multipart/form-data' ]); ?>


        <div class="form-group">
            <?php echo e(Form :: label('title','Select Day'), false); ?>

            <select name="day" class="form-control" required="true">
                <?php if( count($days) > 0 ): ?>
                    <option selected="true" value="" disabled="true" required="true">Pick a day</option>
                    <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($day->id, false); ?>"><?php echo e($day->dayname, false); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <option selected="true">No Time Found</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="form-group">
            <?php echo e(Form :: label('title','Select Time'), false); ?>

            <select name="time" class="form-control" required="true">
                <?php if( count($times) > 0 ): ?>
                    <option selected="true" value="" disabled="true" required="true">Pick a time</option>
                    <?php $__currentLoopData = $times; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($time->id, false); ?>"><?php echo e(Carbon\Carbon::parse($time->time)->format('g:i A'), false); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <option selected="true">No Time Found</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="form-group">
            <?php echo e(Form :: label('title','Bus For'), false); ?>

            <select name="user" class="form-control" required="true">
                <option selected="true" value="" disabled="true" required="true">Pick a user</option>
                <option value="1"><?php echo e("Students", false); ?></option>
                <option value="2"><?php echo e("Faculty", false); ?></option>
                <option value="3"><?php echo e("Officer/Staff", false); ?></option>
            </select>
        </div>

        <fieldset>
            <legend>Choose Bus Criteria</legend>

            <div class="form-group">
                <?php echo e(Form :: label('title','Male'), false); ?>

                <?php echo e(Form :: checkbox('male' , 1, ['class' => 'checkbox form-control',]), false); ?>

                

                
                <?php echo e(Form :: label('title','Female'), false); ?>

                <?php echo e(Form :: checkbox('female' , 1, ['class' => 'checkbox form-control',]), false); ?>

            </div>
        </fieldset>

        <div class="form-group">
            <?php echo e(Form :: label('title','Select a route'), false); ?>

            <select name="route" class="form-control" required="true">
                <?php if( count($routes) > 0 ): ?>
                    <option selected="true" value="" disabled="true" required="true">Pick a route</option>
                    <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($route->id, false); ?>"><?php echo e($route->routename, false); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <option selected="true">No Route Found</option>
                <?php endif; ?>
            </select>
        </div>
        <fieldset>
            <legend>Choose Bus Destination</legend>
            <div class="form-group">
                <?php echo e(Form :: label('title','To IIUC Campus'), false); ?>

                <?php echo e(Form :: checkbox('toiiuc' , 1, ['class' => 'checkbox form-control', ]), false); ?>

                

                
                <?php echo e(Form :: label('title','From IIUC Campus'), false); ?>

                <?php echo e(Form :: checkbox('fromiiuc' , 1,  ['class' => 'checkbox form-control',]), false); ?>

            </div>
        </fieldset>

        <?php echo e(Form :: submit('Submit',['class' => 'btn btn-primary']), false); ?>

        <?php echo Form :: close(); ?>


        

    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>