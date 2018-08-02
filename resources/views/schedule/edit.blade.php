@extends('admin::index')


@section('content')
    <section class="content-header">
        @include('inc.messages')
        <h1>
            {{"ScheduleInformation HEADER TITLE"}}
            <small>{{'Here you will get available route information. You can also add, remove and edit Bus Routes.'}}</small>
        </h1>
    </section>
    <br><br>
    <section class="content">
        <h1>{{"Schedule INFORMATION"}}</h1>
    </section>
@endsection