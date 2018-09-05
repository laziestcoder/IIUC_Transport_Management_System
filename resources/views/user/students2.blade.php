@extends('admin::index')

@section('content')
    <section class="content-header">
        <h1>
            {{ $header or trans('admin.title') }}
            <small>{{ $description or trans('admin.description') }}</small>
        </h1>

    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="pull-right">
                            <div class="btn-group pull-right" style="margin-right: 10px">
                                <a class="btn btn-sm btn-twitter"><i class="fa fa-download"></i> Export</a>
                                <button type="button" class="btn btn-sm btn-twitter dropdown-toggle"
                                        data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/admin/auth/students?_export_=all" target="_blank">All</a></li>
                                    <li><a href="/admin/auth/students?_export_=page%3A1" target="_blank">Current
                                            page</a></li>
                                    <li><a href="/admin/auth/students?_export_=selected%3A__rows__" target="_blank"
                                           class='export-selected'>Selected rows</a></li>
                                </ul>
                            </div>
                            &nbsp;&nbsp;


                        </div>

                        <span>
                        <a class="btn btn-sm btn-primary grid-refresh"><i class="fa fa-refresh"></i> Refresh</a>
                        </span>
                        <h3 class="box-title">Students</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">

                        {{--my codes--}}


                        @if(count($students)>0)
                            <?php $sl = 0;?>
                            <table class="table table-responsive table-hover">
                                {{--<thead class="table">--}}
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Photo
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Varsity ID
                                    </th>
                                    <th>
                                        Gender
                                    </th>
                                    <th>
                                        Databse ID
                                    </th>
                                    <th>
                                        Joined Date
                                    </th>
                                    <th>
                                        Last Updated
                                    </th>
                                    <th>
                                        Activated
                                    </th>
                                    <th>
                                        Verified
                                    </th>
                                </tr>
                                {{--</thead>--}}
                                <tbody class="table">
                                @foreach($students as $student)
                                    <?php $file = false;?>
                                    @if($student->jobid != 'C111111' && $sl <1 )
                                        <?php
                                        //                        $url = 'http://upanel.iiuc.ac.bd:81/Picture/' . $student->jobid;
                                        //                        $file_headers = @get_headers($url);
                                        //                        if ($file_headers[0] == 'HTTP/ 404 Not Found') { // or "HTTP/1.1 404 Not Found" etc.
                                        //                            $file = false;
                                        //                        } else {
                                        //                            $file = true;
                                        //                        }
                                        ?>
                                        <?php
                                        //                        $file_headers = file('http://upanel.iiuc.ac.bd:81/Picture/' . $student->jobid);
                                        //                        if ($file_headers == 'HTTP/1.1 404 Not Found') { // or "HTTP/1.1 404 Not Found" etc.
                                        //                            $file = false;
                                        //                        } else {
                                        //                            $file = true;
                                        //                        }
                                        ?>
                                        <?php
                                        // Set the URL you want to connect to
                                        $url = 'http://upanel.iiuc.ac.bd:81/Picture/' . $student->jobid . '.jpg';
                                        // Check to see if the file exists by trying to open it for read only
                                        if (fopen($url, "r")) {
                                            $file = true;
                                        } else {
                                            $file = false;
                                        }
                                        ?>
                                    @endif

                                    <tr>
                                        <td>
                                            {!! $sl += 1 !!}
                                        </td>
                                        <td>
                                            @if ($file)
                                                <img style="max-height: 80px; max-width: 80px;"
                                                     src="http://upanel.iiuc.ac.bd:81/Picture/{!! $student->jobid !!}"
                                                     alt="{!! $student->name !!}"/>
                                            @else
                                                <img style="max-height: 80px; max-width: 80px;"
                                                     src="/storage/image/user/{{$student->image}}"
                                                     alt="{!! $student->name !!}"/>

                                            @endif
                                            {!! $file !!}

                                        </td>
                                        <td>
                                            {!! $student->name !!}
                                        </td>
                                        <td>
                                            {!! $student->email !!}
                                        </td>
                                        <td>
                                            {!! $student->jobid !!}
                                        </td>
                                        <td>
                                            {!! $student->gender?'Female':'Male' !!}
                                        </td>
                                        <td>
                                            {!! $student->id !!}
                                        </td>
                                        <td>
                                            {!! $student->created_at !!}
                                        </td>
                                        <td>
                                            {!! $student->updated_at !!}
                                        </td>
                                        <td>
                                            {!! $student->confirmed? 'YES':'NO' !!}
                                        </td>
                                        <td>
                                            {!! $student->confirmation?'YES':'NO' !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <b>No Student Found</b>
                        @endif
                    </div>
                    <div class="box-footer clearfix">

                        {{--Showing <b>1</b> to <b>4</b> of <b>4</b> entries--}}
                        {{--<ul class="pagination pagination-sm no-margin pull-right">--}}
                            {{--<!-- Previous Page Link -->--}}
                            {{--<li class="page-item"><span class="page-link">&laquo;</span></li>--}}

                            {{--<!-- Pagination Elements -->--}}
                            {{--<!-- "Three Dots" Separator -->--}}

                            {{--<!-- Array Of Links -->--}}
                            {{--<li class="page-item active"><span class="page-link">1</span></li>--}}

                            {{--<!-- Next Page Link -->--}}
                            {{--<li class="page-item"><span class="page-link">&raquo;</span></li>--}}
                        {{--</ul>--}}

                        {{--<label class="control-label pull-right" style="margin-right: 10px; font-weight: 100;">--}}

                            {{--<small>Show</small>&nbsp;--}}
                            {{--<select class="input-sm grid-per-pager" name="per-page">--}}
                                {{--<option value="http://itms.project/admin/auth/users?per_page=10">10</option>--}}
                                {{--<option value="http://itms.project/admin/auth/users?per_page=20" selected>20</option>--}}
                                {{--<option value="http://itms.project/admin/auth/users?per_page=30">30</option>--}}
                                {{--<option value="http://itms.project/admin/auth/users?per_page=50">50</option>--}}
                                {{--<option value="http://itms.project/admin/auth/users?per_page=100">100</option>--}}
                            {{--</select>--}}
                            {{--&nbsp;<small>entries</small>--}}
                        {{--</label>--}}

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

        {{-- my codes ends--}}

        @include('admin::partials.error')
        @include('admin::partials.success')
        @include('admin::partials.exception')
        @include('admin::partials.toastr')


    </section>
@endsection