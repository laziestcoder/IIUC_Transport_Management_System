@extends('admin::index')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
    <script>
        // $(document).ready(function () {
        //     console.log("1");
        //     $('[data-toggle=confirmation]').confirmation({
        //         rootSelector: '[data-toggle=confirmation]',
        //         onConfirm: function (event, element) {
        //             element.closest('form').submit();
        //         }
        //     });
        //
        // });
        // $("#delete").on("submit", function () {
        //     console.log("2");
        //     return confirm("Do you want to delete this item?");
        // });
    </script>
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
    <section class="content-header">
        <div class="container">
            @include('inc.messages')
            <a href="/admin/auth/notices" class="btn btn-primary">Go Back</a>
            <div class="row">
                <div class="col-md-10">
                    <h1>{!! $notice->title !!}
                        <small></small>
                    </h1>
                    <div class="col-md-10 col-md">
                        <img style="width:60%; height:60%" src="/storage/cover_images/{!! $notice->cover_image !!}"
                             alt="{!! $notice->title !!}">
                    </div>
                    <div class="col-md-10 col-md">
                        <article>
                            {!! $notice->body !!}
                        </article>
                    </div>
                    <div class="col-md-10 col-md">
                        Written on: {!! $notice->created_at !!}
                        <br>
                        Posted by: {!! DB::table('admin_users')->where('id', $notice->user_id)->first()->name !!}
                        <small>
                            (
                            @if(Admin::user()->id == $notice->user_id)
                                {!! ' Yourself ' !!}
                            @else
                                {!! ' Other Admin ' !!}
                            @endif
                            )
                        </small>
                    </div>
                </div>
            </div>
            @if(Admin::user())
                @if((Admin::user()->id == $notice->user_id)||(DB::table('admin_role_users')->where('user_id',(Admin::user()->id))->first()->role_id <= 4))
                    <a href="/admin/auth/notices/{{$notice->id}}/edit" class="btn btn-default">Edit</a>
                    {{--{!! Form::open(['action' => ['NoticesController@destroy', $notice->id], 'method' => 'POST','id' =>'delete', 'class' => 'pull','style'=>'display:inline','onclick' => 'function(){console.log("3");return confirm("Do you want to delete this item?");}' ]) !!}--}}
                    {!! Form::open(['action' => ['NoticesController@destroy', $notice->id], 'method' => 'POST', 'class' => 'pull','id' =>'delete','style'=>'display:inline'  ]) !!}
                    {{Form::hidden('_method','DELETE')}}
                    {{ csrf_field() }}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle'=>'confirmation','data-placement'=>'top']) }}
                    {!! Form::close() !!}
                @endif
            @endif

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
@endsection