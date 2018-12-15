<?php $__env->startSection('content'); ?>
    <header id="home" class="masthead">
        <div class="container home-main">
            <div class="intro-text" style="padding-top: 140px; padding-bottom: 200px;">
                <div class="intro-lead-in" style="font-style: initial"><b>LOGIN</b></div>
                <div class="">
                    <!-- It's Nice To Meet You -->
                    <div class="container" style="padding:0px">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">
                                    <!-- <div class="panel-heading">Login</div> -->
                                    <div class="panel-body" style="background:#212529">
                                        <br>
                                        <?php if(session('confirmation-success')): ?>
                                            <div class="alert alert-success">
                                                <?php echo e(session('confirmation-success'), false); ?>

                                            </div>
                                        <?php endif; ?>
                                        <?php if(session('confirmation-danger')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo session('confirmation-danger'); ?>

                                            </div>
                                        <?php endif; ?>
                                        <form id="form" class="form-horizontal" role="form" method="POST"
                                              action="<?php echo e(url('/login'), false); ?>">
                                            <?php echo e(csrf_field(), false); ?>


                                            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : '', false); ?>">
                                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control" name="email"
                                                           value="<?php echo e(old('email'), false); ?>" autofocus>

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
                                                           name="password">

                                                    <?php if($errors->has('password')): ?>
                                                        <span class="help-block">
                                                <strong><?php echo e($errors->first('password'), false); ?></strong>
                                            </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="remember" <?php echo e(old('remember') ? 'checked' : '', false); ?>>
                                                            Remember Me
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <div id="recaptcha" class="g-recaptcha"
                                                         data-sitekey="6LcV-ngUAAAAAJqAknZhDgpgysYKlMJ9YSuKxWyb"></div>
                                                    <?php if($errors->has('recaptcha')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('recaptcha'), false); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-8 col-md-offset-4">
                                                    <button type="submit" class="btn btn-primary"
                                                            style="background-color: #bababa; border-color: #212529;">
                                                        Login
                                                    </button>

                                                    <a class="btn btn-link" href="<?php echo e(url('/password/reset'), false); ?>">
                                                        Forgot Your Password?
                                                    </a>
                                                </div>

                                            </div>

                                        </form>
                                        If you are new click for <a class="link"
                                                                    href="<?php echo e(route('register'), false); ?>">Register</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <!-- <div class="container"style="background:black; padding:50px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <?php if(session('confirmation-success')): ?>
        <div class="alert alert-success">
<?php echo e(session('confirmation-success'), false); ?>

                </div>
<?php endif; ?>
    <?php if(session('confirmation-danger')): ?>
        <div class="alert alert-danger">
<?php echo session('confirmation-danger'); ?>

                </div>
<?php endif; ?>
            <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/login'), false); ?>">
                        <?php echo e(csrf_field(), false); ?>


            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : '', false); ?>">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email'), false); ?>" required autofocus>

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
            <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : '', false); ?>> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="<?php echo e(url('/password/reset'), false); ?>">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
    <?php echo $__env->make('inc.recaptchaSubmitValidate', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>