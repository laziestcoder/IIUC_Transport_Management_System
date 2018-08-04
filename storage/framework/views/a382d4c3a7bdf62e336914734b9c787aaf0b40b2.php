<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h1>
            <?php echo e($title); ?>

            <small><?php echo e('Here you will get available bus time information. You can also add, remove and edit bus time.'); ?>

            </small>
        </h1>
    </section>
    <section class="content">

        <h3><?php echo e($newday); ?>

            <small><?php echo e('Before you submit please change the time correctly.'); ?>

            </small>
        </h3>
        

        <?php echo Form :: open(['action'=>'DayController@store','method' => 'POST', 'enctype' => 'multipart/form-data' ]); ?>

        <div class="form-group">
            <?php echo e(Form :: label('title','Write Day Name :')); ?>

            <?php echo Form::text('day', \Carbon\Carbon::now()->format('l')); ?>

        </div>
        <?php echo e(Form :: submit('Submit',['class' => 'btn btn-primary'])); ?>

        <?php echo Form::close(); ?>


        

    </section>
    <section class="content">
        <h3><?php echo e($titleinfo); ?>

            <small>
                <?php echo e('Before delete a day please ensure the day is not used in any other data.'); ?>

            </small>
        </h3>
        <?php if( count($days) > 0 ): ?>
            <table class="table table-hover">
                <thead class="table">
                <tr>
                    <th>No</th>
                    <th>Day</th>
                    <th>Day ID</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="table">
                <?php $flag = 0; ?>
                <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($flag+=1); ?></td>
                        <td><?php echo e($day->dayname); ?></td>
                        <td><?php echo e($day->id); ?></td>
                        <td>
                            
                            <?php echo Form::open(['action' => ['DayController@destroy', $day->id], 'method' => 'POST', 'class' => 'pull','id' =>'delete','style'=>'display:inline'  /* ,'onclick' => 'function deleteMe()' */  ]); ?> 
                            <?php echo e(Form::hidden('_method','DELETE')); ?>

                            <?php echo e(csrf_field()); ?>

                            <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle'=>'confirmation','data-placement'=>'top'])); ?>

                            <?php echo Form::close(); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($days->links()); ?>

        <?php else: ?>
            <h3>No Time Found</h3>
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