@extends('layouts.app')

@section('content')
    <a href="/notices" class="btn btn-default">Go Back</a>
    <h1>{{$notice->title}}</h1>
    <img style="width:20%; height: 20%" src="/storage/cover_images/{{$notice->cover_image}}" alt="{{$notice->title}}">
    <div class="body">
        {!! $notice->body !!}
    </div>
    <hr>
    <small>Written on {{$notice->created_at}} by {{$notice->user->name}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $notice->user_id)
            <a href="/notices/{{$notice->id}}/edit" class="btn btn-default">Edit</a>
            {!! Form::open(['action' => ['NoticesController@destroy', $notice->id], 'method' => 'POST', 'class' => 'pull-right' ]) !!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger']) }}
            {!! Form::close() !!}
        @endif
    @endif

    
@endsection