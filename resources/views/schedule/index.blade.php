@extends('admin::index')


@section('content')

    {{--<script>--}}
    {{--$(document).ready(function () {--}}
    {{--$('[data-toggle=confirmation]').confirmation({--}}
    {{--rootSelector: '[data-toggle=confirmation]',--}}
    {{--onConfirm: function (event, element) {--}}
    {{--element.closest('form').submit();--}}
    {{--}--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}
    <section class="content-header">
        @include('inc.messages')
        <h1>
            {{$title}}
            <small>{{$description}}</small>
        </h1>
    </section>
    <br>
    <section class="content">
        <h2>{{$titleinfo}}
            <small>
                {{'Before delete a schedule please ensure the schedule is not used in any other data.'}}
            </small>
        </h2>

        @if( count($days) > 0 )
            @foreach($days as $day)
                    <h3><b>{{"$day->dayname"}}</b></h3>

            @if( $day->id == 7  )
                    <a class="btn btn-success" target="_blank" href='/bus-schedule-friday'>
                        <i class="fa fa-print"></i>Print
                    </a>
                @elseif ($day->id <= 5 && $day->id >= 1 )
                <a class="btn btn-success" target="_blank" href='/bus-schedule-pdf'>
                    <i class="fa fa-print"></i> Print
                </a>
                @endif
                    <table class="table table-hover table-bordered table-responsive-lg">
                        <thead class="table">
                        <tr>
                            <th>{{"No."}}</th>
                            <th>{{"Starting Time"}}</th>
                            <th>{{"Gender"}}</th>
                            <th>{{"Direction"}}</th>
                            <th>{{"Route"}}</th>
                            <th>{{"Added By"}}</th>
                            {{--<th>{{"Action"}}</th>--}}
                        </tr>
                        </thead>
                        <tbody class="table">
                        <?php $sl = 0; ?>
                        @foreach($times as $time)
                            <?php $schedules = App\Schedule::where('day', $day->id)
                                ->where('time', $time->id)
                                ->get();?>
                            @if(count($schedules) > 0)
                                <tr>

                                    <td>{{$sl +=1}}</td>
                                    <td>{{\Carbon\Carbon::parse(App\Time::where('id',$time->id)->first()->time)->format('g:i A')}}</td>

                                    <?php $male = App\Schedule::where('day', $day->id)
                                        ->where('time', $time->id)
                                        ->where('male', '1')
                                        ->get();
                                    $female = App\Schedule::where('day', $day->id)
                                        ->where('time', $time->id)
                                        ->where('female', '1')
                                        ->get();?>

                                    <td>
                                        {{count($male)? 'Male':''}}
                                        @if(count($male) && count($female))
                                            {{","}}
                                        @endif
                                        {{count($female)? 'Female':''}}
                                    </td>

                                    <?php $toiiuc = App\Schedule::where('day', $day->id)
                                        ->where('time', $time->id)
                                        ->where('toiiuc', '1')
                                        ->get();
                                    $fromiiuc = App\Schedule::where('day', $day->id)
                                        ->where('time', $time->id)
                                        ->where('fromiiuc', '1')
                                        ->get();?>

                                    <td>
                                        {{count($toiiuc)? 'To IIUC Campus':''}}
                                        @if(count($toiiuc) && count($fromiiuc))
                                            {{","}}
                                        @endif
                                        {{count($fromiiuc)? 'From IIUC Campus':''}}
                                    </td>

                                    <?php $routes = App\Schedule::where('day', $day->id)
                                        ->where('time', $time->id)
                                        ->get();
                                    if (count($routes) > 1) {
                                        $routeFlag = count($routes) - 1;
                                    } else {
                                        $routeFlag = 0;
                                    }?>

                                    <td>
                                        @foreach($routes as $route)
                                            {{\App\BusRoute::where('id',$route->route)->first()->routename}}
                                            @if($routeFlag)
                                                {{", "}}
                                            @endif
                                            <?php $routeFlag -= 1;?>
                                        @endforeach
                                    </td>
                                    <?php $userid = App\Schedule::where('day', $day->id)
                                        ->where('time', $time->id)
                                        ->first(); ?>
                                    <td>{{Admin::user()->where('id',$userid->user_id)->first()->name}}</td>

                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
            @endforeach
        @else
            <p>No Schedule Found</p>
        @endif

    </section>
@endsection
