<li class="dropdown messages-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-envelope-o"></i>
        <?php if($messages->count() > 0): ?>
        <span class="label label-success"><?php echo e($messages->count()); ?></span>
        <?php endif; ?>
    </a>
    <ul class="dropdown-menu">
        <li class="header">You have <?php echo e($messages->count()); ?> messages</li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">

                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><!-- start message -->
                    <a href="#">
                        <div class="pull-left">
                            <img src="<?php echo e($message->sender->avatar); ?>" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                            <?php echo e($message->title); ?>

                            <small><i class="fa fa-clock-o"></i> <?php echo e($message->created_at->diffForHumans()); ?></small>
                        </h4>
                        <p><?php echo e(str_limit($message->message, 30)); ?></p>
                    </a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </li>
        <li class="footer"><a href="#">See All Messages</a></li>
    </ul>
</li>