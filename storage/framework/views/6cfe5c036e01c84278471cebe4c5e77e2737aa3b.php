<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h1>
            <?php echo e($title, false); ?>

            <small><?php echo e($smallTitle, false); ?></small>
        </h1>
    </section>
    <section class="content">
        <?php if($today): ?>
            <h4 align="center">Tomorrow is <b><?php echo $today; ?></b><br> Tomorrow's Bus Requirement Information</h4>
            <br>
            <a class="btn btn-success" target="_blank" href='/tomorrow-bus-requirement'>
                <i class="fa fa-info-circle"></i> Details
            </a>
            <?php if(count($routes) > 0): ?>
                <h4><b><big><?php echo e("Female Students", false); ?></big></b></h4>
                <table class="table table-responsive table-hover table-bordered table-condensed">
                    <thead class="table">
                    <tr>
                        <th>No</th>
                        <th>Route Name</th>
                        <th> No of Students (Arrival)</th>
                        <th></th>
                        
                        <th> No of Students (Departure)</th>
                        <th></th>
                        
                    </tr>
                    </thead>
                    <tbody class="table" align="center">
                    <?php $flag = 0;
                    $stdArvTot = 0;
                    $busArvTot = 0;
                    $busSeatArvTot = 0;
                    $busStandArvTot = 0;
                    $busStandSeatArvTot = 0;
                    $stdDepTot = 0;
                    $busDepTot = 0;
                    $busSeatDepTot = 0;
                    $busStandDepTot = 0;
                    $busStandSeatDepTot = 0;
                    ?>
                    <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <?php $bus = 0; $studentSum = 0; $seat = 0;?>
                            <td><?php echo e($flag+=1, false); ?></td>
                            <td>
                                
                                <?php echo e($route->routename, false); ?>

                                
                            </td>


                            

                            <td>
                                <?php
                                //$routeID = ;
                                $studentSum = DB::table('schedulestudent')
                                    ->where('pick_point_route', $route->id)
                                    ->where('day', $todayid->id)
                                    ->where('user_gender', true)
                                    ->get(); ?>
                                <?php echo count($studentSum); ?>

                            </td>
                            <td></td>
                            
                            <?php
                            // $stdArvTot = $stdArvTot + count($studentSum);
                            // $studentSum = count($studentSum);
                            // $student = $studentSum;
                            // if ($student) {
                            //     $bus = 1;
                            // } else {
                            //     $bus = 0;
                            // }
                            ?>
                            
                            <?php
                            // $bus += round($studentSum / (60 * 1.15));
                            // //$studentSum = $studentSum%75;
                            // if ($studentSum > (60 * 1.15) * $bus && $studentSum % (60 * 1.15) > $bus * 2) {
                            //     $bus += 1;
                            // }
                            // $seat = $bus * 60 * 0.15;
                            // if ($student - ($bus * 60) > 60 * 0.35) {
                            //     $bus += 1;
                            // }
                            ?>
                            
                            <?php
                            //$busArvTot = $busArvTot + $bus;
                            ?>
                            
                            
                            <?php
                            // $busSeatArvTot = $busSeatArvTot + ($bus * 60);
                            ?>
                            
                            <?php
                            // $busStandArvTot = $busStandArvTot + $bus * 60 * 0.15; ?>
                            


                            
                            <td><?php
                                $studentSum = DB::table('schedulestudent')
                                    ->where('drop_point_route', $route->id)
                                    ->where('day', $todayid->id)
                                    ->where('user_gender', true)
                                    ->get(); ?>
                                <?php echo count($studentSum); ?>

                            </td>
                            <td></td>
                            
                            <?php
                            // $stdDepTot = $stdDepTot + count($studentSum);
                            // $studentSum = count($studentSum);
                            // $student = $studentSum;
                            // if ($student) {
                            // $bus = 1;
                            // } else {
                            // $bus = 0;
                            // }
                            ?>
                            
                            <?php
                            // $bus += round($studentSum / (60 * 1.15));
                            // // $studentSum = $studentSum%75;
                            // if ($studentSum > (60 * 1.15) * $bus && $studentSum % (60 * 1.15) > $bus * 2) {
                            // $bus += 1;
                            // }
                            // $seat = $bus * 60 * 0.15;
                            // if ($student - ($bus * 60) > 60 * 0.35) {
                            // $bus += 1;
                            // }
                            ?>
                            
                            
                            <?php
                            // $busDepTot = $busDepTot + $bus;
                            ?>
                            
                            
                            <?php
                            // $busSeatDepTot = $busSeatDepTot + ($bus * 60);
                            ?>
                            
                            <?php
                            // $busStandDepTot = $busStandDepTot + $bus * 60 * 0.15;
                            ?>
                            
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    </tbody>
                </table>

                <h4><b><big><?php echo e("Male Students", false); ?></big></b></h4>
                <table class="table table-responsive table-hover table-bordered table-condensed">
                    <thead class="table">
                    <tr>
                        <th>No</th>
                        <th>Route Name</th>
                        <th> No of Students (Arrival)</th>
                        <th></th>
                        
                        <th> No of Students (Departure)</th>
                        <th></th>
                        
                    </tr>
                    </thead>
                    <tbody class="table" align="center">
                    <?php $flag = 0;
                    $stdArvTot = 0;
                    $busArvTot = 0;
                    $busSeatArvTot = 0;
                    $busStandArvTot = 0;
                    $busStandSeatArvTot = 0;
                    $stdDepTot = 0;
                    $busDepTot = 0;
                    $busSeatDepTot = 0;
                    $busStandDepTot = 0;
                    $busStandSeatDepTot = 0;
                    ?>
                    <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <?php $bus = 0; $studentSum = 0; $seat = 0;?>
                            <td><?php echo e($flag+=1, false); ?></td>
                            <td>
                                
                                <?php echo e($route->routename, false); ?>

                                
                            </td>


                            

                            <td><?php
                                //$routeID = ;
                                $studentSum = DB::table('schedulestudent')
                                    ->where('pick_point_route', $route->id)
                                    ->where('day', $todayid->id)
                                    ->where('user_gender', false)
                                    ->get(); ?>
                                <?php echo count($studentSum); ?>

                            </td>
                            <td></td>
                            
                            <?php
                            // $stdArvTot = $stdArvTot + count($studentSum);
                            // $studentSum = count($studentSum);
                            // $student = $studentSum;
                            // if ($student) {
                            //     $bus = 1;
                            // } else {
                            //     $bus = 0;
                            // }
                            ?>
                            
                            <?php
                            // $bus += round($studentSum / (60 * 1.15));
                            // //$studentSum = $studentSum%75;
                            // if ($studentSum > (60 * 1.15) * $bus && $studentSum % (60 * 1.15) > $bus * 2) {
                            //     $bus += 1;
                            // }
                            // $seat = $bus * 60 * 0.15;
                            // if ($student - ($bus * 60) > 60 * 0.35) {
                            //     $bus += 1;
                            // }
                            ?>
                            
                            <?php
                            // $busArvTot = $busArvTot + $bus; ?>
                            
                            
                            <?php
                            // $busSeatArvTot = $busSeatArvTot + ($bus * 60); ?>
                            
                            <?php
                            // $busStandArvTot = $busStandArvTot + $bus * 60 * 0.15; ?>
                            


                            
                            <td><?php
                                $studentSum = DB::table('schedulestudent')
                                    ->where('drop_point_route', $route->id)
                                    ->where('day', $todayid->id)
                                    ->where('user_gender', false)
                                    ->get(); ?>
                                <?php echo count($studentSum); ?>

                            </td>
                            <td></td>
                            
                            <?php
                            // $stdDepTot = $stdDepTot + count($studentSum);
                            // $studentSum = count($studentSum);
                            // $student = $studentSum;
                            // if ($student) {
                            //     $bus = 1;
                            // } else {
                            //     $bus = 0;
                            // }
                            ?>
                            
                            <?php
                            // $bus += round($studentSum / (60 * 1.15));
                            // //$studentSum = $studentSum%75;
                            // if ($studentSum > (60 * 1.15) * $bus && $studentSum % (60 * 1.15) > $bus * 2) {
                            //     $bus += 1;
                            // }
                            // $seat = $bus * 60 * 0.15;
                            // if ($student - ($bus * 60) > 60 * 0.35) {
                            //     $bus += 1;
                            // }
                            ?>
                            
                            <?php
                            // $busDepTot = $busDepTot + $bus; ?>
                            
                            
                            <?php
                            // $busSeatDepTot = $busSeatDepTot + ($bus * 60); ?>
                            
                            <?php
                            // $busStandDepTot = $busStandDepTot + $bus * 60 * 0.15; ?>
                            
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    </tr>
                    </tbody>
                </table>
            <?php else: ?>
                <p><h4>No routes found for today ! </h4></p>
            <?php endif; ?>
        <?php else: ?>
            <p><h4> No Data Found For Today!</h4></p>
        <?php endif; ?>


        <br>
        <h2> Here all day wise bus management information: </h2>
        <?php if(count($days) > 0): ?>
            <?php if(count($routes) > 0): ?>
                <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <br>
                    <h3><b><?php echo $day->dayname; ?></b></h3>
                    <h5><b><big><?php echo e("Female Students", false); ?></big></b></h5>
                    <table class="table table-responsive table-hover table-bordered table-condensed">
                        <thead class="table">
                        <tr>
                            <th>No</th>
                            <th>Route Name</th>
                            <th> No of Students (Arrival)</th>
                            <th></th>
                            
                            <th> No of Students (Departure)</th>
                            <th></th>
                            

                        </tr>
                        </thead>
                        <tbody class="table" align="center">
                        <?php $flag = 0;
                        $stdArvTot = 0;
                        $busArvTot = 0;
                        $busSeatArvTot = 0;
                        $busStandArvTot = 0;
                        $busStandSeatArvTot = 0;
                        $stdDepTot = 0;
                        $busDepTot = 0;
                        $busSeatDepTot = 0;
                        $busStandDepTot = 0;
                        $busStandSeatDepTot = 0;
                        ?>
                        <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php $bus = 0; $studentSum = 0; $seat = 0;?>
                                <td><?php echo e($flag+=1, false); ?></td>
                                <td>
                                    
                                    <?php echo e($route->routename, false); ?>

                                    
                                </td>


                                

                                <td>
                                    <?php
                                    //$routeID = ;
                                    $studentSum = DB::table('schedulestudent')
                                        ->where('pick_point_route', $route->id)
                                        ->where('day', $day->id)
                                        ->where('user_gender', true)
                                        ->get(); ?>
                                    <?php echo count($studentSum); ?>

                                </td>
                                <td></td>
                                
                                <?php
                                // $stdArvTot = $stdArvTot + count($studentSum);
                                // $studentSum = count($studentSum);
                                // $student = $studentSum;
                                // if ($student) {
                                //     $bus = 1;
                                // } else {
                                //     $bus = 0;
                                // }
                                ?>
                                
                                <?php
                                // $bus += round($studentSum / (60 * 1.15));
                                // //$studentSum = $studentSum%75;
                                // if ($studentSum > (60 * 1.15) * $bus && $studentSum % (60 * 1.15) > $bus * 2) {
                                //     $bus += 1;
                                // }
                                // $seat = $bus * 60 * 0.15;
                                // if ($student - ($bus * 60) > 60 * 0.35) {
                                //     $bus += 1;
                                // }
                                ?>
                                
                                <?php
                                //$busArvTot = $busArvTot + $bus; 
                                ?>
                                
                                
                                <?php
                                // $busSeatArvTot = $busSeatArvTot + ($bus * 60);
                                ?>
                                
                                <?php
                                // $busStandArvTot = $busStandArvTot + $bus * 60 * 0.15; ?>
                                


                                
                                <td><?php
                                    $studentSum = DB::table('schedulestudent')
                                        ->where('drop_point_route', $route->id)
                                        ->where('day', $day->id)
                                        ->where('user_gender', true)
                                        ->get(); ?>
                                    <?php echo count($studentSum); ?>

                                </td>
                                <td></td>
                                
                                <?php
                                // $stdDepTot = $stdDepTot + count($studentSum);
                                // $studentSum = count($studentSum);
                                // $student = $studentSum;
                                // if ($student) {
                                // $bus = 1;
                                // } else {
                                // $bus = 0;
                                // }
                                ?>
                                
                                <?php
                                // $bus += round($studentSum / (60 * 1.15));
                                // // $studentSum = $studentSum%75;
                                // if ($studentSum > (60 * 1.15) * $bus && $studentSum % (60 * 1.15) > $bus * 2) {
                                // $bus += 1;
                                // }
                                // $seat = $bus * 60 * 0.15;
                                // if ($student - ($bus * 60) > 60 * 0.35) {
                                // $bus += 1;
                                // }
                                ?>
                                
                                
                                <?php
                                // $busDepTot = $busDepTot + $bus; 
                                ?>
                                
                                
                                <?php
                                // $busSeatDepTot = $busSeatDepTot + ($bus * 60);
                                ?>
                                
                                <?php
                                // $busStandDepTot = $busStandDepTot + $bus * 60 * 0.15;
                                ?>
                                
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        </tbody>
                    </table>

                    <h5><b><big><?php echo e("Male Students", false); ?></big></b></h5>
                    <table class="table table-responsive table-hover table-bordered table-condensed">
                        <thead class="table">
                        <tr>
                            <th>No</th>
                            <th>Route Name</th>
                            <th> No of Students (Arrival)</th>
                            <th></th>
                            
                            <th> No of Students (Departure)</th>
                            <th></th>
                            
                        </tr>
                        </thead>
                        <tbody class="table" align="center">
                        <?php $flag = 0;
                        $stdArvTot = 0;
                        $busArvTot = 0;
                        $busSeatArvTot = 0;
                        $busStandArvTot = 0;
                        $busStandSeatArvTot = 0;
                        $stdDepTot = 0;
                        $busDepTot = 0;
                        $busSeatDepTot = 0;
                        $busStandDepTot = 0;
                        $busStandSeatDepTot = 0;
                        ?>
                        <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php $bus = 0; $studentSum = 0; $seat = 0;?>
                                <td><?php echo e($flag+=1, false); ?></td>
                                <td>
                                    
                                    <?php echo e($route->routename, false); ?>

                                    
                                </td>


                                

                                <td><?php
                                    //$routeID = ;
                                    $studentSum = DB::table('schedulestudent')
                                        ->where('pick_point_route', $route->id)
                                        ->where('day', $day->id)
                                        ->where('user_gender', false)
                                        ->get(); ?>
                                    <?php echo count($studentSum); ?>

                                </td>
                                <td></td>
                                
                                <?php
                                // $stdArvTot = $stdArvTot + count($studentSum);
                                // $studentSum = count($studentSum);
                                // $student = $studentSum;
                                // if ($student) {
                                //     $bus = 1;
                                // } else {
                                //     $bus = 0;
                                // }
                                ?>
                                
                                <?php
                                // $bus += round($studentSum / (60 * 1.15));
                                // //$studentSum = $studentSum%75;
                                // if ($studentSum > (60 * 1.15) * $bus && $studentSum % (60 * 1.15) > $bus * 2) {
                                //     $bus += 1;
                                // }
                                // $seat = $bus * 60 * 0.15;
                                // if ($student - ($bus * 60) > 60 * 0.35) {
                                //     $bus += 1;
                                // }
                                ?>
                                
                                <?php
                                // $busArvTot = $busArvTot + $bus; ?>
                                
                                
                                <?php
                                // $busSeatArvTot = $busSeatArvTot + ($bus * 60); ?>
                                
                                <?php
                                // $busStandArvTot = $busStandArvTot + $bus * 60 * 0.15; ?>
                                


                                
                                <td><?php
                                    $studentSum = DB::table('schedulestudent')
                                        ->where('drop_point_route', $route->id)
                                        ->where('day', $day->id)
                                        ->where('user_gender', false)
                                        ->get(); ?>
                                    <?php echo count($studentSum); ?>

                                </td>
                                <td></td>
                                
                                <?php
                                // $stdDepTot = $stdDepTot + count($studentSum);
                                // $studentSum = count($studentSum);
                                // $student = $studentSum;
                                // if ($student) {
                                //     $bus = 1;
                                // } else {
                                //     $bus = 0;
                                // }
                                ?>
                                
                                <?php
                                // $bus += round($studentSum / (60 * 1.15));
                                // //$studentSum = $studentSum%75;
                                // if ($studentSum > (60 * 1.15) * $bus && $studentSum % (60 * 1.15) > $bus * 2) {
                                //     $bus += 1;
                                // }
                                // $seat = $bus * 60 * 0.15;
                                // if ($student - ($bus * 60) > 60 * 0.35) {
                                //     $bus += 1;
                                // }
                                ?>
                                
                                <?php
                                // $busDepTot = $busDepTot + $bus; ?>
                                
                                
                                <?php
                                // $busSeatDepTot = $busSeatDepTot + ($bus * 60); ?>
                                
                                <?php
                                // $busStandDepTot = $busStandDepTot + $bus * 60 * 0.15; ?>
                                
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            
                        </tr>
                        </tbody>
                    </table>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <p><h4>No Route Found!</h4></p>
            <?php endif; ?>
        <?php else: ?>
            <p><h4>No Data Found!</h4></p>
        <?php endif; ?>
        <?php
        function BusNotAvailable($id)
        {
            $change = App\BusInfo::findOrFail($id);

            if ($change) {
                $change->availability = 0;
                $change->save();
            }
        }
        ?>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>