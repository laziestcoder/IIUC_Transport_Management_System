<!DOCTYPE html>
<html>
<head>
    <title>Test-PDF</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <a href="<?php echo e(route('htmltopdfview',['download'=>'pdf',]), false); ?>">Download PDF</a>
    <table class="table table-striped">
        <thead>
            <th>ID</th>
            <th>Name</th>
        </thead>
        <?php if(count($products)>0): ?>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($product->id, false); ?></td>
                <td><?php echo e($product->routename, false); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <td>No Data</td>
            <td>No Data</td>
        <?php endif; ?>
    </table>
</div>
</body>
</html>