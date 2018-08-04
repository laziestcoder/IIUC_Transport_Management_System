<?php $__env->startSection('content'); ?>
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
    <section class="content-header">
        <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h1>
            <?php echo e($title); ?>

            <small><?php echo e($description); ?></small>
        </h1>
    </section>
    <br><br>
    <section class="content">
        <h1><?php echo e($titleinfo); ?>

            <small>
                <?php echo e('Before delete a schedule please ensure the schedule is not used in any other data.'); ?>

            </small>
        </h1>
        
        <h2><?php echo e("Schedule by day"); ?><br><br><b><?php echo e("Saturday"); ?></b> </h2>
        <?php if( count($satday) > 0 ): ?>
            <table class="table table-responsive table-hover">
                <thead class="table">
                <tr>
                    <th><?php echo e("ID"); ?></th>
                    <th><?php echo e("To IIUC Campus"); ?></th>
                    <th><?php echo e("From IIUC Campus"); ?></th>
                    <th><?php echo e("Male"); ?></th>
                    <th><?php echo e("Female"); ?></th>
                    <th><?php echo e("Time"); ?></th>
                    <th><?php echo e("Bus For"); ?></th>
                    <th><?php echo e("Bus Route"); ?></th>
                    <th><?php echo e("Added By"); ?></th>
                    <th><?php echo e("Action"); ?></th>
                </tr>
                </thead>
                <tbody class="table">
                <?php $__currentLoopData = $satday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($schedule->id); ?></td>
                        <td><?php echo e($schedule->toiiuc?'YES':'NO'); ?></td>
                        <td><?php echo e($schedule->fromiiuc?'YES':'NO'); ?></td>
                        <td><?php echo e($schedule->male?'YES':'NO'); ?></td>
                        <td><?php echo e($schedule->female?'YES':'NO'); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse(App\Time::where('id',$schedule->time)->first()->time)->format('g:i A')); ?></td>
                        <td><?php echo e($schedule->user == 1 ? 'Students': ( $schedule->user == 2 ? 'Faculty':'Officer/Staff')); ?></td>
                        <td><?php echo e(App\BusRoute::where('id',$schedule->route)->first()->routename); ?></td>
                        <td><?php echo e(Admin::user()->where('id',$schedule->user_id)->first()->name); ?></td>
                        <td>
                            <a href="" class="btn btn-primary">Edit</a>
                            <?php echo Form::open(['action'=>['ScheduleController@destroy', $schedule->id],'method' => 'POST', 'class' => 'pull','id' =>'delete','style'=>'display:inline' /* ,'onclick' => 'function deleteMe()' */]); ?> 
                            <?php echo e(Form::hidden('_method','DELETE')); ?>

                            <?php echo e(csrf_field()); ?>

                            <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle'=>'confirmation','data-placement'=>'top'])); ?>

                            <?php echo Form::close(); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            
        <?php else: ?>
            <p>No Schedule Found</p>
        <?php endif; ?>
        
        
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>