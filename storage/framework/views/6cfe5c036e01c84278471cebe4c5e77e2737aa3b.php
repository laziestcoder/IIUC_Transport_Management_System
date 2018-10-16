<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h1>
            <?php echo e($title, false); ?>

            <small><?php echo e($smallTitle, false); ?></small>
        </h1>
    </section>
    <br><br>
    <section class="content">
        <h1><?php echo e($titleinfo, false); ?></h1>
        <?php if(count($BusRoutes) > 0): ?>
            <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($day->dayname, false); ?>

                <table class="table table-hover">
                    <thead class="table">
                    <tr>
                        <th>No</th>
                        <th>Route Name</th>
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
                            <td><?php echo e($flag+=1, false); ?></td>
                            <td>
                                <a href="/admin/auth/routes/<?php echo e($route->id, false); ?>"><?php echo e($route->routename, false); ?></a>
                            </td>
                            <td><?php $studentSum = DB::table('schedulestudent')
                                    ->where('schedulestudent.pickpoint', $route->id)
                                    ->get(); ?>
                                <?php echo count($studentSum); ?>

                            </td>
                            <td>
                                <?php $student = $studentSum = 60; ?>
                                <?php if(($studentSum/60) > 1): ?>
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
                                    <?php echo e($bus, false); ?>

                                <?php else: ?>
                                    <?php echo e($bus += 1, false); ?>

                                <?php endif; ?>
                            </td>
                            <td><?php echo e($bus*60, false); ?></td>
                            <td><?php echo e($bus*60*0.15, false); ?></td>
                            <td><?php echo e(($bus*60*1) .' ('.$student.')', false); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($BusRoutes->links(), false); ?>


        <?php else: ?>
            <p>No information found</p>
        <?php endif; ?>

        
        
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>