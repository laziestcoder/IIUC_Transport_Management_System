<?php $__env->startSection('usercontent'); ?>
    <div class="panel-body backGround" >
        <h1>Profile</h1>
    </div>
    <hr>
    <div class="panel-body" >
        <div class="container">
            <div class="userinfo">
                <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <b><h3>Basic Info:</h3></b>
                <hr>
                <table class="table-active table-responsive-lg">
                    <thead class="">
                    <tr>
                        <td>
                        <?php if("http://upanel.iiuc.ac.bd:81/Picture/<?php echo $user->jobid; ?>"==True): ?>
                            <img src="http://upanel.iiuc.ac.bd:81/Picture/<?php echo e($user->jobid, false); ?>"/>
                        <?php else: ?>
                            <img src="storage/image/user/<?php echo e($user->image, false); ?>"/>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Name: <?php echo $user->name; ?>

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
        <div id='transport' class="container">
            <div class="userrouteinfo">
                <b><h3>Transport Schedule:</h3></b>
                <hr>

                <?php if(Session::has('transport_message')): ?>
                    <div id="success">
                        <div class="alert alert-success">
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <strong>
                                <?php echo e(session::get('transport_message'), false); ?>

                            </strong>
                        </div>
                    </div>
                <?php endif; ?>

                <table class="table table-bordered table-responsive-lg">
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
                    <?php if(count($days) > 0 ): ?>
                        <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if( $day->id < 8): ?>
                                <tr>
                                    <td>
                                        <?php echo $day->dayname; ?>

                                    </td>
                                    <td>
                                        <?php
                                        $place = App\StudentSchedule::where('user_id', $user->id)
                                            ->where('day', $day->id)->first();
                                        if ($place) {
                                            $place = App\BusPoint::where('id', $place->pickpoint)->first();
                                            if ($place) {
                                                echo $place->pointname;
                                            } else {
                                                echo "Not Selected";
                                            }
                                        } else {
                                            echo "Not Selected";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $time = App\StudentSchedule::where('user_id', $user->id)
                                            ->where('day', $day->id)->first();
                                        if ($time) {
                                            $time = App\Time::where('id', ($time->picktime))->first();
                                            if ($time) {
                                                echo Carbon\Carbon::parse($time->time)->format('g:i A');
                                            } else {
                                                echo "Not Selected";
                                            }
                                        } else {
                                            echo "Not Selected";
                                        }

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $place = App\StudentSchedule::where('user_id', $user->id)
                                            ->where('day', $day->id)->first();
                                        if ($place) {
                                            $place = App\BusPoint::where('id', ($place->droppoint))->first();
                                            if ($place) {
                                                echo $place->pointname;
                                            } else {
                                                echo "Not Selected";
                                            }
                                        } else {
                                            echo "Not Selected";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $time = App\StudentSchedule::where('user_id', $user->id)
                                            ->where('day', $day->id)->first();
                                        if ($time) {
                                            $time = App\Time::where('id', ($time->droptime))->first();
                                            if ($time) {
                                                echo Carbon\Carbon::parse($time->time)->format('g:i A');
                                            } else {
                                                echo "Not Selected";
                                            }
                                        } else {
                                            echo "Not Selected";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.userlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>