<?php
$data = array();
for ($i = 0; i <= 9; $i++) {
    $data[$i] = $i * 2;
}

foreach ($data as $key => $value) {
    echo $key . 'x' $value; 
}


?>