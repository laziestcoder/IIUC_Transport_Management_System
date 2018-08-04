@extends('admin::index')


@section('content')
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
    <section class="content-header">
        @include('inc.messages')
        <h1>
            {{$title}}
            <small>{{$description}}</small>
        </h1>
    </section>
    <br><br>
    <section class="content">
        <h1>{{$titleinfo}}
            <small>
                {{'Before delete a schedule please ensure the schedule is not used in any other data.'}}
            </small>
        </h1>
        {{--<div class="" style="text-align: center">--}}
        <h2>{{"Schedule by day"}}<br><br><b>{{"Saturday"}}</b> </h2>
        @if( count($satday) > 0 )
            <table class="table table-responsive table-hover">
                <thead class="table">
                <tr>
                    <th>{{"ID"}}</th>
                    <th>{{"To IIUC Campus"}}</th>
                    <th>{{"From IIUC Campus"}}</th>
                    <th>{{"Male"}}</th>
                    <th>{{"Female"}}</th>
                    <th>{{"Time"}}</th>
                    <th>{{"Bus For"}}</th>
                    <th>{{"Bus Route"}}</th>
                    <th>{{"Added By"}}</th>
                    <th>{{"Action"}}</th>
                </tr>
                </thead>
                <tbody class="table">
                @foreach($satday as $schedule)
                    <tr>
                        <td>{{$schedule->id}}</td>
                        <td>{{$schedule->toiiuc?'YES':'NO'}}</td>
                        <td>{{$schedule->fromiiuc?'YES':'NO'}}</td>
                        <td>{{$schedule->male?'YES':'NO'}}</td>
                        <td>{{$schedule->female?'YES':'NO'}}</td>
                        <td>{{\Carbon\Carbon::parse(App\Time::where('id',$schedule->time)->first()->time)->format('g:i A')}}</td>
                        <td>{{$schedule->user == 1 ? 'Students': ( $schedule->user == 2 ? 'Faculty':'Officer/Staff')}}</td>
                        <td>{{App\BusRoute::where('id',$schedule->route)->first()->routename}}</td>
                        <td>{{Admin::user()->where('id',$schedule->user_id)->first()->name}}</td>
                        <td>
                            <a href="" class="btn btn-primary">Edit</a>
                            {!! Form::open(['action'=>['ScheduleController@destroy', $schedule->id],'method' => 'POST', 'class' => 'pull','id' =>'delete','style'=>'display:inline' /* ,'onclick' => 'function deleteMe()' */]) !!} {{-- 'onclick' => 'return confirm("Are you sure?")' --}}
                            {{Form::hidden('_method','DELETE')}}
                            {{ csrf_field() }}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle'=>'confirmation','data-placement'=>'top']) }}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{--{{$schedules->links()}}--}}
        @else
            <p>No Schedule Found</p>
        @endif
        {{--</div>--}}
        {{--</div>--}}
    </section>
@endsection
