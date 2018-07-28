<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <?php if (session('status')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>
                        <a href="/posts/create" class="btn btn-primary">Create Post</a>
                        <h3>Your Blog Posts</h3>
                        <?php if (count($posts) > 0): ?>
                            <table class="table table-striped">
                                <tr>
                                    <th>Title</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <?php $__currentLoopData = $posts;
                                $__env->addLoop($__currentLoopData);
                                foreach ($__currentLoopData as $post): $__env->incrementLoopIndices();
                                    $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <a href="/posts/<?php echo e($post->id); ?>"><?php echo e($post->title); ?></a>
                                        </td>
                                        <td><a href="/posts/<?php echo e($post->id); ?>/edit" class="btn btn-default">Edit</a>
                                        </td>
                                        <td>
                                            <?php echo Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']); ?>

                                            <?php echo e(Form::hidden('_method', 'DELETE')); ?>

                                            <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger'])); ?>

                                            <?php echo Form::close(); ?>

                                        </td>
                                    </tr>

                                <?php endforeach;
                                $__env->popLoop();
                                $loop = $__env->getLastLoop(); ?>
                            </table>
                        <?php else: ?>
                            <p> You have no post </p>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>