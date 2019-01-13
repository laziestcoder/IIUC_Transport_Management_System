<?php $__currentLoopData = $schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<pre>    
Result:  
<br><?php echo e($item, false); ?><br>
            <br><?php echo e($item->id, false); ?><br>
         <?php echo e(" day ", false); ?><?php echo e($item->day, false); ?>

         <?php $__currentLoopData = $item->day; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $routename): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php echo e($routename->id, false); ?> <?php echo e(" ", false); ?><?php echo e($routename->dayname, false); ?> <?php echo e(" ", false); ?>   
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <br>
         <?php echo e(" route ", false); ?><?php echo e($item->route, false); ?>

         <?php $__currentLoopData = $item->route; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $routename): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php echo e($routename->id, false); ?> <?php echo e(" ", false); ?><?php echo e($routename->routename, false); ?> <?php echo e(" ", false); ?>   
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <br>
         <?php echo e(" to iiuc ", false); ?><?php echo e($item->toiiuc, false); ?>

         <?php echo e(" from iiuc ", false); ?><?php echo e($item->fromiiuc, false); ?>

         <?php echo e(" male ", false); ?><?php echo e($item->male, false); ?>

         <?php echo e(" female ", false); ?><?php echo e($item->female, false); ?>

         <?php echo e(" time ", false); ?><?php echo e($item->time, false); ?>

         <?php echo e(" bususer ", false); ?><?php echo e($item->bususer, false); ?>

         
         <br><br>
</pre>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>