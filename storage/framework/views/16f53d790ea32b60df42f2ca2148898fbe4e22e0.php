<?php
                    $user_id = auth()->user();
                    if ($user_id) {
                        $user = App\User::find($user_id->id);
                        $url = "http://upanel.iiuc.ac.bd:81/Picture/" . $user->varsity_id . ".jpg";
                        echo "<img style='max-width:32;max-height:32px' class='img img-thumbnail' src='".$url."' alt='" . $user->name . "'/>"."<br>";
                        $ch = curl_init();
                        $timeout = 5;
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                        $lines_string = curl_exec($ch);
                        echo $lines_string." =>  LS<br>";
                        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        echo $retcode." => RT<br>";
                        curl_close($ch);
                        $file2 = $lines_string;
                        $file = $retcode;
                        $verified = false;
                        if ($file != 200 && $file2[0] != '<') {
                            $verified = true;
                            $image = "<img style='max-width:32;max-height:32px' class='img img-thumbnail' src='http://upanel.iiuc.ac.bd:81/Picture/" . $user->varsity_id . ".jpg' alt='" . $user->name . "'/>";
                        } else {
                            $verified = false;
                            $image = "<img style='max-width:32px;max-height:32px' class='img img-thumbnail' src='/storage/image/user/" . $user->image . "' alt='" . $user->name . "'/>";
                        }
                    } else {
                        $image = '';
                    }

                    $image2 = $image;
                    echo $image2." <br> " . $file . "<br>" . $file2[0];
                    ?>