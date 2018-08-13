<?php $__env->startSection('usercontent'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>

    <div class="panel-body" style="background:#212529">
        <h1>Edit Schedule</h1>
    </div>
    <hr>
    <div class="panel-body" style="background:#212529">
        <?php if(session('status')): ?>
            <div class="alert alert-success">
                <?php echo e(session('status'), false); ?>

            </div>
        <?php endif; ?>
        <div class="container">
            <div class="userinfo">
                <b><h3>Basic Info:</h3></b>
                <hr>

                <table class="table-active">
                    <thead class="tableSpace">
                    <tr>
                        <td>
                            <img src="storage/image/user/<?php echo e(Auth::user()->image, false); ?>">
                        <td>
                    </tr>
                    <tr>
                        <td>
                            Name: <?php echo e(Auth::user()->name, false); ?>

                        </td>

                    </tr>
                    <tr>
                        <td>
                            ID: <?php echo e(Auth::user()->jobid, false); ?>

                        </td>

                    </tr>
                    <tr>
                        <td>
                            Gender: <?php echo e(Auth::user()->gender == 0 ? 'Male' : 'Female', false); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Registered
                            As: <?php echo e(Auth::user()->userrole == 1 ? 'Student' : ( Auth::user()->userrole == 2 ? 'Faculty Member' :(Auth::user()->userrole == 3 ? 'Officer/Staff' : 'undefined')), false); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email: <?php echo e(Auth::user()->email, false); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Contact: <?php echo e(Auth::user()->contact ? Auth::user()->contact : 'none', false); ?>

                        </td>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <br><br>
        <div class="container">
            <div class="userrouteinfo">
                <b><h3>Transport Schedule</h3></b>
                <hr>
                <?php echo Form :: open(['action' => 'BusPointsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]); ?>

                <table class="table table-bordered">
                    <thead class="">
                    <tr>
                        <td>
                            Day
                        </td>
                        <td>
                            Pick Up Point
                        </td>
                        <td>
                            Pick Up Time
                        </td>
                        <td>
                            Drop Point
                        </td>
                        <td>
                            Leaving Time
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            Saturday
                        </td>
                        <td>
                            <div class="userRouteForm">
                                <?php if(count( $BusPoints ) > 0  ): ?>
                                    <select name="pointnamesatp" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        <?php $__currentLoopData = $BusPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($point->id, false); ?>"><?php echo e($point->pointname, false); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php else: ?>
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            Pick Up Time
                        </td>
                        <td>
                            <div class="userRouteForm">
                                <?php if(count( $BusPoints ) > 0  ): ?>
                                    <select name="pointnamesatd" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        <?php $__currentLoopData = $BusPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($point->id, false); ?>"><?php echo e($point->pointname, false); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php else: ?>
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            Leaving Time
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Sunday
                        </td>
                        <td>
                            <div class="userRouteForm">
                                <?php if(count( $BusPoints ) > 0  ): ?>
                                    <select name="pointnamesunp" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        <?php $__currentLoopData = $BusPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($point->id, false); ?>"><?php echo e($point->pointname, false); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php else: ?>
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            Pick Up Time
                        </td>
                        <td>
                            <div class="userRouteForm">
                                <?php if(count( $BusPoints ) > 0  ): ?>
                                    <select name="pointnamesund" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        <?php $__currentLoopData = $BusPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($point->id, false); ?>"><?php echo e($point->pointname, false); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php else: ?>
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            Leaving Time
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Monday
                        </td>
                        <td>
                            <div class="userRouteForm">
                                <?php if(count( $BusPoints ) > 0  ): ?>
                                    <select name="pointnamemonp" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        <?php $__currentLoopData = $BusPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($point->id, false); ?>"><?php echo e($point->pointname, false); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php else: ?>
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            Pick Up Time
                        </td>
                        <td>
                            <div class="userRouteForm">
                                <?php if(count( $BusPoints ) > 0  ): ?>
                                    <select name="pointnamemond" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        <?php $__currentLoopData = $BusPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($point->id, false); ?>"><?php echo e($point->pointname, false); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php else: ?>
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            Leaving Time
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Tuesday
                        </td>
                        <td>
                            <div class="userRouteForm">
                                <?php if(count( $BusPoints ) > 0  ): ?>
                                    <select name="pointnametuep" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        <?php $__currentLoopData = $BusPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($point->id, false); ?>"><?php echo e($point->pointname, false); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php else: ?>
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            Pick Up Time
                        </td>
                        <td>
                            <div class="userRouteForm">
                                <?php if(count( $BusPoints ) > 0  ): ?>
                                    <select name="pointnametued" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        <?php $__currentLoopData = $BusPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($point->id, false); ?>"><?php echo e($point->pointname, false); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php else: ?>
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            Leaving Time
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Wednesday
                        </td>
                        <td>
                            <div class="userRouteForm">
                                <?php if(count( $BusPoints ) > 0  ): ?>
                                    <select name="pointnamewedp" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        <?php $__currentLoopData = $BusPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($point->id, false); ?>"><?php echo e($point->pointname, false); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php else: ?>
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            Pick Up Time
                        </td>
                        <td>
                            <div class="userRouteForm">
                                <?php if(count( $BusPoints ) > 0  ): ?>
                                    <select name="pointnamewedd" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        <?php $__currentLoopData = $BusPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($point->id, false); ?>"><?php echo e($point->pointname, false); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php else: ?>
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            Leaving Time
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Thursday
                        </td>
                        <td>
                            <div class="userRouteForm">
                                <?php if(count( $BusPoints ) > 0  ): ?>
                                    <select name="pointnamethup" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        <?php $__currentLoopData = $BusPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($point->id, false); ?>"><?php echo e($point->pointname, false); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php else: ?>
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            Pick Up Time
                        </td>
                        <td>
                            <div class="userRouteForm">
                                <?php if(count( $BusPoints ) > 0  ): ?>
                                    <select name="pointnamethud" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        <?php $__currentLoopData = $BusPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($point->id, false); ?>"><?php echo e($point->pointname, false); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php else: ?>
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            Leaving Time
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Friday
                        </td>
                        <td>
                            <div class="userRouteForm">
                                <?php if(count( $BusPoints ) > 0  ): ?>
                                    <select name="pointnamefrip" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        <?php $__currentLoopData = $BusPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($point->id, false); ?>"><?php echo e($point->pointname, false); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php else: ?>
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            Pick Up Time
                        </td>
                        <td>
                            <div class="userRouteForm">
                                <?php if(count( $BusPoints ) > 0  ): ?>
                                    <select name="pointnamefrid" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        <?php $__currentLoopData = $BusPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($point->id, false); ?>"><?php echo e($point->pointname, false); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php else: ?>
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            Leaving Time
                        </td>
                    </tr>

                    </tbody>
                </table>
                <?php echo e(Form :: submit('Submit',['class' => 'btn btn-primary']), false); ?>

                <?php echo Form::close(); ?>

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
    });
        $("#delete").on("submit", function () {
            return confirm("Do you want to delete this item?");
        });
        */

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.userlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>