@extends('admin::index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">CSV Import</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('import_parse') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                                <label for="csv_file" class="col-md-4 control-label">CSV file to import</label>

                                <div class="col-md-6">
                                    <input id="csv_file" type="file" class="form-control" name="csv_file" required>

                                    @if ($errors->has('csv_file'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('csv_file') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('model_name') ? ' has-error' : '' }}">
                                <label for="table_name" class="col-md-4 control-label">Select Table Name:</label>

                                <div class="col-md-6">
                                    <select id="model_name" name="model_name" required>
                                        <option value="">{{ "Select Table Name" }}</option>
                                        @foreach ($models as $model)
                                            <option value="{{ $model->model_name }}">{{ $model->table_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('model_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('model_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="header" checked> File contains header row?
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Parse CSV
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{--@foreach($allModels as $models)--}}
                    {{--<br>--}}

                    {{--case '{{$models}}':--}}
                    {{--$entry_data = new {{$models}}();--}}
                    {{--break;--}}
                {{--@endforeach--}}
                </div>
            </div>

    </div>

@endsection
