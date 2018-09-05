@extends('layouts.app')
@section('content')
    <div class="content">
        <?php
        $url = "http://upanel.iiuc.ac.bd:81/Picture/";

        $dir_path = $url;
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
        //        $url_to_image
        //            = 'http://upanel.iiuc.ac.bd:81/Picture/';
        //
        //        $ch = curl_init($url_to_image);
        //
        //        $my_save_dir = '/storage/images/user/';
        //        $filename = basename($url_to_image);
        //        $complete_save_loc = $my_save_dir . $filename;
        //
        //        $fp = fopen($complete_save_loc, 'wb');
        //
        //        curl_setopt($ch, CURLOPT_FILE, $fp);
        //        curl_setopt($ch, CURLOPT_HEADER, 0);
        //        curl_exec($ch);
        //        curl_close($ch);
        //        fclose($fp);
        ?>
    </div>
@endsection