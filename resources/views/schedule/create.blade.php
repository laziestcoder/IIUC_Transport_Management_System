@extends('admin::index')

@section('content')
    <section class="content-header">
        @include('inc.messages')
        <h1>
            {{$title}}
            <small>{{$description}}</small>
        </h1>
    </section>
    <section class="content">
        <h3>{{$titlenew}}
            <small>{{'Before you submit please check the data correctly.'}}
            </small>
        </h3>

        <div class="">
            {!! Form :: open(['action'=>'ScheduleController@store','method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}

            <div class="form-group">
                {{Form :: label('title','Day')}}
                <select name="day" class = "form-control" required="true">
                    @if ( count($days) > 0 )
                        <option selected="true" value="" disabled="true" required="true">Pick a day</option>
                        @foreach($days as $day)
                            <option value="$day->id">{{$day->dayname}}</option>

                        @endforeach
                    @else
                        <option selected="true" >No Time Found</option>
                    @endif
                </select>
            </div>

            <div class="form-group">
                {{Form :: label('title','Select Time')}}
                <select name="time" class = "form-control" required="true">
                @if ( count($times) > 0 )
                        <option selected="true" value="" disabled="true" required="true">Pick a time</option>
                        @foreach($times as $time)
                        <option value="$time->id">{{Carbon\Carbon::parse($time->time)->format('g:i A')}}</option>
                    @endforeach
                @else
                        <option selected="true" >No Time Found</option>
                    @endif
                </select>
            </div>

            <div class="form-group">
                {{Form :: label('title','Bus For')}}
                <select name="user"  class = "form-control" required="true">
                        <option selected="true" value="" disabled="true" required="true">Pick a user</option>
                        <option value="1">{{"Students"}}</option>
                        <option value="2">{{"Faculty"}}</option>
                        <option value="3">{{"Officer/Staff"}}</option>
                </select>
            </div>

            <fieldset>
                <legend>Choose Bus Criteria</legend>

                <div class="form-group">
                    {{Form :: label('title','Male')}}
                    {{Form :: checkbox('fromiiuc' , '1', ['class' => 'checkbox form-control',])}}
                </div>

                <div class="form-group">
                    {{Form :: label('title','Female')}}
                    {{Form :: checkbox('fromiiuc' , '1', ['class' => 'checkbox form-control',])}}
                </div>
            </fieldset>

            <div class="form-group">
                {{Form :: label('title','Route')}}
                <select name="route"  class = "form-control" required="true">
                    <option selected="true" value="" disabled="true" required="true">Pick a route</option>
                    <option value="0">{{"All Route"}}</option>
                    <option value="1">{{"AK Khan"}}</option>
                </select>
            </div>
            <fieldset>
                <legend>Choose Bus Destination</legend>
            <div class="form-group">
                {{Form :: label('title','To IIUC Campus')}}
                {{Form :: checkbox('toiiuc' , '1', ['class' => 'checkbox form-control', ])}}
            </div>

            <div class="form-group">
                {{Form :: label('title','From IIUC Campus')}}
                {{Form :: checkbox('fromiiuc' , '1', ['class' => 'checkbox form-control',])}}
            </div>
            </fieldset>

            {{ Form :: submit('Submit',['class' => 'btn btn-primary']) }}
            {!! Form :: close() !!}
        </div>

        {{--Form Ends--}}

    </section>
@endsection