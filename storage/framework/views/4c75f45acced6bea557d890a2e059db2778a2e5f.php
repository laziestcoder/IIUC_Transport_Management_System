<?php $__env->startSection('content'); ?>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>

    <section class="content-header">
        <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h1>
            <?php echo e($title); ?>

            <small><?php echo e('Here you will get available route information. You can also add, remove and edit Bus Routes.'); ?></small>
        </h1>
        <br><br>
            <?php echo Form :: open(['action' => ['BusRoutesController@update', $BusRoute->id ], 'method' => 'POST', 'enctype' => 'multipart/form-data' ]); ?>

        <div class="form-group">
            <?php echo e(Form :: label('title','Bus Route Name')); ?>

            <?php echo e(Form :: text('routename' , $BusRoute->routename, [ 'class' => 'form-control', 'placeholder' => 'Type Route Name', ])); ?>

        </div>
        
        
        <?php echo e(Form::hidden('_method','PUT')); ?>

        <?php echo e(Form :: submit('Save',['class' => 'btn btn-primary'])); ?>

        <?php echo Form::close(); ?>


    </section>
    <br><br>
    <section class="content">
        
            <h1><?php echo e($titleinfo); ?></h1>
        <?php if(count($BusRoutes) > 0): ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Route Name</th>
                    <th>Added By</th>
                    <th>Added On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $flag = 0; ?>
            <?php $__currentLoopData = $BusRoutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>    
                    <td><?php echo e($flag+=1); ?></td>
                    <td><a href="/admin/auth/routes/<?php echo e($route->id); ?>"><?php echo e($route->routename); ?></a></td>
                    <td><?php echo e($user = DB::table('admin_users')->where('id', $route->user_id)->first()->name); ?></td>
                    <td><?php echo e($route->created_at); ?></td>
                    <td><a href="/admin/auth/routes/<?php echo e($route->id); ?>/edit" class="btn btn-default">Edit</a>
                        
                        <?php echo Form::open(['action' => ['BusRoutesController@destroy', $route->id], 'method' => 'POST', 'class' => 'pull','style'=>'display:inline' ]); ?>

                            <?php echo e(Form::hidden('_method','DELETE')); ?>

                            <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle'=>'confirmation','data-placement'=>'top'])); ?>

                        <?php echo Form::close(); ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
            <?php echo e($BusRoutes->links()); ?>    
        <?php else: ?>
            <p>No notices found</p>
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