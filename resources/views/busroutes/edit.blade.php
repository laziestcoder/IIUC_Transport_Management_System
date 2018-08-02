@extends('admin::index')

@section('content')
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>--}}

    <section class="content-header">
        @include('inc.messages')
        <h1>
            {{$title}}
            <small>{{'Here you will get available route information. You can also add, remove and edit Bus Routes.'}}</small>
        </h1>
        <br><br>
        {!! Form :: open(['action' => ['BusRoutesController@update', $BusRoute->id ], 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
        <div class="form-group">
            {{Form :: label('title','Bus Route Name')}}
            {{Form :: text('routename' , $BusRoute->routename, [ 'class' => 'form-control', 'placeholder' => 'Type Route Name', ])}}
        </div>
        {{-- <div class="form-group">
                {{Form :: label('body','Body')}}
                {{Form :: textarea('body' , '', ['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Body Text', ])}}    
        </div> --}}
        {{-- <div class="form-group">
            {{Form::file('cover_image')}}
        </div> --}}
        {{Form::hidden('_method','PUT')}}
        {{ Form :: submit('Save',['class' => 'btn btn-primary']) }}
        {!! Form::close() !!}

    </section>
    <br><br>
    <section class="content">

        <h1>{{$titleinfo}}</h1>
        @if(count($BusRoutes) > 0)
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Route Name</th>
                    <th>Added By</th>
                    <th>Added On</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $flag = 0; ?>
                @foreach($BusRoutes as $route)
                    <tr>
                        <td>{{$flag+=1}}</td>
                        <td><a href="/admin/auth/routes/{{$route->id}}">{{$route->routename}}</a></td>
                        <td>{{$user = DB::table('admin_users')->where('id', $route->user_id)->first()->name}}</td>
                        <td>{{$route->created_at}}</td>
                        <td><a href="/admin/auth/routes/{{$route->id}}/edit" class="btn btn-default">Edit</a>
                            {{-- <a href="/notices/{{$route->id}}/edit" class="btn btn-default">Delete</a> --}}
                            {!! Form::open(['action' => ['BusRoutesController@destroy', $route->id], 'method' => 'POST', 'class' => 'pull','style'=>'display:inline' ]) !!}
                            {{Form::hidden('_method','DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle'=>'confirmation','data-placement'=>'top']) }}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$BusRoutes->links()}}
        @else
            <p>No notices found</p>
        @endif

        {{--  @include('admin::partials.error')
         @include('admin::partials.success')
         @include('admin::partials.exception')
         @include('admin::partials.toastr') --}}

        {{-- {!! $content !!}
--}}
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