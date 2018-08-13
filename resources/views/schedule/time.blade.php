@extends('admin::index')


@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>

    <section class="content-header">
        @include('inc.messages')
        <h1>
            {{$title}}
            <small>{{'Here you will get available bus time information. You can also add, remove and edit bus time.'}}
            </small>
        </h1>
    </section>
    <section class="content">

        <h3>{{$addtime}}
            <small>{{'Before you submit please change the time correctly.'}}
            </small>
        </h3>
        {{--Form Starts--}}

        {!! Form :: open(['action'=>'TimeController@store','method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
        <div class="form-group">
            {!! Form::time('time', \Carbon\Carbon::now()) !!} {{-- Time Picker --}}
        </div>
        <div class="form-group">
            {{Form :: label('title','Towards IIUC Campus')}}
            {{Form :: checkbox('toiiuc' , '1', ['class' => 'form-control', ])}}

        </div>
        <div class="form-group">
            {{Form :: label('title','From IIUC Campus')}}
            {{Form :: checkbox('fromiiuc' , '1', ['class' => 'form-control',])}}

        </div>
        {{ Form :: submit('Submit',['class' => 'btn btn-primary']) }}
        {!! Form::close() !!}

        {{--Form Ends--}}

    </section>
    <section class="content">
        <h3>{{$titleinfo}}
            <small>
                {{'Before delete a time please ensure the time is not used in any other data.'}}
            </small>
        </h3>
        @if( count($times) > 0 )
            <table class="table table-hover">
                <thead class="table">
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Time</th>
                    <th>To IIUC Campus</th>
                    <th>From IIUC Campus</th>
                    <th>Added By</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="table">
                <?php $flag = 0; ?>
                @foreach($times as $time)
                    <tr>
                        <td>{{$flag+=1}}</td>
                        <td>{{$time->id}}</td>
                        <td>{{Carbon\Carbon::parse($time->time)->format('g:i A')}}</td>
                        <td>{{$time->toiiuc? 'YES':'NO'}}</td>
                        <td>{{$time->fromiiuc?'YES':'NO'}}</td>
                        <td>{{DB::table('admin_users')->where('id', $time->user_id)->first()->name}}</td>
                        <td>
                            {{--<a href="/admin/auth/schedule/time/{{$time->id}}/edit" class="btn btn-default">Edit</a>--}}
                            {!! Form::open(['action' => ['TimeController@destroy', $time->id], 'method' => 'POST', 'class' => 'pull','id' =>'delete','style'=>'display:inline'  /* ,'onclick' => 'function deleteMe()' */  ]) !!} {{-- 'onclick' => 'return confirm("Are you sure?")' --}}
                            {{Form::hidden('_method','DELETE')}}
                            {{ csrf_field() }}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle'=>'confirmation','data-placement'=>'top']) }}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$times->links()}}
        @else
            <h3>No Time Found</h3>
        @endif
    </section>

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
@endsection