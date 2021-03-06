@extends('printPDF.layout')
@section('headline')
    <h3> Bus Schedule for <b>Students</b></h3>
@endsection
@section('content')
    {{--<div id="print-it">--}}
    @if( count($schedules) > 0 )
        {{-- @foreach($days as $day)--}}
        {{-- <b>{{$day->dayname}}</b><br><br> --}}
        <a target="_blank" class="btn btn-default"
           href="{{ route('bus-schedule-pdf',['download' => 'pdf', 'dayid' => $day->id],['title' => 'Print Bus Schedule']) }}">
            <i class="fa fa-print"></i> PDF/Print </a>
        {{--<a class="btn btn-default" href="#" onclick="window.print()"><i class="fa fa-print"></i>  Print</a>--}}
        <h4><b>Towards IIUC</b></h4>
        <table class="table table-condensed table-responsive table-bordered"
               style="text-align:center; margin: auto; font-size: 11px;">
            <thead class="">
            <tr>
                <th>{{"No."}}</th>
                <th>{{"Starting Time"}}</th>
                <th>{{"Route"}}</th>
                <th>{{"Bus Stop Point"}}</th>
            </tr>
            </thead>
            <tbody>
            <?php $sl = 0; ?>
            @foreach($times as $time)
                <?php $filter = $day->id; 
                $schedules = App\Schedule::whereHas('day', function($q) use ($filter) {
                  $q->where('id', $filter);})
                    ->where('time', $time->id)
                    ->where('toiiuc', 1)
                    ->get();?>
                @if(count($schedules) > 0)
                    <tr>
                        <td>{{$sl +=1}}</td>
                        <td>
                            {{\Carbon\Carbon::parse(App\Time::where('id',$time->id)->first()->time)->format('g:i A')}}
                            {{--</td>--}}

                            <?php $male = App\Schedule:://where('day', $day->id)->
                            where('time', $time->id)
                                ->where('male', '1')
                                ->get();
                            $female = App\Schedule:://where('day', $day->id)->
                            where('time', $time->id)
                                ->where('female', '1')
                                ->get();?>

                            {{--<td>--}}
                            <br>
                            {{count($male)? 'Male':''}}
                            @if(count($male) && count($female))
                                <br>
                            @endif
                            {{count($female)? 'Female':''}}
                        </td>

                        <?php $filter = $day->id; 
                        $routes = App\Schedule::whereHas('day', function($q) use ($filter) {
                          $q->where('id', $filter);})
                        ->where('time', $time->id)
                            ->first();
                            $routes = $routes->route;
                        if (count($routes) > 1) {
                            $routeFlag = count($routes) - 1;
                        } else {
                            $routeFlag = 0;
                        }?>

                        <td>
                            @if(count($routes)>0)
                                <table class="table table-bordered">
                                    @foreach($routes as $route)
                                        <tr>
                                            <td>  {{$route->routename}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                        </td>
                        <td>
                            <table class="table table-bordered">
                                @foreach($routes as $route)
                                    <?php  $stopPoints = \App\BusPoint::where('routeid', $route->id)->orderBy('weight', 'asc')->get();
                                    if (count($stopPoints) > 1) {
                                        $pointFlag = count($stopPoints) - 1;
                                    } else {
                                        $pointFlag = 0;
                                    };
                                    ?>
                                    <tr>
                                        <td>
                                            @if(count($stopPoints)>0)
                                                @foreach($stopPoints as $stopPoint )
                                                    {!! $stopPoint->pointname !!}
                                                    @if($pointFlag)
                                                        {!! " => " !!}
                                                    @endif
                                                    <?php $pointFlag = $pointFlag - 1; ?>
                                                @endforeach
                                            @else
                                                {!! "All Stop Point" !!}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        <h4><b>From IIUC</b></h4>
        <table class="table table-condensed table-responsive table-bordered" style="font-size: 11px;">
            <thead>
            <tr>
                <th>{{"No."}}</th>
                <th>{{"Starting Time"}}</th>
                <th>{{"Route"}}</th>
                <th>{{"Bus Stop Point"}}</th>
            </tr>
            </thead>
            <tbody>
            <?php $sl = 0; ?>
            @foreach($times as $time)
                <?php $filter = $day->id; 
                $schedules = App\Schedule::whereHas('day', function($q) use ($filter) {
                  $q->where('id', $filter);})
                    ->where('time', $time->id)
                    ->where('fromiiuc', 1)
                    ->get();?>
                @if(count($schedules) > 0)
                    <tr>
                        <td>{{$sl +=1}}</td>
                        <td>
                            {{\Carbon\Carbon::parse(App\Time::where('id',$time->id)->first()->time)->format('g:i A')}}
                            {{--</td>--}}

                            <?php $filter = $day->id; 
                            $male = App\Schedule::whereHas('day', function($q) use ($filter) {
                              $q->where('id', $filter);})
                            ->where('time', $time->id)
                                ->where('male', '1')
                                ->get();
                                
                            $female = App\Schedule::whereHas('day', function($q) use ($filter) {
                            $q->where('id', $filter);})
                            ->where('time', $time->id)
                                ->where('female', '1')
                                ->get();?>

                            {{--<td>--}}
                            <br>
                            {{count($male)? 'Male':''}}
                            @if(count($male) && count($female))
                                <br>
                            @endif
                            {{count($female)? 'Female':''}}
                        </td>

                        <?php $filter = $day->id; 
                        $routes = App\Schedule::whereHas('day', function($q) use ($filter) {
                          $q->where('id', $filter);})
                        ->where('time', $time->id)
                            ->first();
                            $routes = $routes->route;
                        if (count($routes) > 1) {
                            $routeFlag = count($routes) - 1;
                        } else {
                            $routeFlag = 0;
                        }?>

                        <td>
                            @if(count($routes)>0)
                                <table class="table table-bordered">
                                    @foreach($routes as $route)
                                        <tr>
                                            <td>{{$route->routename}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                        </td>
                        <td>
                            <table class="table table-bordered">
                                @foreach($routes as $route)
                                    <?php  $stopPoints = \App\BusPoint::where('routeid', $route->id)->orderBy('weight', 'asc')->get();
                                    if (count($stopPoints) > 1) {
                                        $pointFlag = count($stopPoints) - 1;
                                    } else {
                                        $pointFlag = 0;
                                    };
                                    ?>
                                    <tr>
                                        <td>
                                            @if(count($stopPoints)>0)
                                                @foreach($stopPoints as $stopPoint )
                                                    {!! $stopPoint->pointname !!}
                                                    @if($pointFlag)
                                                        {!! " => " !!}
                                                    @endif
                                                    <?php $pointFlag = $pointFlag - 1; ?>
                                                @endforeach
                                            @else
                                                {!! "All Stop Point" !!}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @else
        <p>No Schedule Found</p>
    @endif
    {{--</div>--}}
    <br>
@endsection

