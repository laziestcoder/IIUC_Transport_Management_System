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
                            Name: <?php echo e($user->name, false); ?>

                        </td>

                    </tr>
                    <tr>
                        <td>
                            ID: <?php echo e($user->jobid, false); ?>

                        </td>

                    </tr>
                    <tr>
                        <td>
                            Gender: <?php echo e($user->gender == 0 ? 'Male' : 'Female', false); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Registered
                            As: <?php echo e($user->userrole == 1 ? 'Student' : ( $user->userrole == 2 ? 'Faculty Member' :($user->userrole == 3 ? 'Officer/Staff' : 'undefined')), false); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email: <?php echo e($user->email, false); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Contact: <?php echo e($user->contact ? $user->contact : 'none', false); ?>

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
                <?php echo Form :: open(['action' => 'ManagementController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]); ?>

                <?php echo e(csrf_field(), false); ?>

                <table class="table table-hover table-bordered">
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
                    <tbody class="">
                    <?php if( count($days) > 0 ): ?>
                        <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($day->id < 8): ?>
                                <tr>
                                    <td>
                                        <?php echo $day->dayname; ?>

                                    </td>
                                    <td>
                                        <div class="userRouteForm">
                                            <?php if(count( $BusPoints ) > 0  ): ?>
                                                <select name="pickpoint<?php echo e($day->id, false); ?>" required="True">
                                                    <option value="" disabled="true" selected="true">Select A Point
                                                        Name
                                                    </option>
                                                    <option value="0" required>No Need</option>

                                                    <?php
                                                    $place = App\StudentSchedule::where('user_id', $user->id)
                                                        ->where('day', $day->id)->first();
                                                    if ($place) {
                                                        $place = App\BusPoint::where('id', ($place->pickpoint))->first();
                                                        if ($place) {
                                                            $flag = $place->id;
                                                        } else {
                                                            $flag = 0;
                                                        }
                                                    } else {
                                                        $flag = 0;
                                                    }
                                                    ?>
                                                    <?php $__currentLoopData = $BusPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($flag == $point->id): ?>
                                                            <option selected="true"
                                                                    value="<?php echo e($point->id, false); ?>"><?php echo e($point->pointname, false); ?></option>
                                                        <?php else: ?>
                                                            <option value="<?php echo e($point->id, false); ?>"><?php echo e($point->pointname, false); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            <?php else: ?>
                                                <select name="pickpoint<?php echo e($day->id, false); ?>">
                                                    <option value="" disabled="true" selected="true">No Point
                                                        Available
                                                    </option>
                                                </select>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userRouteForm">
                                            <?php if(count( $picktimes ) > 0  ): ?>
                                                <select name="picktime<?php echo e($day->id, false); ?>" required="True">
                                                    <option value="" disabled="true" selected="true" required>Select A
                                                        Time
                                                    </option>
                                                    <option value="0" required>No Need</option>

                                                    <?php
                                                    $time = App\StudentSchedule::where('user_id', $user->id)
                                                        ->where('day', $day->id)->first();
                                                    if ($time) {
                                                        $time = App\Time::where('id', ($time->picktime))->first();
                                                        if ($time) {
                                                            $flag = $time->id;
                                                        } else {
                                                            $flag = 0;
                                                        }
                                                    } else {
                                                        $flag = 0;
                                                    }
                                                    ?>
                                                    <?php $__currentLoopData = $picktimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $picktime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($flag == $picktime->id): ?>
                                                            <option selected="true"
                                                                    value="<?php echo e($picktime->id, false); ?>"><?php echo e(Carbon\Carbon::parse($picktime->time)->format('g:i A'), false); ?></option>
                                                        <?php else: ?>
                                                            <option value="<?php echo e($picktime->id, false); ?>"><?php echo e(Carbon\Carbon::parse($picktime->time)->format('g:i A'), false); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            <?php else: ?>
                                                <select name="picktime<?php echo e($day->id, false); ?>">
                                                    <option value="" disabled="true" selected="true">No Time Available
                                                    </option>
                                                </select>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userRouteForm">
                                            <?php if(count( $BusPoints ) > 0  ): ?>
                                                <select name="droppoint<?php echo e($day->id, false); ?>" required="True">
                                                    <option value="" disabled="true" selected="true" required>Select A
                                                        Point Name
                                                    </option>
                                                    <option value="0" required>No Need</option>
                                                    <?php
                                                    $place = App\StudentSchedule::where('user_id', $user->id)
                                                        ->where('day', $day->id)->first();
                                                    if ($place) {
                                                        $place = App\BusPoint::where('id', ($place->droppoint))->first();
                                                        if ($place) {
                                                            $flag = $place->id;
                                                        } else {
                                                            $flag = 0;
                                                        }
                                                    } else {
                                                        $flag = 0;
                                                    }
                                                    ?>
                                                    <?php $__currentLoopData = $BusPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($flag == $point->id): ?>
                                                            <option selected="true"
                                                                    value="<?php echo e($point->id, false); ?>"><?php echo e($point->pointname, false); ?></option>
                                                        <?php else: ?>
                                                            <option value="<?php echo e($point->id, false); ?>"><?php echo e($point->pointname, false); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            <?php else: ?>
                                                <select name="droppoint<?php echo e($day->id, false); ?>">
                                                    <option value="" disabled="true" selected="true">No Point
                                                        Available
                                                    </option>
                                                </select>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userRouteForm">
                                            <?php if(count( $droptimes ) > 0  ): ?>
                                                <select name="droptime<?php echo e($day->id, false); ?>" required="True">
                                                    <option value="" disabled="true" selected="true" required>Select A
                                                        Time
                                                    </option>
                                                    <option value="0" required>No Need</option>
                                                    <?php
                                                    $time = App\StudentSchedule::where('user_id', $user->id)
                                                        ->where('day', $day->id)->first();
                                                    if ($time) {
                                                        $time = App\Time::where('id', ($time->droptime))->first();
                                                        if ($time) {
                                                            $flag = $time->id;
                                                        } else {
                                                            $flag = 0;
                                                        }
                                                    } else {
                                                        $flag = 0;
                                                    }

                                                    ?>
                                                    <?php $__currentLoopData = $droptimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $droptime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($flag == $droptime->id): ?>
                                                            <option selected="true"
                                                                    value="<?php echo e($droptime->id, false); ?>"><?php echo e(Carbon\Carbon::parse($droptime->time)->format('g:i A'), false); ?></option>
                                                        <?php else: ?>
                                                            <option value="<?php echo e($droptime->id, false); ?>"><?php echo e(Carbon\Carbon::parse($droptime->time)->format('g:i A'), false); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            <?php else: ?>
                                                <select name="droptime<?php echo e($day->id, false); ?>">
                                                    <option value="" disabled="true" selected="true">No Time Available
                                                    </option>
                                                </select>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
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