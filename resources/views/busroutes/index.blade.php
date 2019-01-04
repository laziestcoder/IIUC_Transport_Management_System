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
        @if($today)
            <h4 align="center">Tomorrow is <b>{!! $today !!}</b>. Tomorrow's Bus Requirement Information:</h4>
            <br>
            <a class="btn btn-success" target="_blank" href='/tomorrow-bus-requirement'>
                <i class="fa fa-print"></i> Print
            </a>
            @if(count($routes) > 0)
                <h4><b><big>{{"Female Students"}}</big></b></h4>
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
                        <th>Student No (Departure)</th>
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


                            {{--arrival time--}}

                            <td><?php

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
                        <td></td>
                        <td>Total</td>
                        <td>{{$stdArvTot}}</td>
                        <td>{{$busArvTot}}</td>
                        <td>{{$busSeatArvTot}}</td>
                        <td>{{$busStandArvTot}}</td>
                        <td>{{$busSeatArvTot+$busStandArvTot}}</td>
                        <td>{{$stdDepTot}}</td>
                        <td>{{$busDepTot}}</td>
                        <td>{{$busSeatDepTot}}</td>
                        <td>{{$busStandDepTot}}</td>
                        <td>{{$busSeatDepTot+$busStandDepTot}}</td>
                    </tr>
                    </tbody>
                </table>

                <h4><b><big>{{"Male Students"}}</big></b></h4>
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
                        <th>Student No (Departure)</th>
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
                        <td></td>
                        <td>Total</td>
                        <td>{{$stdArvTot}}</td>
                        <td>{{$busArvTot}}</td>
                        <td>{{$busSeatArvTot}}</td>
                        <td>{{$busStandArvTot}}</td>
                        <td>{{$busSeatArvTot+$busStandArvTot}}</td>
                        <td>{{$stdDepTot}}</td>
                        <td>{{$busDepTot}}</td>
                        <td>{{$busSeatDepTot}}</td>
                        <td>{{$busStandDepTot}}</td>
                        <td>{{$busSeatDepTot+$busStandDepTot}}</td>
                    </tr>
                    </tbody>
                </table>
            @else
                <p><h4>No routes found for today ! </h4></p>
            @endif
        @else
            <p><h4> No Data Found For Today!</h4></p>
        @endif


        <br>
        <h2> Here all day wise bus management information: </h2>
        @if(count($days) > 0)
            @if(count($routes) > 0)
                @foreach($days as $day)
                    <br>
                    <h3><b>{!!  $day->dayname !!}</b></h3>
                    <h5><b><big>{{"Female Students"}}</big></b></h5>
                    <table class="table table-responsive table-hover table-bordered table-condensed">
                        <thead class="table">
                        <tr>
                            <th>No</th>
                            <th>Route Name</th>
                            <th>Student No (Arrival)</th>
                            <th></th>
                            {{-- <th>Bus Needed</th>
                            <th>Seat Capacity</th>
                            <th>Standing</th>
                            <th>Total Capacity</th> --}}
                            <th>Student No (Departure)</th>
                            <th></th>
                            {{-- <th>Bus Needed</th>
                            <th>Seat Capacity</th>
                            <th>Standing</th>
                            <th>Total Capacity</th> --}}
                            
                        </tr>
                        </thead>
                        <tbody class="table" align="center">
                        <?php $flag = 0;
                        $stdArvTot = 0;
                        $busArvTot = 0;
                        $busSeatArvTot = 0;
                        $busStandArvTot = 0;
                        $busStandSeatArvTot = 0;
                        $stdDepTot = 0;
                        $busDepTot = 0;
                        $busSeatDepTot = 0;
                        $busStandDepTot = 0;
                        $busStandSeatDepTot = 0;
                        ?>
                        @foreach($routes as $route )
                            <tr>
                                <?php $bus = 0; $studentSum = 0; $seat = 0;?>
                                <td>{{$flag+=1}}</td>
                                <td>
                                    {{--<a href="/admin/auth/routes/{{$route->id}}">--}}
                                    {{$route->routename}}
                                    {{--</a>--}}
                                </td>


                                {{--arrival time--}}

                                <td>
                                    <?php
                                    //$routeID = ;
                                    $studentSum = DB::table('schedulestudent')
                                        ->where('pick_point_route', $route->id)
                                        ->where('day', $day->id)
                                        ->where('user_gender', true)
                                        ->get(); ?>
                                    {!! count($studentSum) !!}
                                </td>
                                <td></td>
                                {{-- <td> --}}
                                <?php
                                // $stdArvTot = $stdArvTot + count($studentSum);
                                // $studentSum = count($studentSum);
                                // $student = $studentSum;
                                // if ($student) {
                                //     $bus = 1;
                                // } else {
                                //     $bus = 0;
                                // }
                                ?>
                                {{-- @if((($studentSum/60) > 1) && ($studentSum > 0) ) --}}
                                <?php
                                // $bus += round($studentSum / (60 * 1.15));
                                // //$studentSum = $studentSum%75;
                                // if ($studentSum > (60 * 1.15) * $bus && $studentSum % (60 * 1.15) > $bus * 2) {
                                //     $bus += 1;
                                // }
                                // $seat = $bus * 60 * 0.15;
                                // if ($student - ($bus * 60) > 60 * 0.35) {
                                //     $bus += 1;
                                // }
                                ?>
                                {{-- {{
                                    $bus
                                }}
                            @else
                                {{$bus}}
                            @endif --}}
                                <?php
                                //$busArvTot = $busArvTot + $bus; 
                                ?>
                                {{-- </td> --}}
                                {{-- <td>{{$bus*60}}</td>  --}}
                                <?php
                                // $busSeatArvTot = $busSeatArvTot + ($bus * 60);
                                ?>
                                {{-- <td>{{$bus*60*0.15}}</td>  --}}
                                <?php
                                // $busStandArvTot = $busStandArvTot + $bus * 60 * 0.15; ?>
                                {{-- <td>{{ ($bus*60) .' ('.$student.')'}}</td> --}}


                                {{--departure time--}}
                                <td><?php
                                    $studentSum = DB::table('schedulestudent')
                                        ->where('drop_point_route', $route->id)
                                        ->where('day', $day->id)
                                        ->where('user_gender', true)
                                        ->get(); ?>
                                    {!! count($studentSum) !!}
                                </td>
                                <td></td>
                                {{-- <td> --}}
                                <?php
                                // $stdDepTot = $stdDepTot + count($studentSum);
                                // $studentSum = count($studentSum);
                                // $student = $studentSum;
                                // if ($student) {
                                // $bus = 1;
                                // } else {
                                // $bus = 0;
                                // }
                                ?>
                                {{-- @if((($studentSum/60) > 1) && ($studentSum > 0) ) --}}
                                <?php
                                // $bus += round($studentSum / (60 * 1.15));
                                // // $studentSum = $studentSum%75;
                                // if ($studentSum > (60 * 1.15) * $bus && $studentSum % (60 * 1.15) > $bus * 2) {
                                // $bus += 1;
                                // }
                                // $seat = $bus * 60 * 0.15;
                                // if ($student - ($bus * 60) > 60 * 0.35) {
                                // $bus += 1;
                                // }
                                ?>
                                {{-- {{
                                    $bus
                                }} --}}
                                {{-- @else
                                    {{$bus}}
                                @endif --}}
                                <?php
                                // $busDepTot = $busDepTot + $bus; 
                                ?>
                                {{-- </td> --}}
                                {{-- <td>{{$bus*60}}</td>  --}}
                                <?php
                                // $busSeatDepTot = $busSeatDepTot + ($bus * 60);
                                ?>
                                {{-- <td>{{$bus*60*0.15}}</td> --}}
                                <?php
                                // $busStandDepTot = $busStandDepTot + $bus * 60 * 0.15;
                                ?>
                                {{-- <td>{{ ($bus*60) .' ('.$student.')'}}</td> --}}
                            </tr>
                        @endforeach
                        {{-- <tr>
                            <td></td>
                            <td>Total</td>
                            <td>{{$stdArvTot}}</td>
                            <td>{{$busArvTot}}</td>
                            <td>{{$busSeatArvTot}}</td>
                            <td>{{$busStandArvTot}}</td>
                            <td>{{$busSeatArvTot+$busStandArvTot}}</td>
                            <td>{{$stdDepTot}}</td>
                            <td>{{$busDepTot}}</td>
                            <td>{{$busSeatDepTot}}</td>
                            <td>{{$busStandDepTot}}</td>
                            <td>{{$busSeatDepTot+$busStandDepTot}}</td>
                        </tr> --}}
                        </tbody>
                    </table>

                    <h5><b><big>{{"Male Students"}}</big></b></h5>
                    <table class="table table-responsive table-hover table-bordered table-condensed">
                        <thead class="table">
                        <tr>
                            <th>No</th>
                            <th>Route Name</th>
                            <th>Student No (Arrival)</th>
                            <th></th>
                            {{-- <th>Bus Needed</th>
                            <th>Seat Capacity</th>
                            <th>Standing</th>
                            <th>Total Capacity</th> --}}
                            <th>Student No (Departure)</th>
                            <th></th>
                            {{-- <th>Bus Needed</th>
                            <th>Seat Capacity</th>
                            <th>Standing</th>
                            <th>Total Capacity</th> --}}
                        </tr>
                        </thead>
                        <tbody class="table" align="center">
                        <?php $flag = 0;
                        $stdArvTot = 0;
                        $busArvTot = 0;
                        $busSeatArvTot = 0;
                        $busStandArvTot = 0;
                        $busStandSeatArvTot = 0;
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


                                {{--arrival time--}}

                                <td><?php
                                    //$routeID = ;
                                    $studentSum = DB::table('schedulestudent')
                                        ->where('pick_point_route', $route->id)
                                        ->where('day', $day->id)
                                        ->where('user_gender', false)
                                        ->get(); ?>
                                    {!! count($studentSum) !!}
                                </td>
                                <td></td>
                                {{-- <td> --}}
                                    <?php
                                    // $stdArvTot = $stdArvTot + count($studentSum);
                                    // $studentSum = count($studentSum);
                                    // $student = $studentSum;
                                    // if ($student) {
                                    //     $bus = 1;
                                    // } else {
                                    //     $bus = 0;
                                    // }
                                    ?>
                                    {{-- @if((($studentSum/60) > 1) && ($studentSum > 0) ) --}}
                                        <?php
                                        // $bus += round($studentSum / (60 * 1.15));
                                        // //$studentSum = $studentSum%75;
                                        // if ($studentSum > (60 * 1.15) * $bus && $studentSum % (60 * 1.15) > $bus * 2) {
                                        //     $bus += 1;
                                        // }
                                        // $seat = $bus * 60 * 0.15;
                                        // if ($student - ($bus * 60) > 60 * 0.35) {
                                        //     $bus += 1;
                                        // }
                                        ?>
                                        {{-- {{
                                            $bus
                                        }}
                                    @else
                                        {{$bus}}
                                    @endif --}}
                                    <?php 
                                    // $busArvTot = $busArvTot + $bus; ?>
                                {{-- </td> --}}
                                {{-- <td>{{$bus*60}}</td>  --}}
                                <?php 
                                // $busSeatArvTot = $busSeatArvTot + ($bus * 60); ?>
                                {{-- <td>{{$bus*60*0.15}}</td>  --}}
                                <?php 
                                // $busStandArvTot = $busStandArvTot + $bus * 60 * 0.15; ?>
                                {{-- <td>{{ ($bus*60) .' ('.$student.')'}}</td> --}}


                                {{--departure time--}}
                                <td><?php
                                    $studentSum = DB::table('schedulestudent')
                                        ->where('drop_point_route', $route->id)
                                        ->where('day', $day->id)
                                        ->where('user_gender', false)
                                        ->get(); ?>
                                    {!! count($studentSum) !!}
                                </td>
                                <td></td>
                                {{-- <td> --}}
                                    <?php
                                    // $stdDepTot = $stdDepTot + count($studentSum);
                                    // $studentSum = count($studentSum);
                                    // $student = $studentSum;
                                    // if ($student) {
                                    //     $bus = 1;
                                    // } else {
                                    //     $bus = 0;
                                    // }
                                    ?>
                                    {{-- @if((($studentSum/60) > 1) && ($studentSum > 0) ) --}}
                                        <?php
                                        // $bus += round($studentSum / (60 * 1.15));
                                        // //$studentSum = $studentSum%75;
                                        // if ($studentSum > (60 * 1.15) * $bus && $studentSum % (60 * 1.15) > $bus * 2) {
                                        //     $bus += 1;
                                        // }
                                        // $seat = $bus * 60 * 0.15;
                                        // if ($student - ($bus * 60) > 60 * 0.35) {
                                        //     $bus += 1;
                                        // }
                                        ?>
                                        {{-- {{
                                            $bus
                                        }}
                                    @else
                                        {{$bus}}
                                    @endif --}}
                                    <?php 
                                    // $busDepTot = $busDepTot + $bus; ?>
                                {{-- </td> --}}
                                {{-- <td>{{$bus*60}}</td>  --}}
                                <?php 
                                // $busSeatDepTot = $busSeatDepTot + ($bus * 60); ?>
                                {{-- <td>{{$bus*60*0.15}}</td> --}}
                                <?php 
                                // $busStandDepTot = $busStandDepTot + $bus * 60 * 0.15; ?>
                                {{-- <td>{{ ($bus*60) .' ('.$student.')'}}</td> --}}
                            </tr>
                        @endforeach
                        <tr>
                            {{-- <td></td>
                            <td>Total</td>
                            <td>{{$stdArvTot}}</td>
                            <td>{{$busArvTot}}</td>
                            <td>{{$busSeatArvTot}}</td>
                            <td>{{$busStandArvTot}}</td>
                            <td>{{$busSeatArvTot+$busStandArvTot}}</td>
                            <td>{{$stdDepTot}}</td>
                            <td>{{$busDepTot}}</td>
                            <td>{{$busSeatDepTot}}</td>
                            <td>{{$busStandDepTot}}</td>
                            <td>{{$busSeatDepTot+$busStandDepTot}}</td> --}}
                        </tr>
                        </tbody>
                    </table>
                @endforeach
            @else
                <p><h4>No Route Found!</h4></p>
            @endif
        @else
            <p><h4>No Data Found!</h4></p>
        @endif

    </section>
@endsection