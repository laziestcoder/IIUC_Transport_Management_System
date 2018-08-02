@extends('admin::index')


@section('content')
    <section class="content-header">
        @include('inc.messages')
        <h1>
            {{$title}}
            <small>{{$description}}</small>
        </h1>
    </section>

    <section class="content">
        <h3>{{$titleinfo}}
            <small>
                {{'Before delete a schedule please ensure the schedule is not used in any other data.'}}
            </small>
        </h3>


    </section>
@endsection