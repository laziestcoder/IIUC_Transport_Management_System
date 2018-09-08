@extends('admin::index')

@section('content')
    {{--{{header("Refresh:0")}}--}}
    <section class="content-header">
        <div class="container">
            @include('inc.messages')
            <h1>
                {{$title}}
                <small>
                    Please attach a picture of the registered notice
                </small>
            </h1>
            <div class="container-fluid">
                {!! Form :: open(['action' => 'NoticesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
                <div class="form-group">
                    {{Form :: label('title','Title')}}
                    {{Form :: text('title' , '', [ 'class' => 'form-control', 'placeholder' => 'Title', 'required'])}}
                </div>
                <div class="form-group">
                    {{Form :: label('body','Body')}}
                    {{Form :: textarea('body' , '', ['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Body Text', 'required'])}}
                </div>
                <div class="form-group">
                    {{Form :: label('regno','Registartion No')}}
                    {{Form :: text('regno' , '', [ 'class' => 'form-control', 'placeholder' => 'Notice Registration No', 'required'])}}
                </div>
                <div class="form-group">
                    {{Form :: label('cover_image','Upload an Image ')}}(not mandatory)
                    {{Form::file('cover_image')}}
                </div>
                {{ Form :: submit('Submit',['class' => 'btn btn-primary']) }}
                {!! Form::close() !!}
            </div>
        </div>
    </section>
    <section class="content">
        {{--
                @include('admin::partials.error')
                @include('admin::partials.success')
                @include('admin::partials.exception')
                @include('admin::partials.toastr')
        --}}
        {{--
                {!! $content !!}
        --}}
    </section>
    <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('article-ckeditor');
    </script>

    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
    {{--<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>--}}
@endsection