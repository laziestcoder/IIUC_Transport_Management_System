@extends('layouts.userlayout')

@section('usercontent')
<h1>Edit Schedule</h1>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Management</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- <form action="" method="post">
                        <table size="width:100%">
                            <tr>
                                <td>Route</td>
                                <td>:</td>
                                <td><input size="30" type="text" name="route" id="route" placeholder="Enter Your Route" /></td>
                            </tr>
                    
                            <tr>
                                <td>Pick Up Point</td>
                                <td>:</td>
                                <td><input size="30" type="text" name="point" id="routepoint" placeholder="Enter Your Pick Up Point" /></td>
                            </tr>
                    
                            <tr>
                                <td>Day</td>
                                <td>:</td>
                                <td><input size="30" type="text" name="day" id="day" placeholder="Enter Your Day" /></td>
                            </tr>
                    
                            <tr>
                                <td></td>
                                <td></td>
                                <td><button type="submit" name="submit" id="studentsubmit" value="submit">Submit</button>
                                </td>
                            </tr>
                        </table>                    
                    </form> --}}

                    {!! Form :: open(['action' => 'BusPointsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
                    <div class="form-group">
                        {{Form :: label('title','Bus Route Name')}}
                        {{-- {{Form :: text('routename' , '', [ 'class' => 'form-control', 'placeholder' => 'Type Bus Stop Name', ])}} --}}
                        @if(count( $BusRoutes ) > 0 )
                            <select name="routename" required="True">
                                    <option value="" disabled="true" selected="true" required>Select A Route Name</option>
                                @foreach ($BusRoutes as $route)
                                    <option value="{{$route->id}}">{{$route->routename}}</option>
                                @endforeach
                            </select>
                        @else
                        <select name="routename">
                            <option value="" disabled="true" selected="true">No Route Added</option>
                        </select>
                        @endif    
                    </div>
                    <div class="form-group">
                            {{Form :: label('title','Bus Stop Point')}}
                            {{-- {{Form :: text('pointname' , '',  [ 'class' => 'form-control', 'placeholder' => 'Type Stop Point Name', 'required'=>'True'])}} --}}   
                            @if(count( $BusPoints ) > 0 /* && $BusPoints->routeid == $route->routename */ )
                            <select name="pointname" required="True">
                                    <option value="" disabled="true" selected="true" required>Select A Point Name</option>
                                @foreach ($BusPoints as $point)
                                    <option value="{{$point->id}}">{{$point->pointname}}</option>
                                @endforeach
                            </select>
                        @else
                        <select name="pointname">
                            <option value="" disabled="true" selected="true">No Point Added</option>
                        </select>
                        @endif    
                        </div>
                    {{-- <div class="form-group">
                        {{Form::file('cover_image')}}
                    </div> --}}
                    {{ Form :: submit('Submit',['class' => 'btn btn-primary']) }}
                    {!! Form::close() !!}
                    
                </div>
            </div>
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
    $("#delete").on("submit", function(){
         return confirm("Do you want to delete this item?");
     });

</script>
@endsection
