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

        <h3>{{$newday}}
            <small>{{'Before you submit please change the time correctly.'}}
            </small>
        </h3>
        {{--Form Starts--}}

        {!! Form :: open(['action'=>'DayController@store','method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
        <div class="form-group">
            {{Form :: label('title','Write Day Name :')}}
            {!! Form::text('day', \Carbon\Carbon::now()->format('l')) !!}{{-- Time Picker --}}
        </div>
        {{ Form :: submit('Submit',['class' => 'btn btn-primary']) }}
        {!! Form::close() !!}

        {{--Form Ends--}}

    </section>
    <section class="content">
        <h3>{{$titleinfo}}
            <small>
                {{'Before delete a day please ensure the day is not used in any other data.'}}
            </small>
        </h3>
        @if( count($days) > 0 )
            <table class="table table-hover table-responsive-lg">
                <thead class="table">
                <tr>
                    <th>No</th>
                    <th>Day</th>
                    <th>Day ID</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="table">
                <?php $flag = 0; ?>
                @foreach($days as $day)
                    <tr>
                        <td>{{$flag+=1}}</td>
                        <td>{{$day->dayname}}</td>
                        <td>{{$day->id}}</td>
                        <td>
                            {{--<a href="/admin/auth/schedule/time/{{$time->id}}/edit" class="btn btn-default">Edit</a>--}}
                            {!! Form::open(['action' => ['DayController@destroy', $day->id], 'method' => 'POST', 'class' => 'pull','id' =>'delete','style'=>'display:inline'  /* ,'onclick' => 'function deleteMe()' */  ]) !!} {{-- 'onclick' => 'return confirm("Are you sure?")' --}}
                            {{Form::hidden('_method','DELETE')}}
                            {{ csrf_field() }}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger', 'data-toggle'=>'confirmation','data-placement'=>'top']) }}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$days->links()}}
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