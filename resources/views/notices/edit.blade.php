@extends('admin::index')

@section('content')
    <section class="content-header">
        @include('inc.messages')
        <h1>{{$title}}</h1>
        {!! Form :: open(['action' => ['NoticesController@update', $notice->id ], 'method' => 'POST', 'enctype' => 'multipart/form-data'  ]) !!}
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
        {{ Form :: submit('Save',['class' => 'btn btn-primary']) }}


        {!! Form::close() !!}

    </section>
    <br>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('article-ckeditor');
    </script>
@endsection