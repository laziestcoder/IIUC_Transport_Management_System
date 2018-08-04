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
        <?php if(count($BusRoutes) > 0): ?>
            <table class="table table-hover">
                <thead class="table">
                <tr>
                    <th>No</th>
                    <th>Route Name</th>
                    <th>Day</th>
                    <th>Student No</th>
                    <th>Bus Needed</th>
                    <th>Seat Capacity</th>
                    <th>Standing</th>
                    <th>Total Capacity</th>
                </tr>
                </thead>
                <tbody class="table">
                <?php $flag = 0; ?>
                <?php $__currentLoopData = $BusRoutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr> <?php $bus = 0; $studentSum = 0; $seat = 0;?>
                        <td><?php echo e($flag+=1); ?></td>
                        <td>
                            <a href="/admin/auth/routes/<?php echo e($route->routeid); ?>"><?php echo e(DB::table('routes')->where('id', $route->routeid)->first()->routename); ?></a>
                        </td>
                        <td><?php echo e(DB::table('day')->where('id', $route->dayid)->first()->dayname); ?></td>
                        <td><?php echo e($studentSum = DB::table('bus_student_information')
                            ->where('bus_student_information.id', $route->id)->first()->studentno); ?>

                            
                        </td>
                        <td>
                            <?php $student = $studentSum; ?>
                            <?php if($studentSum/60 > 1): ?>
                                <?php
                                $bus += round($studentSum / (60 * 1.15));
                                //$studentSum = $studentSum%75;
                                if ($studentSum > (60 * 1.15) * $bus && $studentSum % (60 * 1.15) > $bus * 2) {
                                    $bus += 1;
                                }
                                $seat = $bus * 60 * 0.15;
                                if ($student - ($bus * 60) > 60 * 0.35) {
                                    $bus += 1;
                                }
                                ?>
                                <?php echo e($bus); ?>

                            <?php else: ?>
                                <?php echo e($bus += 1); ?>

                            <?php endif; ?>
                        </td>
                        <td><?php echo e($bus*60); ?></td>
                        <td><?php echo e($bus*60*0.15); ?></td>
                        <td><?php echo e(($bus*60*1) .' ('.$student.')'); ?></td>
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