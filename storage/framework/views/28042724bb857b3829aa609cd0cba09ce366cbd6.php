<?php $__env->startSection('content'); ?>
<div >
        <h1><?php echo e($title); ?></h1>
</div>
    <?php if(count($posts) > 0): ?>
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:50%; height: 50%" src="/storage/cover_images/<?php echo e($post->cover_image); ?>" alt="<?php echo e($post->title); ?>">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/<?php echo e($post->id); ?>"><?php echo e($post->title); ?></a></h3>
                        <small>Written on <?php echo e($post->created_at); ?> by <?php echo e($post->user->name); ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($posts->links()); ?>    
    <?php else: ?>
        <p>No posts found</p>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>