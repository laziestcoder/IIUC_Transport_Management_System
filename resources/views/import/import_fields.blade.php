@extends('admin::index')

@section('content')
    {{--<div class="container">--}}
    {{--<div class="row" >--}}
    {{--<div class="col-md-12 col-md-offset-2">--}}
    <div class="panel panel-default" style="overflow: scroll;">
        <div class="panel panel-heading">CSV Import</div>
        <div class="panel panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('import_process') }}">
                {{ csrf_field() }}
                <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}"/>
                <input type="hidden" name="csv_data_file_name" value="{!! $csv_table_name !!}"/>
                <input type="hidden" name="model_name" value="{!! $model_name !!}"/>

                <table class="table table-condensed table-responsive-sm">
                    <thead class="table">
                    <th> Table Name: {!! $csv_table_name !!}</th>
                    <th> Model Name: {!! $model_name !!}</th>
                    <th></th>
                    </thead>
                    @if (isset($csv_header_fields))
                        <thead class="table">
                        @foreach ($csv_header_fields as $csv_header_field)
                            <th>{{ $csv_header_field }}</th>
                        @endforeach
                        </thead>
                    @endif
                    <tbody class="table">
                    @foreach ($csv_data as $row)
                        <tr>
                            @foreach ($row as $key => $value)
                                <td>{{ $value }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    <tr>
                        @foreach ($csv_data[0] as $key => $value)
                            <td>
                                <select name="fields[{{ $key }}]">
                                    @foreach ($field_names as $db_field)
                                        <option value="{{ (\Request::has('header')) ? $db_field : $loop->index }}"
                                                @if ($key === $db_field) selected @endif
                                        >{{ $db_field }}</option>
                                    @endforeach
                                </select>
                            </td>
                        @endforeach
                    </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">
                    Import Data
                </button>
            </form>
        </div>
    </div>
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
@endsection
