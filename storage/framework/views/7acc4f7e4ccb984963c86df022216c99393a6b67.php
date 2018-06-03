<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h1>
            <?php echo e($title); ?>

            <small><?php echo e('Here you will get available route information. You can also add, remove and edit Bus Routes.'); ?></small>
        </h1>
    </section>
    <br><br>
    <section class="content">
            <h1><?php echo e($titleinfo); ?></h1>
        <?php if(count($BusRoute) > 0): ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Serial No</th>
                        <th>Point Name</th>
                        <th>Day</th>
                        <th>Student No</th>
                        <th>Bus No</th>
                    </tr>
                </thead>
                <tbody>
                <?php $flag = 0; ?>
                <?php $__currentLoopData = $BusRoute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr> <?php $bus = 1; ?>  
                        <td><?php echo e($flag+=1); ?></td>
                        <td><a href="/../<?php echo e($route->pointid); ?>"><?php echo e(DB::table('points')->where('id', $route->pointid)->first()->pointname); ?></a></td>
                        <td><?php echo e(DB::table('day')->where('id', $route->dayid)->first()->dayname); ?></td>
                        <td><?php echo e($studentSum = DB::table('bus_student_information')
                            ->where('bus_student_information.routeid', '=', $route->routeid)
                            ->sum('bus_student_information.studentno')); ?></td>
                        <td>
                            <?php if($studentSum/60 > 1): ?>
                                <?php echo e($bus = $bus + ($studentSum/60)); ?>

                            <?php else: ?>
                                <?php echo e($bus); ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
                <?php echo e($BusRoutes->links()); ?>    
        <?php else: ?>
            <p>No information found</p>
        <?php endif; ?>

           
            
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>