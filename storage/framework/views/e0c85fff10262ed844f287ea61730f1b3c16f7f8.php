<?php $__env->startSection('content'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>

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
        
        <h3><b><?php echo e("All Schedule", false); ?></b><br><br></h3>
        <?php if(count($schedules) > 0): ?>
            <table class="table table-hover">
                <thead class="table">
                <tr>
                    <th>Sl</th>
                    <th>ID</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Route</th>
                    <th>Male</th>
                    <th>Female</th>
                    <th>To IIUC</th>
                    <th>From IIUC</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="table">
                <?php $sl = 0;?>
                <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($sl+=1, false); ?></td>
                        <td><?php echo e($schedule->id, false); ?></td>
                        <td><?php echo e(App\Day::where('id',$schedule->day)->first()->dayname, false); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse(App\Time::where('id',$schedule->time)->first()->time)->format('g:i A'), false); ?></td>
                        <td><?php echo e(App\BusRoute::where('id',$schedule->route)->first()->routename, false); ?></td>
                        <td><?php echo e($schedule->male? 'YES' : 'NO', false); ?></td>
                        <td><?php echo e($schedule->female? 'YES' : 'NO', false); ?></td>
                        <td><?php echo e($schedule->toiiuc? 'YES' : 'NO', false); ?></td>
                        <td><?php echo e($schedule->fromiiuc? 'YES' : 'NO', false); ?></td>
                        <td>
                            <?php if((Admin::user()->id == $schedule->user_id)||(DB::table('admin_role_users')->where('user_id',(Admin::user()->id))->first()->role_id <= 4)): ?>
                                <a href="" class="btn btn-primary">Edit</a>
                                <?php echo Form::open(['action'=>['ScheduleController@destroy', $schedule->id],'method' => 'POST', 'class' => 'pull','id' =>'delete','style'=>'display:inline' /* ,'onclick' => 'function deleteMe()' */]); ?>

                                
                                <?php echo e(Form::hidden('_method','DELETE'), false); ?>

                                <?php echo e(csrf_field(), false); ?>

                                <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle'=>'confirmation','data-placement'=>'top']), false); ?>

                                <?php echo Form::close(); ?>

                            <?php else: ?>
                                <?php echo e("You are not eligible", false); ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

        <?php else: ?>
            <p>No Schedule Found</p>
        <?php endif; ?>
    </section>
    <script>
        $(document).ready(function () {
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function (event, element) {
                    element.closest('form').submit();
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>