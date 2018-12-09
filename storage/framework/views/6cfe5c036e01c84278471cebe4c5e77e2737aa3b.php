<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h1>
            <?php echo e($title, false); ?>

            <small><?php echo e($smallTitle, false); ?></small>
        </h1>
    </section>
    <section class="content">
        <h1><?php echo e($titleinfo, false); ?></h1>
        <br>
        <?php if($today): ?>
            <h4>Today is <b><?php echo $today; ?></b>. Today's Bus Management Information:</h4>
            <br>

            <?php if(count($routes) > 0): ?>
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
                    <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr> <?php $bus = 0; $studentSum = 0; $seat = 0;?>
                            <td><?php echo e($flag+=1, false); ?></td>
                            <td>
                                
                                    <?php echo e($route->routename, false); ?>

                                
                            </td>
                            <td><?php $studentSum = DB::table('bus_student_information')
                                    ->where('routeid', $route->id)
                                    ->where('dayid', $todayid->id)
                                    ->get(); ?>
                                <?php echo count($studentSum); ?>

                            </td>
                            <td>
                                <?php
                                $studentSum = count($studentSum);
                                $student = $studentSum; ?>
                                <?php if((($studentSum/60) > 1) && ($studentSum > 0) ): ?>
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
                                    <?php echo e($bus, false); ?>

                                <?php endif; ?>
                            </td>
                            <td><?php echo e($bus*60, false); ?></td>
                            <td><?php echo e($bus*60*0.15, false); ?></td>
                            <td><?php echo e(($bus*60*1) .' ('.$student.')', false); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p><h4>No routes found for today ! :( </h4></p>
            <?php endif; ?>
        <?php else: ?>
            <p><h4> No Data Fount For Today!</h4></p>
        <?php endif; ?>


        <br>
        <h3> Here all day wise bus management information: </h3>
        <?php if(count($routes) > 0): ?>
            <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <br>
                <h4><b><?php echo $day->dayname; ?></b></h4>
                <br>
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
                    <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr> <?php $bus = 0;  $studentSum = 0; $seat = 0;?>
                            <td><?php echo e($flag+=1, false); ?></td>
                            <td>
                                
                                    <?php echo e($route->routename, false); ?>

                                
                            </td>
                            <td><?php $studentSum = DB::table('bus_student_information')
                                    ->where('routeid', $route->id)
                                    ->where('dayid', $day->id)
                                    ->get(); ?>
                                <?php echo count($studentSum); ?>

                            </td>
                            <td>
                                <?php
                                $studentSum = count($studentSum);
                                $student = $studentSum;
                                ?>

                                <?php if((($studentSum/60) > 1) && ($studentSum > 0) ): ?>
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
                                    <?php echo $bus; ?>

                                <?php else: ?>
                                    <?php echo $bus; ?>

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
        <?php else: ?>
            <p><h4>No information found</h4></p>
        <?php endif; ?>

        
        
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>