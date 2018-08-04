@extends('admin::index')

@section('content')
    <section class="content-header">
        {{--<div class="container">--}}
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
        @include('inc.messages')
        <h1>
            {{ $title }}
            <small>
                {!! $description ? $description : 'All Notice Posts' !!}

            </small>
        </h1>
    <br>
        <a href="/admin/auth/notices/create" class="btn btn-facebook">New Notice</a>

    {{--</section>--}}
        <br><br>
    {{--<section class="container-fluid">--}}
        @if(count($notices) > 0)
            <?php $count = 0; ?>
            @foreach($notices as $notice)
                <?php $count = $count + 1; ?>
                <div class="well">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <a href="/admin/auth/notices/{!! $notice->id !!}">
                                <img style="width:50%; height: 50%"
                                     src="/storage/cover_images/{!! $notice->cover_image !!}"
                                     alt="{{$notice->title}}">
                            </a>
                        </div>
                        <div class="col-md-8 col-sm-8">

                            <h3>{!! $count !!}. <a
                                        href="/admin/auth/notices/{!! $notice->id !!}">{!! $notice->title !!}</a>
                                <br>
                                <small>
                                    Written on: {!! $notice->created_at !!}
                                    <br>
                                    Posted
                                    by: {!! DB::table('admin_users')->where('id', $notice->user_id)->first()->name !!}
                                </small>
                            </h3>
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
                    </div>
                </div>
            @endforeach
            {!! $notices->links() !!}
        @else
            <div class="well">
                <div class="row">
                    <h4>No notices found</h4>
                </div>
            </div>
        @endif
        {{--</div>--}}
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