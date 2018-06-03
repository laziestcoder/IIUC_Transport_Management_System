@extends('admin::index')


@section('content')
    <section class="content-header">
        @include('inc.messages')
        <h1>
            {{$title}}
            <small>{{'Here you will get available route information. You can also add, remove and edit Bus Routes.'}}</small>
        </h1>
    </section>
    <br><br>
    <section class="content">
            <h1>{{$titleinfo}}</h1>
        @if(count($BusRoutes) > 0)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Serial No</th>
                        <th>Route Name</th>
                        <th>Day</th>
                        <th>Student No</th>
                        <th>Bus No</th>
                    </tr>
                </thead>
                <tbody>
                <?php $flag = 0; ?>
                @foreach($BusRoutes as $route)
                    <tr> <?php $bus = 1; ?>  
                        <td>{{$flag+=1}}</td>
                        <td><a href="/admin/auth/routes/{{$route->routeid}}">{{$route->$routename}}</a></td>
                        <td>{{DB::table('day')->where('id', $route->dayid)->first()->dayname}}</td>
                        <td>{{$studentSum = DB::table('bus_student_information')
                            ->where('bus_student_information.routeid', '=', $route->routeid)
                            ->sum('bus_student_information.studentno')}}</td>
                        <td>
                            @if($studentSum/60 > 1)
                                {{$bus = $bus + ($studentSum/60)}}
                            @else
                                {{$bus}}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                {{$BusRoutes->links()}}    
        @else
            <p>No information found</p>
        @endif

           {{--  @include('admin::partials.error')
            @include('admin::partials.success')
            @include('admin::partials.exception')
            @include('admin::partials.toastr') --}}
            {{-- {!! $content !!} --}}
    </section>
@endsection