@foreach ($schedule as $item)
<pre>    
Result:  
<br>{{$item}}<br>
            <br>{{$item->id}}<br>
         {{" day "}}{{$item->day}}
         @foreach ($item->day as $routename)
         {{$routename->id}} {{" "}}{{$routename->dayname}} {{" "}}   
         @endforeach
         <br>
         {{" route "}}{{$item->route}}
         @foreach ($item->route as $routename)
         {{$routename->id}} {{" "}}{{$routename->routename}} {{" "}}   
         @endforeach
         <br>
         {{" to iiuc "}}{{$item->toiiuc}}
         {{" from iiuc "}}{{$item->fromiiuc}}
         {{" male "}}{{$item->male}}
         {{" female "}}{{$item->female}}
         {{" time "}}{{$item->time}}
         {{" bususer "}}{{$item->bususer}}
         
         <br><br>
</pre>
@endforeach