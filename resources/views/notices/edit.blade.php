@extends('layouts.app')

@section('content')
{{-- <div class="jumbotron text-center">
 --}}        <h1>{{$title}}</h1>
{{-- </div>
 --}}    {!! Form :: open(['action' => ['NoticesController@update', $notice->id ], 'method' => 'POST', 'enctype' => 'multipart/form-data'  ]) !!}
        <div class="form-group">
            {{Form :: label('title','Title')}}
            {{Form :: text('title' , $notice->title, [ 'class' => 'form-control', 'placeholder' => 'Title', ])}}
        </div>
        <div class="form-group">
                {{Form :: label('body','Body')}}
                {{Form :: textarea('body' , $notice->body, ['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Body Text', ])}}    
        </div>
        <div class="form-group">
                {{Form::file('cover_image')}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{ Form :: submit('Submit',['class' => 'btn btn-primary']) }}
    
    
    {!! Form::close() !!}


@endsection