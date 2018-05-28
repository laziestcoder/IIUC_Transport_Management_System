<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <a href="/notices/create" class="btn btn-primary">Create Notice</a>
                    <h3>Your Posted Notices</h3>
                    <?php if( count($notices) >0 ): ?>
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a href="/notices/<?php echo e($notice->id); ?>"><?php echo e($notice->title); ?></a></td>
                                    <td><a href="/notices/<?php echo e($notice->id); ?>/edit" class="btn btn-default">Edit</a></td>
                                    <td>
                                        <?php echo Form::open(['action' => ['NoticesController@destroy', $notice->id], 'method' => 'POST', 'class' => 'pull-right' ]); ?>

                                            <?php echo e(Form::hidden('_method','DELETE')); ?>

                                            <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger'])); ?>

                                        <?php echo Form::close(); ?>

                                    </td>
                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                    <?php else: ?>
                    <p> You have no post </p>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>