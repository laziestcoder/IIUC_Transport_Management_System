<?php $__env->startSection('content'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>

    <section class="content-header">
        <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h1>
            <?php echo e($title, false); ?>

            <small><?php echo e('Here you will get available route information. You can also add, remove and edit Bus Routes.', false); ?></small>
        </h1>
        <br><br>
        <?php echo Form:: open(['action' => 'BusRoutesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']); ?>

        <div class="form-group">
            <?php echo e(Form:: label('title', 'Bus Route Name'), false); ?>

            <?php echo e(Form:: text('routename', '', ['class' => 'form-control', 'placeholder' => 'Type Route Name',]), false); ?>

        </div>


        <?php echo e(Form:: submit('Submit', ['class' => 'btn btn-primary']), false); ?>

        <?php echo Form::close(); ?>


    </section>
    <br><br>
    <section class="content">
        <h1><?php echo e($titleinfo, false); ?></h1>
        <?php if (count($BusRoutes) > 0): ?>
            <table class="table table-hover">
                <thead class="table">
                <tr>
                    <th>No.</th>
                    <th>Route Name</th>
                    <th>Route ID</th>
                    <th>Added By</th>
                    <th>Added On</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="table">
                <?php $flag = 0; ?>
                <?php $__currentLoopData = $BusRoutes;
                $__env->addLoop($__currentLoopData);
                foreach ($__currentLoopData as $route): $__env->incrementLoopIndices();
                    $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($flag += 1, false); ?></td>
                        <td>
                            <a href="/admin/auth/routes/<?php echo e($route->id, false); ?>"><?php echo e($route->routename, false); ?></a>
                        </td>
                        <td><?php echo e(DB::table('admin_users')->where('id', $route->user_id)->first()->name, false); ?></td>
                        <td><?php echo e($route->id, false); ?></td>
                        <td><?php echo e($route->created_at, false); ?></td>
                        <td><a href="/admin/auth/routes/<?php echo e($route->id, false); ?>/edit"
                               class="btn btn-default">Edit</a>
                            <?php echo Form::open(['action' => ['BusRoutesController@destroy', $route->id], 'method' => 'POST', 'class' => 'pull', 'id' => 'delete', 'style' => 'display:inline'  /* ,'onclick' => 'function deleteMe()' */]); ?>
                            <?php echo e(Form::hidden('_method', 'DELETE'), false); ?>

                            <?php echo e(csrf_field(), false); ?>

                            <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle' => 'confirmation', 'data-placement' => 'top']), false); ?>

                            <?php echo Form::close(); ?>

                        </td>
                    </tr>
                <?php endforeach;
                $__env->popLoop();
                $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($BusRoutes->links(), false); ?>

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
    <script>
        /*  $("#delete").on("submit", function(){
             return confirm("Do you want to delete this item?");
         }); */

        /*
         function deleteMe() {

             //var path = $(this).data('path');

             swal({
                     title: "Are you sure to delete this item ?",
                     type: "warning",
                     showCancelButton: true,
                     confirmButtonColor: "#DD6B55",
                     confirmButtonText: "Confirm",
                     closeOnConfirm: false,
                     cancelButtonText: "Cancel"
                 }, */
        /*  function()
         {
             $.ajax
             ({
                 method: 'delete',
                 url: 'http://itms.project/admin/media/delete',
                 data: {
                 'files[]': [path],
                 _token: LA.token,
                 },
                 success: function(data) {
                 $.pjax.reload('#pjax-container');

                 if (typeof data === 'object') {
                     if (data.status) {
                     swal(data.message, '', 'success');
                     } else {
                     swal(data.message, '', 'error');
                     }
                 }
                 }
             });
          } */
        /*  );
     }); */

    </script>


<?php echo $__env->make('admin::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>