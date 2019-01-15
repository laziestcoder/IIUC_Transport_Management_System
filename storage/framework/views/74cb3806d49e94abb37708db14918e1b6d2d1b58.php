<?php $__env->startSection('content'); ?>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <header id="home" class="masthead">
        <div class="container home-main">
            <div class="intro-text" style="padding-top: 140px; padding-bottom: 200px;">
                <div class="intro-lead-in" style="font-style: initial"><b>REGISTRATION</b></div>
                <!-- <div class="intro-heading text-uppercase">It's Nice To Meet You</div> -->
                <div class="container" style="padding:0px 0px 0px 0px;">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel panel-default">
                                <!-- <div class="panel-heading">Register</div> -->
                                <div class="panel-body" style="padding-top: 50px; background:#212529">
                                    <?php if(session('confirmation-success')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session('confirmation-success'), false); ?>

                                        </div>
                                    <?php else: ?>
                                        <form class="form-horizontal" role="form" method="POST"
                                              action="<?php echo e(url('/register'), false); ?>">
                                            <?php echo e(csrf_field(), false); ?>


                                            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : '', false); ?>">
                                                <label for="name" class="col-md-4 control-label">Name</label>

                                                <div class="col-md-6">
                                                    <input id="name" type="text" class="form-control" name="name"
                                                           placeholder=" Enter Your Full Name "
                                                           value="<?php echo e(old('name'), false); ?>" required autofocus>

                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block">
                                                            <strong><?php echo e($errors->first('name'), false); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="form-group<?php echo e($errors->has('varsity_id') ? ' has-error' : '', false); ?>">
                                                <label for="varsity_id" class="col-md-4 control-label">ID</label>

                                                <div class="col-md-6">
                                                    <input id="varsity_id" type="text" class="form-control" name="varsity_id"
                                                           placeholder=" Enter Your Varsity ID "
                                                           value="<?php echo e(old('varsity_id'), false); ?>" required>

                                                    <?php if($errors->has('varsity_id')): ?>
                                                        <span class="help-block">

                                                            <strong><?php echo e($errors->first('varsity_id'), false); ?></strong>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : '', false); ?>">
                                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control" name="email"
                                                           placeholder=" Enter Your Valid Email ID "
                                                           value="<?php echo e(old('email'), false); ?>" required>

                                                    <?php if($errors->has('email')): ?>
                                                        <span class="help-block">

                                                            <strong><?php echo e($errors->first('email'), false); ?></strong>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : '', false); ?>">
                                                <label for="password" class="col-md-4 control-label">Password</label>

                                                <div class="col-md-6">
                                                    <input id="password" type="password" class="form-control"
                                                           placeholder=" Enter Password Atleast Six Characters "
                                                           name="password" required>

                                                    <?php if($errors->has('password')): ?>
                                                        <span class="help-block">

                                                            <strong><?php echo e($errors->first('password'), false); ?></strong>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="password-confirm" class="col-md-4 control-label">Confirm
                                                    Password</label>

                                                <div class="col-md-6">
                                                    <input id="password-confirm" type="password" class="form-control"
                                                           placeholder=" Confirm Your Password "
                                                           name="password_confirmation" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="user-gender" class="col-md-4 control-label">Gender</label>

                                                <div class="col-md-6">
                                                    <div class="radio-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" value="0"
                                                                   name="gender" required>Male
                                                        </label>
                                                    </div>
                                                    <div class="radio-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" value="1"
                                                                   name="gender" required>Female
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="user-role" class="col-md-4 control-label">
                                                    Register As
                                                </label>
                                                <div class="col-md-6">
                                                    <?php $userroles = DB::table('user_type')->where('active', true)->get();?>
                                                    
                                                    
                                                    <select name="user_type" class="form-control" style="height: 36px"
                                                            required>
                                                        <option disabled selected>Select from the list</option>
                                                        <?php $__currentLoopData = $userroles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo $user_type->id; ?>">
                                                                <?php echo $user_type->name; ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <div id='recaptcha' class="g-recaptcha"
                                                         data-sitekey="6LcV-ngUAAAAAJqAknZhDgpgysYKlMJ9YSuKxWyb"></div>
                                                    <?php if($errors->has('recaptcha')): ?>
                                                        <span class="help-block">

                                                            <strong><?php echo e($errors->first('recaptcha'), false); ?></strong>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <button type="submit" class="btn btn-primary"
                                                            style="background-color: #bababa; border-color: #212529;">
                                                        Register
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- <div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">Register</div>
<div class="panel-body">
<?php if(session('confirmation-success')): ?>
        <div class="alert alert-success">
<?php echo e(session('confirmation-success'), false); ?>

                </div>
<?php else: ?>
        <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/register'), false); ?>">
<?php echo e(csrf_field(), false); ?>


                <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : '', false); ?>">
<label for="name" class="col-md-4 control-label">Name</label>

<div class="col-md-6">
<input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name'), false); ?>" required autofocus>

<?php if($errors->has('name')): ?>
            <span class="help-block">
            <strong><?php echo e($errors->first('name'), false); ?></strong>
</span>
<?php endif; ?>
                </div>
                </div>

                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : '', false); ?>">
<label for="email" class="col-md-4 control-label">E-Mail Address</label>

<div class="col-md-6">
<input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email'), false); ?>" required>

<?php if($errors->has('email')): ?>
            <span class="help-block">
            <strong><?php echo e($errors->first('email'), false); ?></strong>
</span>
<?php endif; ?>
                </div>
                </div>

                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : '', false); ?>">
<label for="password" class="col-md-4 control-label">Password</label>

<div class="col-md-6">
<input id="password" type="password" class="form-control" name="password" required>

<?php if($errors->has('password')): ?>
            <span class="help-block">
            <strong><?php echo e($errors->first('password'), false); ?></strong>
</span>
<?php endif; ?>
                </div>
                </div>

                <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
                </div>
                <div class="form-group">
                <label for="user-gender" class="col-md-4 control-label">Gender</label>

                <div class="col-md-6">
                <div class="radio-inline">
                <label class="form-check-label">
                <input type="radio" class="form-check-input" value="0" name="gender" required>Male
                </label>
                </div>
                <div class="radio-inline">
                <label class="form-check-label">
                <input type="radio" class="form-check-input" value="1" name="gender" required>Female
                </label>
                </div>
                </div>
                </div>
                <div class="form-group">
                <label for="user-gender" class="col-md-4 control-label">Register As</label>

                <div class="col-md-6">
                <div class="radio-inline">
                <label class="form-check-label">
                <input type="radio" class="form-check-input" value="1" name="user_type" required>Student
                </label>
                </div>
                <div class="radio-inline">
                <label class="form-check-label">
                <input type="radio" class="form-check-input" value="2" name="user_type" required>Faculty
                </label>
                </div>
                <div class="radio-inline">
                <label class="form-check-label">
                <input type="radio" class="form-check-input" value="3" name="user_type" required>Officer/Staff
                </label>
                </div>
                </div>
                </div>

                <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                Register
                </button>
                </div>
                </div>
                </form>
<?php endif; ?>
            </div>
            </div>
            </div>
            </div>
            </div> -->
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>