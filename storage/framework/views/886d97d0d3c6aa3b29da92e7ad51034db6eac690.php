<?php $__env->startSection('content'); ?>
    <header id="home" class="masthead">
        <div class="container">
            <div class="intro-text" style="padding-top: 140px; padding-bottom: 200px;">
                <div class="intro-lead-in" style="font-style: initial"><b>Reset Password</b></div>
                <div class="">
                    <div class="container" style="padding:0px">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">


                                    <div class="panel-body" style="background:#212529">
                                        <?php if (session('status')): ?>
                                            <div class="alert alert-success">
                                                <?php echo e(session('status'), false); ?>

                                            </div>
                                        <?php endif; ?>

                                        <form class="form-horizontal" method="POST"
                                              action="<?php echo e(route('password.email'), false); ?>">
                                            <?php echo e(csrf_field(), false); ?>


                                            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : '', false); ?>">
                                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control" name="email"
                                                           value="<?php echo e(old('email'), false); ?>" required>

                                                    <?php if ($errors->has('email')): ?>
                                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('email'), false); ?></strong>
                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        Send Password Reset Link
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>