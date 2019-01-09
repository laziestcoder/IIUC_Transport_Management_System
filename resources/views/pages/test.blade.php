<?php
$data = array();

for ($i = 0; $i <= 10; $i++) {
    for ($j = 10; $j <= 50; $j += 10)
        if (isset($data[$j])) {
            $data[$j] += 1;
        } else {
            $data[$j] = 1;
        }
}

foreach ($data as $key => $value) {
    echo $key . 'x' . $value . '<br>';
}
?>
{{-- <pre>
@foreach ($data as $item => $value)
    {{$item}} <br>
    {{$value}}
    
@endforeach
</pre> --}}