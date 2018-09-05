@extends('layouts.userlayout')

@section('usercontent')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>

    <div class="panel-body backGround" >
        <h1>Edit Schedule</h1>
    </div>
    <hr>
    <div class="panel-body ">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif            
        <div class="container">
            <div class="userrouteinfo">
                <b><h3>Transport Schedule</h3></b>
                <hr>
                {!! Form :: open(['action' => 'ManagementController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
                {{ csrf_field() }}
                <table class="table table-hover table-bordered table-responsive-lg">
                    <thead class="">
                    <tr>
                        <td>
                            Day
                        </td>
                        <td>
                            Pick Up Point
                        </td>
                        <td>
                            Pick Up Time
                        </td>
                        <td>
                            Drop Point
                        </td>
                        <td>
                            Leaving Time
                        </td>
                    </tr>
                    </thead>
                    <tbody class="">
                    @if( count($days) > 0 )
                        @foreach($days as $day)
                            @if($day->id < 8)
                                <tr>
                                    <td>
                                        {!! $day->dayname !!}
                                    </td>
                                    <td>
                                        <div class="userRouteForm">
                                            @if(count( $BusPoints ) > 0  )
                                                <select name="pickpoint{{$day->id}}" required="True">
                                                    <option value="" disabled="true" selected="true">Select A Point
                                                        Name
                                                    </option>
                                                    <option value="0" required>No Need</option>

                                                    <?php
                                                    $place = App\StudentSchedule::where('user_id', $user->id)
                                                        ->where('day', $day->id)->first();
                                                    if ($place) {
                                                        $place = App\BusPoint::where('id', ($place->pickpoint))->first();
                                                        if ($place) {
                                                            $flag = $place->id;
                                                        } else {
                                                            $flag = 0;
                                                        }
                                                    } else {
                                                        $flag = 0;
                                                    }
                                                    ?>
                                                    @foreach ($BusPoints as $point)
                                                        @if($flag == $point->id)
                                                            <option selected="true"
                                                                    value="{{$point->id}}">{{$point->pointname}}</option>
                                                        @else
                                                            <option value="{{$point->id}}">{{$point->pointname}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @else
                                                <select name="pickpoint{{$day->id}}">
                                                    <option value="" disabled="true" selected="true">No Point
                                                        Available
                                                    </option>
                                                </select>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userRouteForm">
                                            @if(count( $picktimes ) > 0  )
                                                <select name="picktime{{$day->id}}" required="True">
                                                    <option value="" disabled="true" selected="true" required>Select A
                                                        Time
                                                    </option>
                                                    <option value="0" required>No Need</option>

                                                    <?php
                                                    $time = App\StudentSchedule::where('user_id', $user->id)
                                                        ->where('day', $day->id)->first();
                                                    if ($time) {
                                                        $time = App\Time::where('id', ($time->picktime))->first();
                                                        if ($time) {
                                                            $flag = $time->id;
                                                        } else {
                                                            $flag = 0;
                                                        }
                                                    } else {
                                                        $flag = 0;
                                                    }
                                                    ?>
                                                    @foreach ($picktimes as $picktime)
                                                        @if($flag == $picktime->id)
                                                            <option selected="true"
                                                                    value="{{$picktime->id}}">{{Carbon\Carbon::parse($picktime->time)->format('g:i A')}}</option>
                                                        @else
                                                            <option value="{{$picktime->id}}">{{Carbon\Carbon::parse($picktime->time)->format('g:i A')}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @else
                                                <select name="picktime{{$day->id}}">
                                                    <option value="" disabled="true" selected="true">No Time Available
                                                    </option>
                                                </select>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userRouteForm">
                                            @if(count( $BusPoints ) > 0  )
                                                <select name="droppoint{{$day->id}}" required="True">
                                                    <option value="" disabled="true" selected="true" required>Select A
                                                        Point Name
                                                    </option>
                                                    <option value="0" required>No Need</option>
                                                    <?php
                                                    $place = App\StudentSchedule::where('user_id', $user->id)
                                                        ->where('day', $day->id)->first();
                                                    if ($place) {
                                                        $place = App\BusPoint::where('id', ($place->droppoint))->first();
                                                        if ($place) {
                                                            $flag = $place->id;
                                                        } else {
                                                            $flag = 0;
                                                        }
                                                    } else {
                                                        $flag = 0;
                                                    }
                                                    ?>
                                                    @foreach ($BusPoints as $point)
                                                        @if($flag == $point->id)
                                                            <option selected="true"
                                                                    value="{{$point->id}}">{{$point->pointname}}</option>
                                                        @else
                                                            <option value="{{$point->id}}">{{$point->pointname}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @else
                                                <select name="droppoint{{$day->id}}">
                                                    <option value="" disabled="true" selected="true">No Point
                                                        Available
                                                    </option>
                                                </select>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userRouteForm">
                                            @if(count( $droptimes ) > 0  )
                                                <select name="droptime{{$day->id}}" required="True">
                                                    <option value="" disabled="true" selected="true" required>Select A
                                                        Time
                                                    </option>
                                                    <option value="0" required>No Need</option>
                                                    <?php
                                                    $time = App\StudentSchedule::where('user_id', $user->id)
                                                        ->where('day', $day->id)->first();
                                                    if ($time) {
                                                        $time = App\Time::where('id', ($time->droptime))->first();
                                                        if ($time) {
                                                            $flag = $time->id;
                                                        } else {
                                                            $flag = 0;
                                                        }
                                                    } else {
                                                        $flag = 0;
                                                    }

                                                    ?>
                                                    @foreach ($droptimes as $droptime)
                                                        @if($flag == $droptime->id)
                                                            <option selected="true"
                                                                    value="{{$droptime->id}}">{{Carbon\Carbon::parse($droptime->time)->format('g:i A')}}</option>
                                                        @else
                                                            <option value="{{$droptime->id}}">{{Carbon\Carbon::parse($droptime->time)->format('g:i A')}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @else
                                                <select name="droptime{{$day->id}}">
                                                    <option value="" disabled="true" selected="true">No Time Available
                                                    </option>
                                                </select>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>
                {{ Form :: submit('Submit',['class' => 'btn btn-primary']) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>




    <script>
        /* $(document).ready(function () {
        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.closest('form').submit();
            }
        });
    });
        $("#delete").on("submit", function () {
            return confirm("Do you want to delete this item?");
        });
        */

    </script>
@endsection
