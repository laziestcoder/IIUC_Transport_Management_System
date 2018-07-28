@extends('admin::index')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>

    <section class="content-header">
        @include('inc.messages')
        <a href="/admin/auth/notices" class="btn btn-default">Go Back</a>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1>{{$notice->title}}</h1>
                    <img style="width:60%; height:60%" src="/storage/cover_images/{{$notice->cover_image}}"
                         alt="{{$notice->title}}">
                    {!! $notice->body !!}

                    <hr>
                    <small>Written on {{$notice->created_at}}
                        by {{DB::table('admin_users')->where('id', $notice->user_id)->first()->name}}</small>
                    <hr>
                    @if(Admin::user())
                        @if(Admin::user()->id == $notice->user_id)
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
            </div>
        </div>
    </section>

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