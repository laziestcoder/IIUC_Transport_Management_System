@extends('admin::index')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>

    <section class="content-header">
        @include('inc.messages')
        <h1>
            {{$title}}
            {{-- @foreach ( $BusRoutes as $route )
                {{$route}} --}}
            <small>{{'Here you will get available route information. You can also add, remove and edit Bus Routes.'}}</small>
        </h1>
        <br><br>
        {!! Form :: open(['action' => ['BusPointsController@update',$BusPoint->id], 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
        <div class="form-group">
            {{Form :: label('title','Bus Route Name')}}
            {{-- {{Form :: text('routename' , '', [ 'class' => 'form-control', 'placeholder' => 'Type Bus Stop Name', ])}} --}}
            @if(count( $BusRoutes ) > 0 )
                <select data-id="{{$BusPoint->routeid}}" name="routename" required="true">
                    <option value="" disabled="true">Select A Route Name</option>
                    @foreach ($BusRoutes as $route)
                        @if($route->id == $BusPoint->routeid)
                            <option value="{{$route->id}}" selected>{{$route->routename}}</option>
                        @else
                            <option value="{{$route->id}}">{{$route->routename}}</option>
                        @endif
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
            {{Form :: text('pointname' , $BusPoint->pointname,  [ 'class' => 'form-control', 'placeholder' => 'Type Stop Point Name', 'required' => 'true' ])}}
        </div>
        {{-- <div class="form-group">
            {{Form::file('cover_image')}}
        </div> --}}
        {{Form::hidden('_method','PUT')}}
        {{ Form :: submit('Submit',['class' => 'btn btn-primary']) }}
        {!! Form::close() !!}

    </section>
    <br><br>
    <section class="content">

        {{-- @include('admin::partials.error')
        @include('admin::partials.success')
        @include('admin::partials.exception')
        @include('admin::partials.toastr')

        {!! $content !!} --}}

        <h1>{{$titleinfo}}</h1>
        @if(count($BusPoints) > 0)
            <table class="table table-hover">
                <thead class="table">
                <tr>
                    <th>ID</th>
                    <th>Point Name</th>
                    <th>Route Name</th>
                    <th>Added By</th>
                    <th>Added On</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="table">
                <?php $flag = 0; ?>
                @foreach($BusPoints as $point)
                    <tr>
                        <td>{{$flag+=1}}</td>
                        <td>{{$point->pointname}}</td>
                        <td>
                            <a href="/admin/auth/routes/{{$point->routeid}}">{{$user = DB::table('routes')->where('id', $point->routeid)->first()->routename}}</a>
                        </td>
                        <td>{{$user = DB::table('admin_users')->where('id', $point->user_id)->first()->name}}</td>
                        <td>{{$point->created_at}}</td>
                        <td><a href="/admin/auth/points/{{$point->id}}/edit" class="btn btn-default">Edit</a>
                            {!! Form::open(['action' => ['BusPointsController@destroy', $point->id], 'method' => 'POST', 'class' => 'pull','style'=>'display:inline' ]) !!}
                            {{Form::hidden('_method','DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle'=>'confirmation','data-placement'=>'top']) }}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$BusPoints->links()}}
        @else
            <p>No notices found</p>
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


{{-- <script>
    $(document).ready(function () {
// Edit Point

        var routename = $('select[name=routename]').data('id');
            //alert(routename);
            $('select[name=euser-role]').ready(function () {
                $('option[value=' + routename + ']').attr('selected', true);
            });
        }});
</script>

 --}}