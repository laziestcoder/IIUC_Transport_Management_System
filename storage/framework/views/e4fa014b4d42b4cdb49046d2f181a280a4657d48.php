<?php $__env->startSection('content'); ?>

    
    
    
    
    
    
    
    
    
    
    <section class="content-header">
        <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h1>
            <?php echo e($title, false); ?>

            <small><?php echo e($description, false); ?></small>
        </h1>
    </section>
    <br>
    <section class="content">
        <h2><?php echo e($titleinfo, false); ?>

            <small>
                <?php echo e('Before delete a schedule please ensure the schedule is not used in any other data.', false); ?>

            </small>
        </h2>
        <?php if( count($days) > 0 ): ?>
            <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($day->id != 9): ?>
                    <h3><b><?php echo e("$day->dayname", false); ?></b></h3>
                    <table class="table table-hover table-bordered">
                        <thead class="table">
                        <tr>
                            <th><?php echo e("No.", false); ?></th>
                            <th><?php echo e("Starting Time", false); ?></th>
                            <th><?php echo e("Gender", false); ?></th>
                            <th><?php echo e("Direction", false); ?></th>
                            <th><?php echo e("Starting Point", false); ?></th>
                            <th><?php echo e("Added By", false); ?></th>
                            
                        </tr>
                        </thead>
                        <tbody class="table">
                        <?php $sl = 0; ?>
                        <?php $__currentLoopData = $times; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $schedules = App\Schedule::where('day', $day->id)
                                ->where('time', $time->id)
                                ->get();?>
                            <?php if(count($schedules) > 0): ?>
                                <tr>

                                    <td><?php echo e($sl +=1, false); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse(App\Time::where('id',$time->id)->first()->time)->format('g:i A'), false); ?></td>

                                    <?php $male = App\Schedule::where('day', $day->id)
                                        ->where('time', $time->id)
                                        ->where('male', '1')
                                        ->get();
                                    $female = App\Schedule::where('day', $day->id)
                                        ->where('time', $time->id)
                                        ->where('female', '1')
                                        ->get();?>

                                    <td>
                                        <?php echo e(count($male)? 'Male':'', false); ?>

                                        <?php if(count($male) && count($female)): ?>
                                            <?php echo e(",", false); ?>

                                        <?php endif; ?>
                                        <?php echo e(count($female)? 'Female':'', false); ?>

                                    </td>

                                    <?php $toiiuc = App\Schedule::where('day', $day->id)
                                        ->where('time', $time->id)
                                        ->where('toiiuc', '1')
                                        ->get();
                                    $fromiiuc = App\Schedule::where('day', $day->id)
                                        ->where('time', $time->id)
                                        ->where('fromiiuc', '1')
                                        ->get();?>

                                    <td>
                                        <?php echo e(count($toiiuc)? 'To IIUC Campus':'', false); ?>

                                        <?php if(count($toiiuc) && count($fromiiuc)): ?>
                                            <?php echo e(",", false); ?>

                                        <?php endif; ?>
                                        <?php echo e(count($fromiiuc)? 'From IIUC Campus':'', false); ?>

                                    </td>

                                    <?php $routes = App\Schedule::where('day', $day->id)
                                        ->where('time', $time->id)
                                        ->get();
                                    if (count($routes) > 1) {
                                        $routeFlag = count($routes) - 1;
                                    } else {
                                        $routeFlag = 0;
                                    }?>

                                    <td>
                                        <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e(\App\BusRoute::where('id',$route->route)->first()->routename, false); ?>

                                            <?php if($routeFlag): ?>
                                                <?php echo e(", ", false); ?>

                                            <?php endif; ?>
                                            <?php $routeFlag -= 1;?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <?php $userid = App\Schedule::where('day', $day->id)
                                        ->where('time', $time->id)
                                        ->first(); ?>
                                    <td><?php echo e(Admin::user()->where('id',$userid->user_id)->first()->name, false); ?></td>

                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p>No Schedule Found</p>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>