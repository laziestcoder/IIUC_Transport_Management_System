<h3>Teachers</h3>

@if(count($teachers)>0)
    <?php $sl = 0;?>
    <table class="table table-condensed table-hover table-responsive-lg">
        <thead class="table table-thead">
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
        </thead>
        <tbody class="table table-body">
        @foreach($teachers as $teacher)
            <tr>
                <td>
                    {!! $sl += 1 !!}
                </td>
                <td>
                    <img style="max-height: 80px; max-width: 80px;"
                         src="http://upanel.iiuc.ac.bd:81/Picture/{!! $teacher->jobid !!}"
                         alt="{!! $teacher->name !!}"/>
                </td>
                <td>
                    {!! $teacher->name !!}
                </td>
                <td>
                    {!! $teacher->email !!}
                </td>
                <td>
                    {!! $teacher->jobid !!}
                </td>
                <td>
                    {!! $teacher->gender?'Female':'Male' !!}
                </td>
                <td>
                    {!! $teacher->id !!}
                </td>
                <td>
                    {!! $teacher->created_at !!}
                </td>
                <td>
                    {!! $teacher->updated_at !!}
                </td>
                <td>
                    {!! $teacher->confirmed? 'YES':'NO' !!}
                </td>
                <td>
                    {!! $teacher->confirmation?'YES':'NO' !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <b>No Teacher Found</b>
@endif


<h3>Officers</h3>

@if(count($officers)>0)
    <?php $sl = 0;?>
    <table class="table table-condensed table-hover table-responsive-lg">
        <thead class="table table-thead">
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
        </thead>
        <tbody class="table table-body">
        @foreach($officers as $officer)
            <tr>
                <td>
                    {!! $sl += 1 !!}
                </td>
                <td>
                    <img style="max-height: 80px; max-width: 80px;"
                         src="http://upanel.iiuc.ac.bd:81/Picture/{!! $officer->jobid !!}"
                         alt="{!! $officer->name !!}"/>
                </td>
                <td>
                    {!! $officer->name !!}
                </td>
                <td>
                    {!! $officer->email !!}
                </td>
                <td>
                    {!! $officer->jobid !!}
                </td>
                <td>
                    {!! $officer->gender?'Female':'Male' !!}
                </td>
                <td>
                    {!! $officer->id !!}
                </td>
                <td>
                    {!! $officer->created_at !!}
                </td>
                <td>
                    {!! $officer->updated_at !!}
                </td>
                <td>
                    {!! $officer->confirmed? 'YES':'NO' !!}
                </td>
                <td>
                    {!! $officer->confirmation?'YES':'NO' !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <b>No Officers Found</b>
@endif