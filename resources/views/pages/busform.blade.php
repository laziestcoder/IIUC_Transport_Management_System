@extends('admin::index')


@section('content')
    <section class="content-header">
        @include('inc.messages')
        <h1>
            {{$title}}
            <small>{{'Here you will get available route information. You can also add, remove and edit Bus Routes.'}}</small>
        </h1>
        <br><br>
        {!! Form :: open(['action' => 'BusRoutesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
        <div class="form-group">
            {{Form :: label('title','Bus Route Name')}}
            {{Form :: text('routename' , '', [ 'class' => 'form-control', 'placeholder' => 'Type Route Name', ])}}
        </div>
        {{-- <div class="form-group">
                {{Form :: label('body','Body')}}
                {{Form :: textarea('body' , '', ['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Body Text', ])}}    
        </div> --}}
        {{-- <div class="form-group">
            {{Form::file('cover_image')}}
        </div> --}}
        {{ Form :: submit('Submit',['class' => 'btn btn-primary']) }}
        {!! Form::close() !!}

    </section>
    <br><br>
    <section class="content">            
            {{--  @include('admin::partials.error')
                @include('admin::partials.success')
                @include('admin::partials.exception')
                @include('admin::partials.toastr') --}}

                {{-- {!! $content !!} --}}

    </section>
@endsection

