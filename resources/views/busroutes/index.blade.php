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
                    <th>No</th>
                    <th>Route Name</th>
                    <th>Day</th>
                    <th>Student No</th>
                    <th>Bus Needed</th>
                    <th>Seat Capacity</th>
                    <th>Standing</th>
                    <th>Total Capacity</th>
                </tr>
                </thead>
                <tbody>
                <?php $flag = 0; ?>
                @foreach($BusRoutes as $route)
                    <tr> <?php $bus = 0; $studentSum = 0; $seat = 0;?>
                        <td>{{$flag+=1}}</td>
                        <td>
                            <a href="/admin/auth/routes/{{$route->routeid}}">{{DB::table('routes')->where('id', $route->routeid)->first()->routename}}</a>
                        </td>
                        <td>{{DB::table('day')->where('id', $route->dayid)->first()->dayname}}</td>
                        <td>{{
                             $studentSum = DB::table('bus_student_information')
                            ->where('bus_student_information.id', $route->id)->first()->studentno
                            
                        }}
                            {{-- ->sum('bus_student_information.studentno') --}}
                        </td>
                        <td>
                            <?php $student = $studentSum; ?>
                            @if($studentSum/60 > 1)
                                <?php
                                $bus += round($studentSum / (60 * 1.15));
                                //$studentSum = $studentSum%75;
                                if ($studentSum > (60 * 1.15) * $bus && $studentSum % (60 * 1.15) > $bus * 2) {
                                    $bus += 1;
                                }
                                $seat = $bus * 60 * 0.15;
                                if ($student - ($bus * 60) > 60 * 0.35) {
                                    $bus += 1;
                                }
                                ?>
                                {{   
                                    $bus                                 
                                }}
                            @else
                                {{$bus += 1}}
                            @endif
                        </td>
                        <td>{{$bus*60}}</td>
                        <td>{{$bus*60*0.15}}</td>
                        <td>{{ ($bus*60*1) .' ('.$student.')'}}</td>
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