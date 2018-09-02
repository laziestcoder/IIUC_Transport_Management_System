@extends('layouts.userlayout')

@section('usercontent')
    <div class="panel-body backGround">
        <h1>Bus Schedules</h1>
    </div>
    <hr>
    <div class="panel-body">
        <div id='transport' class="container">
            <div class="userrouteinfo">
                    @if( count($days) > 0 )
                        @foreach($days as $day)
                            @if($day->id != 9)
                            <h3><b>{{"$day->dayname"}}</b></h3>
                            <table class="table table-bordered table-responsive-lg">
                                <thead class="">
                                <tr>
                                    <td>{{"No."}}</td>
                                    <td>{{"Starting Time"}}</td>
                                    <td>{{"Gender"}}</td>
                                    <td>{{"Direction"}}</td>
                                    <td>{{"Starting Point"}}</td>
                                </tr>
                                </thead>
                                <tbody class="">
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
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            {{--{{$schedules->links()}}--}}
                        @endif
                    @endforeach
                @else
                    <p>No Schedule Found</p>
                @endif
            </div>
        </div>
    </div>
@endsection
