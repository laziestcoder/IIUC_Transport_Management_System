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
        <?php if(count($BusStudents) > 0): ?>
            <table class="table table-hover">
                <thead class="table">
                <tr>
                    <th>Serial No</th>
                    <th>Point Name</th>
                    <th>Day</th>
                    <th>Student No</th>
                    <th>Bus No</th>
                </tr>
                </thead>
                <tbody class="table">
                <?php $flag = 0; ?>
                <?php $__currentLoopData = $BusStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $BusStudent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr> <?php $bus = 1; ?>
                        <td><?php echo e($flag+=1); ?></td>
                        <td>
                            <a href="/../<?php echo e($BusStudent->pointid); ?>"><?php echo e(App\BusPoint::where('id', $BusStudent->pointid)->first()->pointname? App\BusPoint::where('id', $BusStudent->pointid)->first()->pointname : 'Not Available'); ?></a>
                        </td>
                        <td><?php echo e(DB::table('day')->where('id', $route->dayid)->first()->dayname); ?></td>
                        <td><?php echo e($studentSum = DB::table('bus_student_information')
                            ->where('bus_student_information.routeid', '=', $BusStudent->routeid)
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
            <?php echo e($BusStudent->links()); ?>

        <?php else: ?>
            <p>No information found</p>
        <?php endif; ?>

        
        
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>