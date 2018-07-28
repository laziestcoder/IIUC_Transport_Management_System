@extends('admin::index')

@section('content')
    <section class="content-header">
        @include('inc.messages')
        <h1>{{$title}}</h1>
        @if(count($notices) > 0)
            <?php $count = 0; ?>
            @foreach($notices as $notice)
                <?php $count = $count + 1; ?>
                <div class="well">
                    <div class="row">
                        <b>{{$count}}</b>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <img style="width:50%; height: 50%" src="/storage/cover_images/{{$notice->cover_image}}"
                                 alt="{{$notice->title}}">
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h3><a href="/admin/auth/notices/{{$notice->id}}">{{$notice->title}}</a></h3>
                            <small>Written on {{$notice->created_at}}
                                by {{DB::table('admin_users')->where('id', $notice->user_id)->first()->name}}</small>
                        </div>
                    </div>

                </div>
            @endforeach
            {{$notices->links()}}
        @else
            <h4>No notices found</h4>
        @endif
    </section>
@endsection