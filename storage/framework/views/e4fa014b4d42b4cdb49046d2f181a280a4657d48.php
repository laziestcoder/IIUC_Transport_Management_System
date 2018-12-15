<?php $__env->startSection('content'); ?>

    
    
    
    
    
    
    
    
    
    
    <section class="content-header">
        <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h1>
            <?php echo e($title, false); ?>

            <small><?php echo e($description, false); ?></small>
        </h1>
    </section>
    <br>
    <section class="content">
        <h2><?php echo e($titleinfo, false); ?>

        </h2>

        <?php if( count($days) > 0 ): ?>
            <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <h3><b><?php echo e("$day->dayname", false); ?></b></h3>

                <?php if( $day->id == 7  ): ?>
                    <a class="btn btn-success" target="_blank" href='/bus-schedule-friday'>
                        <i class="fa fa-print"></i>Print
                    </a>
                <?php elseif($day->id <= 5 && $day->id >= 1 ): ?>
                    <a class="btn btn-success" target="_blank" href='/bus-schedule-pdf'>
                        <i class="fa fa-print"></i> Print
                    </a>
                <?php endif; ?>
                <br>
                <h4><b><?php echo e("Towards IIUC", false); ?></b></h4>
                <table class="table table-hover table-bordered table-responsive-lg">
                    <thead class="table">
                    <tr>
                        <th><?php echo e("No.", false); ?></th>
                        <th><?php echo e("Starting Time", false); ?></th>
                        <th><?php echo e("Gender", false); ?></th>
                        <th><?php echo e("Route", false); ?></th>
                        <th><?php echo e("Added By", false); ?></th>
                        
                    </tr>
                    </thead>
                    <tbody class="table">
                    <?php $sl = 0; ?>
                    <?php $__currentLoopData = $times; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $schedules = App\Schedule::where('day', $day->id)
                            ->where('time', $time->id)
                            ->where('toiiuc', 1)
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
                <h4><b><?php echo e("From IIUC", false); ?></b></h4>
                <table class="table table-hover table-bordered table-responsive-lg">
                    <thead class="table">
                    <tr>
                        <th><?php echo e("No.", false); ?></th>
                        <th><?php echo e("Starting Time", false); ?></th>
                        <th><?php echo e("Gender", false); ?></th>
                        <th><?php echo e("Route", false); ?></th>
                        <th><?php echo e("Added By", false); ?></th>
                        
                    </tr>
                    </thead>
                    <tbody class="table">
                    <?php $sl = 0; ?>
                    <?php $__currentLoopData = $times; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $schedules = App\Schedule::where('day', $day->id)
                            ->where('time', $time->id)
                            ->where('fromiiuc', 1)
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p>No Schedule Found</p>
        <?php endif; ?>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>