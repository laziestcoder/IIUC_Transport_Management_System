@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/notices/create" class="btn btn-primary">Create Notice</a>
                    <h3>Your Posted Notices</h3>
                    <hr>
                    @if( count($notices) >0 )
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Action</th>
                                    <th>Created On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notices as $notice)
                                    <tr>
                                        <td><a href="/notices/{{$notice->id}}">{{$notice->title}}</a></td>
                                        <td><a href="/notices/{{$notice->id}}/edit" class="btn btn-default">Edit</a>                    
                                            {!! Form::open(['action' => ['NoticesController@destroy', $notice->id], 'method' => 'POST','id' =>'delete', 'class' => 'pull','style'=>'display:inline']) !!}
                                                {{Form::hidden('_method','DELETE')}}
                                                {{ csrf_field() }}
                                                {{Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle'=>'confirmation','data-placement'=>'top']) }}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>{{$notice->created_at}}</td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    @else
                    <p> You have no post </p>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>        
        /* $(document).ready(function () {        
        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.closest('form').submit();
            }
        });   
    }); */
    $("#delete").on("submit", function(){
         return confirm("Do you want to delete this item?");
     });

</script>
@endsection
