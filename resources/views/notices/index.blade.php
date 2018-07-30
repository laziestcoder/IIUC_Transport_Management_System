@extends('admin::index')

@section('content')
    <section class="content-header">
        <div class="container">
            @include('inc.messages')
            <h1>
                {!! $title !!}
                <small>
                    {!! $description ? $description : 'All Notice Posts' !!}
                </small>
            </h1>

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