@extends('admin::index')
@section('content')
    <section class="content-header">
        @include('inc.messages')
        <h1>
            {{$title}}
            <small>{{$smallTitle}}</small>
        </h1>
    </section>
    <section class="content">
        <h1>{{$titleinfo}}</h1>
        <br>
        @if($today)
            <h4>Today is <b>{!! $today !!}</b>. Today's Bus Management Information:</h4>
            <br>

            @if(count($routes) > 0)
                <table class="table table-hover">
                    <thead class="table">
                    <tr>
                        <th>No</th>
                        <th>Route Name</th>
                        <th>Student No</th>
                        <th>Bus Needed</th>
                        <th>Seat Capacity</th>
                        <th>Standing</th>
                        <th>Total Capacity</th>
                    </tr>
                    </thead>
                    <tbody class="table">
                    <?php $flag = 0; ?>
                    @foreach($routes as $route)
                        <tr> <?php $bus = 0; $studentSum = 0; $seat = 0;?>
                            <td>{{$flag+=1}}</td>
                            <td>
                                <a href="/admin/auth/routes/{{$route->id}}">{{$route->routename}}</a>
                            </td>
                            <td><?php $studentSum = DB::table('bus_student_information')
                                    ->where('routeid', $route->id)
                                    ->where('dayid', $todayid->id)
                                    ->get(); ?>
                                {!! count($studentSum) !!}
                            </td>
                            <td>
                                <?php
                                $studentSum = count($studentSum);
                                $student = $studentSum; ?>
                                @if((($studentSum/60) > 1) && ($studentSum > 0) )
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
                                    {{$bus}}
                                @endif
                            </td>
                            <td>{{$bus*60}}</td>
                            <td>{{$bus*60*0.15}}</td>
                            <td>{{ ($bus*60*1) .' ('.$student.')'}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p><h4>No routes found for today ! :( </h4></p>
            @endif
        @else
            <p><h4> No Data Fount For Today!</h4></p>
        @endif


        <br>
        <h3> Here all day wise bus management information: </h3>
        @if(count($routes) > 0)
            @foreach($days as $day)
                <br>
                <h4><b>{!!  $day->dayname !!}</b></h4>
                <br>
                <table class="table table-hover">
                    <thead class="table">
                    <tr>
                        <th>No</th>
                        <th>Route Name</th>
                        <th>Student No</th>
                        <th>Bus Needed</th>
                        <th>Seat Capacity</th>
                        <th>Standing</th>
                        <th>Total Capacity</th>
                    </tr>
                    </thead>
                    <tbody class="table">
                    <?php $flag = 0; ?>
                    @foreach($routes as $route)
                        <tr> <?php $bus = 0;  $studentSum = 0; $seat = 0;?>
                            <td>{{$flag+=1}}</td>
                            <td>
                                <a href="/admin/auth/routes/{{$route->id}}">{{$route->routename}}</a>
                            </td>
                            <td><?php $studentSum = DB::table('bus_student_information')
                                    ->where('routeid', $route->id)
                                    ->where('dayid', $day->id)
                                    ->get(); ?>
                                {!! count($studentSum) !!}
                            </td>
                            <td>
                                <?php
                                $studentSum = count($studentSum);
                                $student = $studentSum;
                                ?>

                                @if((($studentSum/60) > 1) && ($studentSum > 0) )
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
                                    {!! $bus !!}
                                @else
                                    {!! $bus !!}
                                @endif
                            </td>
                            <td>{{$bus*60}}</td>
                            <td>{{$bus*60*0.15}}</td>
                            <td>{{ ($bus*60*1) .' ('.$student.')'}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endforeach
        @else
            <p><h4>No information found</h4></p>
        @endif

        {{--  @include('admin::partials.error')
         @include('admin::partials.success')
         @include('admin::partials.exception')
         @include('admin::partials.toastr') --}}
        {{-- {!! $content !!} --}}
    </section>
@endsection