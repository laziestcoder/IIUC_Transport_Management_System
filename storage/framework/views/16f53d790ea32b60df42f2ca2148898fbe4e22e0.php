<?php $__env->startSection('content'); ?>
    <div class="content">
    <?php
    $url = "http://upanel.iiuc.ac.bd:81/Picture/";

    $dir_path = $url ;
    $extensions_array = array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'JPEG', 'PNG');

    if (is_dir($dir_path)) {
        $files = scandir($dir_path);

        for ($i = 0; $i < count($files); $i++) {
            if ($files[$i] != '.' && $files[$i] != '..') {
                // get file name
                echo "File Name -> $files[$i]<br>";

                // get file extension
                $file = pathinfo($files[$i]);
                $extension = $file['extension'];
                echo "File Extension-> $extension<br>";

                // check file extension
                if (in_array($extension, $extensions_array)) {
                    // show image
                    echo "<img src='$dir_path$files[$i]' style='width:100px;height:100px;'><br>";
                }
            }
        }
    }
    ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>