@extends('layouts.userlayout')

@section('usercontent')
    <div class="panel-body" style="background:#212529">
        <h1>Edit Schedule</h1>
    </div>
    <hr>
    <div class="panel-body" style="background:#212529">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="container">
            <div class="userinfo">
                <b><h3>Basic Info:</h3></b><hr>

                <table class="table-active">
                    <thead class="">
                    <tr>
                        <td>
                            Name: {{Auth::user()->name}}
                        </td>
                        <td>
                            Gender: {{Auth::user()->gender == 0 ? 'Male' : 'Female'}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ID: {{Auth::user()->id}}
                        </td>
                        <td>
                            Registered
                            As: {{Auth::user()->userrole == 1 ? 'Student' : ( Auth::user()->userrole == 2 ? 'Faculty Member' :(Auth::user()->userrole == 3 ? 'Officer/Staff' : 'undefined')) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email: {{Auth::user()->email}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Contact: {{Auth::user()->contact ? Auth::user()->contact : 'none'}}
                        </td>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <br><br>
        <div class="container">
            <div class="userrouteinfo">
                <b><h3>Transport Schedule</h3></b>
                <hr>
                {!! Form :: open(['action' => 'BusPointsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
                <table class="table table-bordered">
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
                    <tbody>
                    <tr>
                        <td>
                            Saturday
                        </td>
                        <td>
                            <div class="userRouteForm">
                            @if(count( $BusPoints ) > 0  )
                                <select name="pointnamesatp" required="True">
                                    <option value="" disabled="true" selected="true" required>Select A Point Name
                                    </option>
                                    @foreach ($BusPoints as $point)
                                        <option value="{{$point->id}}">{{$point->pointname}}</option>
                                    @endforeach
                                </select>
                            @else
                                <select name="pointname">
                                    <option value="" disabled="true" selected="true">No Point Available</option>
                                </select>
                            @endif
                            </div>
                        </td>
                        <td>
                            Pick Up Time
                        </td>
                        <td>
                            <div class="userRouteForm">
                                @if(count( $BusPoints ) > 0  )
                                    <select name="pointnamesatd" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        @foreach ($BusPoints as $point)
                                            <option value="{{$point->id}}">{{$point->pointname}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                @endif
                            </div>
                        </td>
                        <td>
                            Leaving Time
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Sunday
                        </td>
                        <td>
                            <div class="userRouteForm">
                                @if(count( $BusPoints ) > 0  )
                                    <select name="pointnamesunp" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        @foreach ($BusPoints as $point)
                                            <option value="{{$point->id}}">{{$point->pointname}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                @endif
                            </div>
                        </td>
                        <td>
                            Pick Up Time
                        </td>
                        <td>
                            <div class="userRouteForm">
                                @if(count( $BusPoints ) > 0  )
                                    <select name="pointnamesund" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        @foreach ($BusPoints as $point)
                                            <option value="{{$point->id}}">{{$point->pointname}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                @endif
                            </div>
                        </td>
                        <td>
                            Leaving Time
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Monday
                        </td>
                        <td>
                            <div class="userRouteForm">
                                @if(count( $BusPoints ) > 0  )
                                    <select name="pointnamemonp" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        @foreach ($BusPoints as $point)
                                            <option value="{{$point->id}}">{{$point->pointname}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                @endif
                            </div>
                        </td>
                        <td>
                            Pick Up Time
                        </td>
                        <td>
                            <div class="userRouteForm">
                                @if(count( $BusPoints ) > 0  )
                                    <select name="pointnamemond" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        @foreach ($BusPoints as $point)
                                            <option value="{{$point->id}}">{{$point->pointname}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                @endif
                            </div>
                        </td>
                        <td>
                            Leaving Time
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Tuesday
                        </td>
                        <td>
                            <div class="userRouteForm">
                                @if(count( $BusPoints ) > 0  )
                                    <select name="pointnametuep" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        @foreach ($BusPoints as $point)
                                            <option value="{{$point->id}}">{{$point->pointname}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                @endif
                            </div>
                        </td>
                        <td>
                            Pick Up Time
                        </td>
                        <td>
                            <div class="userRouteForm">
                                @if(count( $BusPoints ) > 0  )
                                    <select name="pointnametued" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        @foreach ($BusPoints as $point)
                                            <option value="{{$point->id}}">{{$point->pointname}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                @endif
                            </div>
                        </td>
                        <td>
                            Leaving Time
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Wednesday
                        </td>
                        <td>
                            <div class="userRouteForm">
                                @if(count( $BusPoints ) > 0  )
                                    <select name="pointnamewedp" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        @foreach ($BusPoints as $point)
                                            <option value="{{$point->id}}">{{$point->pointname}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                @endif
                            </div>
                        </td>
                        <td>
                            Pick Up Time
                        </td>
                        <td>
                            <div class="userRouteForm">
                                @if(count( $BusPoints ) > 0  )
                                    <select name="pointnamewedd" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        @foreach ($BusPoints as $point)
                                            <option value="{{$point->id}}">{{$point->pointname}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                @endif
                            </div>
                        </td>
                        <td>
                            Leaving Time
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Thursday
                        </td>
                        <td>
                            <div class="userRouteForm">
                                @if(count( $BusPoints ) > 0  )
                                    <select name="pointnamethup" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        @foreach ($BusPoints as $point)
                                            <option value="{{$point->id}}">{{$point->pointname}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                @endif
                            </div>
                        </td>
                        <td>
                            Pick Up Time
                        </td>
                        <td>
                            <div class="userRouteForm">
                                @if(count( $BusPoints ) > 0  )
                                    <select name="pointnamethud" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        @foreach ($BusPoints as $point)
                                            <option value="{{$point->id}}">{{$point->pointname}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                @endif
                            </div>
                        </td>
                        <td>
                            Leaving Time
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Friday
                        </td>
                        <td>
                            <div class="userRouteForm">
                                @if(count( $BusPoints ) > 0  )
                                    <select name="pointnamefrip" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        @foreach ($BusPoints as $point)
                                            <option value="{{$point->id}}">{{$point->pointname}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                @endif
                            </div>
                        </td>
                        <td>
                            Pick Up Time
                        </td>
                        <td>
                            <div class="userRouteForm">
                                @if(count( $BusPoints ) > 0  )
                                    <select name="pointnamefrid" required="True">
                                        <option value="" disabled="true" selected="true" required>Select A Point Name
                                        </option>
                                        @foreach ($BusPoints as $point)
                                            <option value="{{$point->id}}">{{$point->pointname}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="pointname">
                                        <option value="" disabled="true" selected="true">No Point Available</option>
                                    </select>
                                @endif
                            </div>
                        </td>
                        <td>
                            Leaving Time
                        </td>
                    </tr>

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
    }); */
        $("#delete").on("submit", function () {
            return confirm("Do you want to delete this item?");
        });

    </script>
@endsection

{{--<div class="container">--}}
{{--<div class="row">--}}
{{--<div class="col-md-11">--}}
{{--<div class="panel panel-default">--}}
{{--<div class="panel-heading">Management</div>--}}

{{--<div class="panel-body" style="height:100%;background:black">--}}
{{--@if (session('status'))--}}
{{--<div class="alert alert-success">--}}
{{--{{ session('status') }}--}}
{{--</div>--}}
{{--@endif--}}
{{--<form action="" method="post">--}}
{{--<table size="width:100%">--}}
{{--<tr>--}}
{{--<td>Route</td>--}}
{{--<td>:</td>--}}
{{--<td><input size="30" type="text" name="route" id="route"--}}
{{--placeholder="Select Your Route"/></td>--}}
{{--</tr>--}}

{{--<tr>--}}
{{--<td>Pick Up Point</td>--}}
{{--<td>:</td>--}}
{{--<td><input size="30" type="text" name="point" id="routepoint"--}}
{{--placeholder="Enter Your Pick Up Point"/></td>--}}
{{--</tr>--}}

{{--<tr>--}}
{{--<td>Day</td>--}}
{{--<td>:</td>--}}
{{--<td><input size="30" type="text" name="day" id="day"--}}
{{--placeholder="Enter Your Day"/></td>--}}
{{--</tr>--}}

{{--<tr>--}}
{{--<td></td>--}}
{{--<td></td>--}}
{{--<td>--}}
{{--<button type="submit" name="submit" id="studentsubmit" value="submit">--}}
{{--Submit--}}
{{--</button>--}}
{{--</td>--}}
{{--</tr>--}}
{{--</table>--}}
{{--</form>--}}

{{--{!! Form :: open(['action' => 'BusPointsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}--}}
{{--<div class="form-group">--}}
{{--{{Form :: label('title','Bus Route Name')}}--}}
{{--{{Form :: text('routename' , '', [ 'class' => 'form-control', 'placeholder' => 'Type Bus Stop Name', ])}}--}}
{{--@if(count( $BusRoutes ) > 0 )--}}
{{--<select name="routename" required="True">--}}
{{--<option value="" disabled="true" selected="true" required>Select A Route Name--}}
{{--</option>--}}
{{--@foreach ($BusRoutes as $route)--}}
{{--<option value="{{$route->id}}">{{$route->routename}}</option>--}}
{{--@endforeach--}}
{{--</select>--}}
{{--@else--}}
{{--<select name="routename">--}}
{{--<option value="" disabled="true" selected="true">No Route Added</option>--}}
{{--</select>--}}
{{--@endif--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--{{Form :: label('title','Bus Stop Point')}}--}}
{{--{{Form :: text('pointname' , '',  [ 'class' => 'form-control', 'placeholder' => 'Type Stop Point Name', 'required'=>'True'])}}--}}
{{--@if(count( $BusPoints ) > 0  )--}}
{{--<select name="pointname" required="True">--}}
{{--<option value="" disabled="true" selected="true" required>Select A Point Name--}}
{{--</option>--}}
{{--@foreach ($BusPoints as $point)--}}
{{--<option value="{{$point->id}}">{{$point->pointname}}</option>--}}
{{--@endforeach--}}
{{--</select>--}}
{{--@else--}}
{{--<select name="pointname">--}}
{{--<option value="" disabled="true" selected="true">No Point Added</option>--}}
{{--</select>--}}
{{--@endif--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--{{Form::file('cover_image')}}--}}
{{--</div>--}}
{{--{{ Form :: submit('Submit',['class' => 'btn btn-primary']) }}--}}
{{--{!! Form::close() !!}--}}

{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
