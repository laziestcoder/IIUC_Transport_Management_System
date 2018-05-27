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
                    @if( count($notices) >0 )
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($notices as $notice)
                                <tr>
                                    <td><a href="/notices/{{$notice->id}}">{{$notice->title}}</a></td>
                                    <td><a href="/notices/{{$notice->id}}/edit" class="btn btn-default">Edit</a></td>
                                    <td>
                                        {!! Form::open(['action' => ['NoticesController@destroy', $notice->id], 'method' => 'POST', 'class' => 'pull-right' ]) !!}
                                            {{Form::hidden('_method','DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>

                            @endforeach
                        </table>
                    @else
                    <p> You have no post </p>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
