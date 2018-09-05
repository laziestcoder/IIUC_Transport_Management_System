@extends('admin::index')


@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>

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
        {{--<div class="" style="text-align: center">--}}
        <h3><b>{{"All Schedule"}}</b><br><br></h3>
        @if(count($schedules) > 0)
            <table class="table table-hover table-responsive-lg">
                <thead class="table">
                <tr>
                    <th>Sl</th>
                    <th>ID</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Route</th>
                    <th>Male</th>
                    <th>Female</th>
                    <th>To IIUC</th>
                    <th>From IIUC</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="table">
                <?php $sl = 0;?>
                @foreach($schedules as $schedule)
                    <tr>
                        <td>{{$sl+=1}}</td>
                        <td>{{$schedule->id}}</td>
                        <td>{{App\Day::where('id',$schedule->day)->first()->dayname}}</td>
                        <td>{{\Carbon\Carbon::parse(App\Time::where('id',$schedule->time)->first()->time)->format('g:i A')}}</td>
                        <td>{{App\BusRoute::where('id',$schedule->route)->first()->routename}}</td>
                        <td>{{$schedule->male? 'YES' : 'NO'}}</td>
                        <td>{{$schedule->female? 'YES' : 'NO'}}</td>
                        <td>{{$schedule->toiiuc? 'YES' : 'NO'}}</td>
                        <td>{{$schedule->fromiiuc? 'YES' : 'NO'}}</td>
                        <td>
                            @if((Admin::user()->id == $schedule->user_id)||(DB::table('admin_role_users')->where('user_id',(Admin::user()->id))->first()->role_id <= 4))
                                <a href="" class="btn btn-primary">Edit</a>
                                {!! Form::open(['action'=>['ScheduleController@destroy', $schedule->id],'method' => 'POST', 'class' => 'pull','id' =>'delete','style'=>'display:inline' /* ,'onclick' => 'function deleteMe()' */]) !!}
                                {{--'onclick' => 'return confirm("Are you sure?")'--}}
                                {{Form::hidden('_method','DELETE')}}
                                {{ csrf_field() }}
                                {{Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle'=>'confirmation','data-placement'=>'top']) }}
                                {!! Form::close() !!}
                            @else
                                {{"You are not eligible"}}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @else
            <p>No Schedule Found</p>
        @endif
    </section>
    <script>
        $(document).ready(function () {
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function (event, element) {
                    element.closest('form').submit();
                }
            });
        });
    </script>
@endsection
