@extends('Admin::index')

@section('content')
<div >
        <h1>{{$title}}</h1>
</div>
    @if(count($notices) > 0)
        @foreach($notices as $notice)
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:50%; height: 50%" src="/storage/cover_images/{{$notice->cover_image}}" alt="{{$notice->title}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/notices/{{$notice->id}}">{{$notice->title}}</a></h3>
                        <small>Written on {{$notice->created_at}} by {{$notice->user->name}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        {{$notices->links()}}    
    @else
        <p>No notices found</p>
    @endif
@endsection