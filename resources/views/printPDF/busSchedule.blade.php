@extends('printPDF.layout')
@section('content')
    <div id="header-title" >
        <h1><img src="storage/img/logos/iiuc.png" alt="International Islamic University Chittagong"></h1>
        <h4>Kumira, Chittagong</h4>
    </div>
    <div id="print-it">
        <h2> Bus Schedule</h2>
        @if( count($schedules) > 0 )
            {{-- @foreach($days as $day)--}}
            <h3><b>{!! "Saturday to Wednesday" !!}</b></h3>
            <a class="btn btn-default" href="{{ route('bus-schedule-pdf',['download' => 'pdf'],['title' => 'Print Bus Schedule']) }}">
                <i class="fa fa-print"></i> PDF</a>
            {{--<a class="btn btn-default" href="#" onclick="window.print()"><i class="fa fa-print"></i>  Print</a>--}}
            <table class="table table-bordered" style="font-size: 15px;">
                <thead>
                <tr>
                    <th>{{"No."}}</th>
                    <th>{{"Starting Time"}}</th>
                    {{--<th>{{"Gender"}}</th>--}}
                    <th>{{"Direction"}}</th>
                    <th>{{"Route"}}</th>
                    <th>{{"Bus Stop Point"}}</th>
                </tr>
                </thead>
                <tbody>
                <?php $sl = 0; ?>
                @foreach($times as $time)
                    <?php $schedules = App\Schedule::where('day', 1)->
                    where('time', $time->id)
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

                            <?php $toiiuc = App\Schedule:://where('day', $day->id)->
                            where('time', $time->id)
                                ->where('toiiuc', '1')
                                ->get();
                            $fromiiuc = App\Schedule:://where('day', $day->id)->
                            where('time', $time->id)
                                ->where('fromiiuc', '1')
                                ->get();?>

                            <td>
                                {{count($toiiuc)? 'To IIUC Campus':''}}
                                @if(count($toiiuc) && count($fromiiuc))
                                    <br>
                                @endif
                                {{count($fromiiuc)? 'From IIUC Campus':''}}
                            </td>

                            <?php $routes = App\Schedule::where('day', 1)->//where('day','<=',5)->
                            where('time', $time->id)
                                ->get();
                            if (count($routes) > 1) {
                                $routeFlag = count($routes) - 1;
                            } else {
                                $routeFlag = 0;
                            }?>

                            <td>
                                @if(count($routes)>0)
                                <table class="table-bordered">
                                    @foreach($routes as $route)
                                        <tr>
                                            <td>{!!  \App\BusRoute::where('id',$route->route)->first()->routename !!}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                @endif
                            </td>
                            <td>
                                <table class="table-bordered">
                                    @foreach($routes as $route)
                                        <?php  $stopPoints = \App\BusPoint::where('routeid', $route->route)->orderBy('weight', 'asc')->get();
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
    </div>
    <br>
@endsection

