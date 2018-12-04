@extends('printPDF.layout')
@section('content')
    <div id="print-it" style="text-align:center;">
        <h2> Bus Schedule</h2>
        @if( count($schedules) > 0 )
            {{-- @foreach($days as $day)--}}
            <h3><b>{!! "Friday" !!}</b></h3>
            <table class="table table-hover table-bordered">
                <thead class="table">
                <tr>
                    <th>{{"No."}}</th>
                    <th>{{"Starting Time"}}</th>
                    {{--<th>{{"Gender"}}</th>--}}
                    <th>{{"Direction"}}</th>
                    <th>{{"Route"}}</th>
                    <th>{{"Bus Stop Point"}}</th>
                </tr>
                </thead>
                <tbody class="table">
                <?php $sl = 0; ?>
                @foreach($times as $time)
                    <?php $schedules = App\Schedule::where('day', 7)->
                    where('time', $time->id)
                        ->get();?>
                    @if(count($schedules) > 0)
                        <tr>
                            <td>{{$sl +=1}}
                            </td>
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
                                    {{","}}
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
                                    {{","}}
                                @endif
                                {{count($fromiiuc)? 'From IIUC Campus':''}}
                            </td>

                            <?php $routes = App\Schedule::where('day', 7)->//where('day','<=',5)->
                            where('time', $time->id)
                                ->get();
                            if (count($routes) > 1) {
                                $routeFlag = count($routes) - 1;
                            } else {
                                $routeFlag = 0;
                            }?>

                            <td>
                                @foreach($routes as $route)
                                    {!!  \App\BusRoute::where('id',$route->route)->first()->routename !!}
                                    @if($routeFlag)
                                        <hr>
                                    @endif
                                    <?php $routeFlag -= 1;?>
                                @endforeach
                            </td>
                            <td><?php  if (count($routes) > 1) {
                                    $routeFlag = count($routes) - 1;
                                } else {
                                    $routeFlag = 0;
                                } ?>
                                @foreach($routes as $route)
                                    <?php  $stopPoints = \App\BusPoint::where('routeid', $route->route)->get();
                                    if (count($stopPoints) > 1) {
                                        $pointFlag = count($stopPoints) - 1;
                                    } else {
                                        $pointFlag = 0;
                                    };
                                    ?>
                                    @foreach($stopPoints as $stopPoint )
                                        {!! $stopPoint->pointname !!}
                                        @if($pointFlag)
                                            {{", "}}
                                        @endif
                                        <?php $pointFlag -= 1;?>
                                    @endforeach
                                    @if($routeFlag)
                                        <hr>
                                    @endif
                                    <?php $routeFlag -= 1;?>
                                @endforeach
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>

            {{--@endforeach--}}
        @else
            <p>No Schedule Found</p>
        @endif
    </div>
    {{--<a href="#" onclick="printInfo(this)">Print</a>--}}
    <a href="{{ route('bus-schedule-friday',['download' => 'pdf'],['title' => 'Print Bus Schedule']) }}">Download
        PDF</a>
    {{--<button onclick="myFunction()">Print this page</button>--}}
    <script>
        function myFunction() {
            var prtContent = document.getElementById("print-it");
            var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
            WinPrint.document.write('<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">');
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        }

        function printInfo(ele) {
            var openWindow = window.open("", "title", "attributes");
            openWindow.document.write('<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">');
            openWindow.document.write(ele.previousSibling.innerHTML);
            openWindow.document.close();
            openWindow.focus();
            openWindow.print();
            openWindow.close();
        }
    </script>
@endsection

