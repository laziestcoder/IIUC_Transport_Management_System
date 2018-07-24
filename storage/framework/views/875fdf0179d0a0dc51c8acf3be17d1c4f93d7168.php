<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Management</div>

                <div class="panel-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    

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

                               
                            <?php if(count( $BusPoints ) > 0 /* && $BusPoints->routeid == $route->routename */ ): ?>
                            <select name="pointname" required="True">
                                    <option value="" disabled="true" selected="true" required>Select A Point Name</option>
                                <?php $__currentLoopData = $BusPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($point->id); ?>"><?php echo e($point->pointname); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        <?php else: ?>
                        <select name="pointname">
                            <option value="" disabled="true" selected="true">No Point Added</option>
                        </select>
                        <?php endif; ?>    
                        </div>
                    
                    <?php echo e(Form :: submit('Submit',['class' => 'btn btn-primary'])); ?>

                    <?php echo Form::close(); ?>

                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>        
        /* $(document).ready(function () {        
        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.closest('form').submit();
            }
        });   
    }); */
    $("#delete").on("submit", function(){
         return confirm("Do you want to delete this item?");
     });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>