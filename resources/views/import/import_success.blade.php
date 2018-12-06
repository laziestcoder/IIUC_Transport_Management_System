@extends('admin::index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">CSV Import</div>

                    <div class="panel-body">
                        Data imported successfully.<br>
                        Model: {{$model}} <br>
                        Table: {{$table}} <br>
                        {{--@foreach($allModels as $models)--}}
                            {{--<br>--}}
                            {{--{{$models}}--}}
                        {{--@endforeach--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
