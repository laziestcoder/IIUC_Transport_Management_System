<?php $__env->startSection('content'); ?>
    
    

    <section class="content-header">
        <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h1>
            <?php echo e($title); ?>

            
            <small><?php echo e('Here you will get available route information. You can also add, remove and edit Bus Routes.'); ?></small>
        </h1>
        <br><br>
        <?php echo Form :: open(['action' => 'BusPointsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]); ?>

        <div class="form-group">
            <?php echo e(Form :: label('title','Bus Route Name')); ?>

            
            <?php if(count( $BusRoutes ) > 0 ): ?>
                <select name="routename" required="True">
                    <option value="" disabled="true" selected="true" required>Select A Route Name</option>
                    <?php $__currentLoopData = $BusRoutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($route->id); ?>"><?php echo e($route->routename); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            <?php else: ?>
                <select name="routename">
                    <option value="" disabled="true" selected="true">No Route Added</option>
                </select>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <?php echo e(Form :: label('title','Bus Stop Point')); ?>

            <?php echo e(Form :: text('pointname' , '',  [ 'class' => 'form-control', 'placeholder' => 'Type Stop Point Name', 'required'=>'True'])); ?>

        </div>
        
        <?php echo e(Form :: submit('Submit',['class' => 'btn btn-primary'])); ?>

        <?php echo Form::close(); ?>


    </section>
    <br><br>
    <section class="content">

        

        <h1><?php echo e($titleinfo); ?></h1>
        <?php if(count($BusPoints) > 0): ?>
            <table class="table table-hover">
                <thead class="table">
                <tr>
                    <th>ID</th>
                    <th>Point Name</th>
                    <th>Route Name</th>
                    <th>Added By</th>
                    <th>Added On</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="table">
                <?php $flag = 0;
                ?>
                <?php $__currentLoopData = $BusPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>    <?php $routename = DB::table('routes')->where('id', $point->routeid)->first(); ?>
                        <td><?php echo e($flag+=1); ?></td>
                        <td><?php echo e($point->pointname); ?></td>
                        <td><a href="/admin/auth/routes/<?php echo e($point->routeid); ?>"><?php echo e($routename->routename); ?></a></td>
                        <td><?php echo e(DB::table('admin_users')->where('id', $point->user_id)->first()->name); ?></td>
                        <td><?php echo e($point->created_at); ?></td>
                        <td><a href="/admin/auth/points/<?php echo e($point->id); ?>/edit" class="btn btn-default">Edit</a>
                            <?php echo Form::open(['action' => ['BusPointsController@destroy', $point->id], 'method' => 'POST', 'class' => 'pull','style'=>'display:inline' ]); ?>

                            <?php echo e(Form::hidden('_method','DELETE')); ?>

                            <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle'=>'confirmation','data-placement'=>'top'])); ?>

                            <?php echo Form::close(); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($BusPoints->links()); ?>

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