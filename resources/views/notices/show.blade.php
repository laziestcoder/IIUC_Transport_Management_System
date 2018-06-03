@extends('layouts.app')

@section('content')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
 --}}
    <a href="/notices" class="btn btn-default">Go Back</a>
    <h1>{{$notice->title}}</h1>
    <img style="width:20%; height: 20%" src="/storage/cover_images/{{$notice->cover_image}}" alt="{{$notice->title}}">
    <div>
        {!! $notice->body !!}
    </div>
    <hr>
    <small>Written on {{$notice->created_at}} by {{$notice->user->name}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $notice->user_id)
            <a href="/notices/{{$notice->id}}/edit" class="btn btn-default">Edit</a>
            {!! Form::open(['action' => ['NoticesController@destroy', $notice->id], 'method' => 'POST','id' =>'delete', 'class' => 'pull','style'=>'display:inline','onclick' => 'function(){console.log("3");return confirm("Do you want to delete this item?");}' ]) !!}
                {{Form::hidden('_method','DELETE')}}
                {{ csrf_field() }}
                {{Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle'=>'confirmation','data-placement'=>'top']) }}
            {!! Form::close() !!}
        @endif
    @endif

    
<script>        
       $(document).ready(function () { 
        console.log("1");       
        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.closest('form').submit();
            }
        });
          
    });
    $("#delete").on("submit", function(){
        console.log("2");
         return confirm("Do you want to delete this item?");
     });

</script>
@endsection