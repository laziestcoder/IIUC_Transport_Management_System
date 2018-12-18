@extends('printPDF.layout')
@section('headline')
    <h4 align="center"><b>{!! $today !!}</b>'s Bus Requirement Information</h4>
@endsection
@section('content')
    <div style="text-align:center; margin: auto; font-size: 12px; ">
        @if($today)
            <a class="btn btn-default"
               href="{{ route('tomorrow-bus-requirement',['download' => 'pdf'],['title' => 'Print Bus Requirement Information']) }}">
                <i class="fa fa-print"></i> PDF/Print </a>
            @if(count($routes) > 0)
                <h4><b><big>{{"Female Students"}}</big></b></h4>{{"Arrival"}}
                <table class="table table-hover table-bordered table-responsive table-condensed">
                    <thead class="table">
                    <tr>
                        <th>No</th>
                        <th>Route Name</th>
                        <th>Student No (Arrival)</th>
                        <th>Bus Needed</th>
                        <th>Seat Capacity</th>
                        <th>Standing</th>
                        <th>Total Capacity</th>
                    </tr>
                    </thead>
                    <tbody class="table" align="center">
                    <?php $flag = 0;
                    $stdArvTot = 0;
                    $busArvTot = 0;
                    $busSeatArvTot = 0;
                    $busStandArvTot = 0;
                    $busStandSeatArvTot = 0;
                    ?>
                    @foreach($routes as $route)
                        <tr> <?php $bus = 0; $studentSum = 0; $seat = 0;?>
                            <td>{{$flag+=1}}</td>
                            <td>
                                {{--<a href="/admin/auth/routes/{{$route->id}}">--}}
                                {{$route->routename}}
                                {{--</a>--}}
                            </td>


                            {{--arrival time--}}

                            <td><?php
                                //$routeID = ;
                                $studentSum = DB::table('schedulestudent')
                                    ->where('pick_point_route', $route->id)
                                    ->where('day', $todayid->id)
                                    ->where('user_gender', true)
                                    ->get(); ?>
                                {!! count($studentSum) !!}
                            </td>
                            <td>
                                <?php
                                $stdArvTot = $stdArvTot + count($studentSum);
                                $studentSum = count($studentSum);
                                $student = $studentSum;
                                if ($student) {
                                    $bus = 1;
                                } else {
                                    $bus = 0;
                                }?>
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
                                <?php $busArvTot = $busArvTot + $bus; ?>
                            </td>
                            <td>{{$bus*60}}</td> <?php $busSeatArvTot = $busSeatArvTot + ($bus * 60); ?>
                            <td>{{$bus*60*0.15}}</td> <?php $busStandArvTot = $busStandArvTot + $bus * 60 * 0.15; ?>
                            <td>{{ ($bus*60) .' ('.$student.')'}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>{{$flag+1}}</td>
                        <td>Total</td>
                        <td>{{$stdArvTot}}</td>
                        <td>{{$busArvTot}}</td>
                        <td>{{$busSeatArvTot}}</td>
                        <td>{{$busStandArvTot}}</td>
                        <td>{{$busSeatArvTot+$busStandArvTot}}</td>
                    </tr>
                    </tbody>
                </table>
                {{"Departure"}}
                <table class="table table-hover table-responsive table-bordered table-condensed">
                    <thead class="table">
                    <tr>
                        <th>No</th>
                        <th>Route Name</th>
                        <th>Student No (Departure)</th>
                        <th>Bus Needed</th>
                        <th>Seat Capacity</th>
                        <th>Standing</th>
                        <th>Total Capacity</th>
                    </tr>
                    </thead>
                    <tbody class="table" align="center">
                    <?php $flag = 0;
                    $stdDepTot = 0;
                    $busDepTot = 0;
                    $busSeatDepTot = 0;
                    $busStandDepTot = 0;
                    $busStandSeatDepTot = 0;
                    ?>
                    @foreach($routes as $route)
                        <tr> <?php $bus = 0; $studentSum = 0; $seat = 0;?>
                            <td>{{$flag+=1}}</td>
                            <td>
                                {{--<a href="/admin/auth/routes/{{$route->id}}">--}}
                                {{$route->routename}}
                                {{--</a>--}}
                            </td>
                            {{--departure time--}}
                            <td><?php
                                $studentSum = DB::table('schedulestudent')
                                    ->where('drop_point_route', $route->id)
                                    ->where('day', $todayid->id)
                                    ->where('user_gender', true)
                                    ->get(); ?>
                                {!! count($studentSum) !!}
                            </td>
                            <td>
                                <?php
                                $stdDepTot = $stdDepTot + count($studentSum);
                                $studentSum = count($studentSum);
                                $student = $studentSum;
                                if ($student) {
                                    $bus = 1;
                                } else {
                                    $bus = 0;
                                }
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
                                    {{
                                        $bus
                                    }}
                                @else
                                    {{$bus}}
                                @endif
                                <?php $busDepTot = $busDepTot + $bus; ?>
                            </td>
                            <td>{{$bus*60}}</td> <?php $busSeatDepTot = $busSeatDepTot + ($bus * 60); ?>
                            <td>{{$bus*60*0.15}}</td><?php $busStandDepTot = $busStandDepTot + $bus * 60 * 0.15; ?>
                            <td>{{ ($bus*60) .' ('.$student.')'}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>{{$flag+1}}</td>
                        <td>Total</td>
                        <td>{{$stdDepTot}}</td>
                        <td>{{$busDepTot}}</td>
                        <td>{{$busSeatDepTot}}</td>
                        <td>{{$busStandDepTot}}</td>
                        <td>{{$busSeatDepTot+$busStandDepTot}}</td>
                    </tr>
                    </tbody>
                </table>

                <h4><b><big>{{"Male Students"}}</big></b></h4>
                {{"Arrival"}}
                <table class="table table-responsive table-hover table-bordered table-condensed">
                    <thead class="table">
                    <tr>
                        <th>No</th>
                        <th>Route Name</th>
                        <th>Student No (Arrival)</th>
                        <th>Bus Needed</th>
                        <th>Seat Capacity</th>
                        <th>Standing</th>
                        <th>Total Capacity</th>
                    </tr>
                    </thead>
                    <tbody class="table" align="center">
                    <?php $flag = 0;
                    $stdArvTot = 0;
                    $busArvTot = 0;
                    $busSeatArvTot = 0;
                    $busStandArvTot = 0;
                    $busStandSeatArvTot = 0;
                    ?>
                    @foreach($routes as $route)
                        <tr> <?php $bus = 0; $studentSum = 0; $seat = 0;?>
                            <td>{{$flag+=1}}</td>
                            <td>
                                {{--<a href="/admin/auth/routes/{{$route->id}}">--}}
                                {{$route->routename}}
                                {{--</a>--}}
                            </td>


                            {{--arrival time--}}

                            <td><?php
                                //$routeID = ;
                                $studentSum = DB::table('schedulestudent')
                                    ->where('pick_point_route', $route->id)
                                    ->where('day', $todayid->id)
                                    ->where('user_gender', false)
                                    ->get(); ?>
                                {!! count($studentSum) !!}
                            </td>
                            <td>
                                <?php
                                $stdArvTot = $stdArvTot + count($studentSum);
                                $studentSum = count($studentSum);
                                $student = $studentSum;
                                if ($student) {
                                    $bus = 1;
                                } else {
                                    $bus = 0;
                                }?>
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
                                <?php $busArvTot = $busArvTot + $bus; ?>
                            </td>
                            <td>{{$bus*60}}</td> <?php $busSeatArvTot = $busSeatArvTot + ($bus * 60); ?>
                            <td>{{$bus*60*0.15}}</td> <?php $busStandArvTot = $busStandArvTot + $bus * 60 * 0.15; ?>
                            <td>{{ ($bus*60) .' ('.$student.')'}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>{{$flag+1}}</td>
                        <td>Total</td>
                        <td>{{$stdArvTot}}</td>
                        <td>{{$busArvTot}}</td>
                        <td>{{$busSeatArvTot}}</td>
                        <td>{{$busStandArvTot}}</td>
                        <td>{{$busSeatArvTot+$busStandArvTot}}</td>
                    </tr>
                    </tbody>
                </table>
                {{"Departure"}}
                <table class="table table-responsive table-hover table-bordered table-condensed">
                    <thead class="table">
                    <tr>
                        <th>No</th>
                        <th>Route Name</th>
                        <th>Student No (Departure)</th>
                        <th>Bus Needed</th>
                        <th>Seat Capacity</th>
                        <th>Standing</th>
                        <th>Total Capacity</th>
                    </tr>
                    </thead>
                    <tbody class="table" align="center">
                    <?php $flag = 0;
                    $stdDepTot = 0;
                    $busDepTot = 0;
                    $busSeatDepTot = 0;
                    $busStandDepTot = 0;
                    $busStandSeatDepTot = 0;
                    ?>
                    @foreach($routes as $route)
                        <tr> <?php $bus = 0; $studentSum = 0; $seat = 0;?>
                            <td>{{$flag+=1}}</td>
                            <td>
                                {{--<a href="/admin/auth/routes/{{$route->id}}">--}}
                                {{$route->routename}}
                                {{--</a>--}}
                            </td>
                            {{--departure time--}}
                            <td><?php
                                $studentSum = DB::table('schedulestudent')
                                    ->where('drop_point_route', $route->id)
                                    ->where('day', $todayid->id)
                                    ->where('user_gender', false)
                                    ->get(); ?>
                                {!! count($studentSum) !!}
                            </td>
                            <td>
                                <?php
                                $stdDepTot = $stdDepTot + count($studentSum);
                                $studentSum = count($studentSum);
                                $student = $studentSum;
                                if ($student) {
                                    $bus = 1;
                                } else {
                                    $bus = 0;
                                }
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
                                    {{
                                        $bus
                                    }}
                                @else
                                    {{$bus}}
                                @endif
                                <?php $busDepTot = $busDepTot + $bus; ?>
                            </td>
                            <td>{{$bus*60}}</td> <?php $busSeatDepTot = $busSeatDepTot + ($bus * 60); ?>
                            <td>{{$bus*60*0.15}}</td><?php $busStandDepTot = $busStandDepTot + $bus * 60 * 0.15; ?>
                            <td>{{ ($bus*60) .' ('.$student.')'}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>{{$flag+1}}</td>
                        <td>Total</td>
                        <td>{{$stdDepTot}}</td>
                        <td>{{$busDepTot}}</td>
                        <td>{{$busSeatDepTot}}</td>
                        <td>{{$busStandDepTot}}</td>
                        <td>{{$busSeatDepTot+$busStandDepTot}}</td>
                    </tr>
                    </tbody>
                </table>
            @else
                <p><h4>No routes found for today ! :( </h4></p>
            @endif
        @else
            <p><h4> No Data Fount For Today!</h4></p>
        @endif
    </div>
    <br>
@endsection

