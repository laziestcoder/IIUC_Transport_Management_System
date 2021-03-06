@extends('printPDF.layout')
@section('headline')
    <h4 align="center"><b>{!! $today !!}</b>'s Bus Requirement Information</h4>
@endsection
@section('content')
    <div style="text-align:center; margin: auto; font-size: 11px; ">
        @if($today)
            <a class="btn btn-default"
               href="{{ route('tomorrow-bus-requirement',['download' => 'pdf'],['title' => 'Print Bus Requirement Information']) }}">
                <i class="fa fa-print"></i> PDF/Print </a>
            @if(count($routes) > 0)
                <h4><b><big>{{"Female Students"}}</big></b></h4>{{"Arrival"}}
                <?php
                $busInfo = DB::table('businfo')->where('availability', '=', 0)
                    ->update(array('availability' => 1));

                ?>
                <table class="table table-hover table-bordered table-responsive table-condensed">
                    <thead class="table">
                    <tr>
                        <th>No</th>
                        <th>Route Name</th>
                        <th> No of Students</th>
                        <th>Bus Needed</th>
                        <th>Seat Capacity</th>
                        <th>Alloted Bus</th>
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
                            <td>
                                {{-- serial number --}}
                                {{$flag+=1}}
                            </td>
                            <td>
                                {{-- route name --}}
                                {{--<a href="/admin/auth/routes/{{$route->id}}">--}}
                                {{$route->routename}}
                                {{--</a>--}}
                            </td>


                            {{--arrival time--}}

                            <td>
                                {{-- student number --}}
                                <?php
                                //$routeID = ;
                                $studentSum = DB::table('schedulestudent')
                                    ->where('pick_point_route', $route->id)
                                    ->where('day', $todayid->id)
                                    ->where('user_gender', true)
                                    ->get(); ?>
                                {!! count($studentSum)!!}
                            </td>
                            <td>
                                <?php
                                $stdArvTot = $stdArvTot + count($studentSum);
                                $studentSum = count($studentSum);
                                $student = $studentSum; // 645 ;
                                $totalCapacity = 0;
                                $enough = true;
                                $bus_number = array();
                                $bus_id = array();
                                $busIdNo = 0;
                                $count = 0;
                                while ($student > 0 && $enough) {
                                    $bus_available = App\BusInfo::orderBy('seat', 'desc')
                                        ->where('active', 1)
                                        ->where('availability', 1)
                                        ->where('seat', '<=', $student)
                                        ->get()->first();

                                    if (isset($bus_available)) {
                                        //echo "1";
                                        //echo $bus_available->seat;
                                        $student = $student - $bus_available->seat;
                                        $totalCapacity += $bus_available->seat;
                                        if (!isset($bus_number[$bus_available->seat])) {
                                            $bus_number[$bus_available->seat] = 1;
                                            
                                        } else {
                                            $bus_number[$bus_available->seat] += 1;
                                        }
                                        $bus_id[$busIdNo] = $bus_available->busid;
                                        $busIdNo += 1;
                                        $id = $bus_available->id;
                                        BusNotAvailable($id);
                                    } else {
                                        $bus_available = App\BusInfo::orderBy('seat', 'asc')
                                            ->where('active', 1)
                                            ->where('availability', 1)
                                            ->where('seat', '>=', $student)
                                            ->get()->first();
                                        if (isset($bus_available)) {
                                            //echo "2";
                                            //echo $bus_available->seat;
                                            $student = $student - $bus_available->seat;
                                            $totalCapacity += $bus_available->seat;
                                            if (!isset($bus_number[$bus_available->seat])) {
                                                $bus_number[$bus_available->seat] = 1;
                                            } else {
                                                $bus_number[$bus_available->seat] += 1;
                                            }
                                            $bus_id[$busIdNo] = $bus_available->busid;
                                        $busIdNo += 1;
                                            $id = $bus_available->id;
                                            BusNotAvailable($id);
                                        } else {
                                            $enough = false;
                                        }

                                    }
                                }
                                ?>


                                @if(count($bus_number)>0)
                                    @foreach ($bus_number as $seatNo => $busNo )
                                        {{$busNo}}{{'x'}}{{$seatNo}}
                                    @endforeach
                                    @if(!$enough) {{"Not Enough Bus"}} @endif
                                @else
                                    {{0}}
                                @endif
                                <?php $busArvTot = $busArvTot + $bus; ?>
                            </td>
                            <td>
                                {{-- seat capacity --}}
                                {{$totalCapacity}}
                            </td>
                            <td>
                               {{-- Alloted Bus ID --}}
                               <?php
                               $comma = count($bus_id);
                                   foreach ($bus_id as $busIdNumber)
                                   {
                                       echo $busIdNumber;
                                       $comma--;
                                       if($comma)
                                       echo ", ";
                                       else
                                       echo ".";
                                   }                                
                               ?>
                        </td> 
                            <?php
                            $busSeatArvTot = $busSeatArvTot + $totalCapacity;
                            foreach ($bus_number as $seatNo => $busNo) {
                                $busArvTot = $busArvTot + $busNo;
                            }

                            ?>

                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td>{{$stdArvTot}}</td>
                        <td>{{$busArvTot}}</td>
                        <td>{{$busSeatArvTot}}</td>
                        <td></td>

                    </tr>
                    </tbody>
                </table>
                {{"Departure"}}
                <?php
                $busInfo = DB::table('businfo')->where('availability', '=', 0)
                    ->update(array('availability' => 1));

                ?>
                <table class="table table-hover table-responsive table-bordered table-condensed">
                    <thead class="table">
                    <tr>
                        <th>No</th>
                        <th>Route Name</th>
                        <th>No of Students</th>
                        <th>Bus Needed</th>
                        <th>Seat Capacity</th>
                        <th>Alloted Bus</th>
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
                                $student = $studentSum; // 645;
                                $totalCapacity = 0;
                                $enough = true;
                                $bus_number = array();
                                $bus_id = array();
                                $busIdNo = 0;
                                while ($student > 0 && $enough) {
                                    $bus_available = App\BusInfo::orderBy('seat', ' desc')
                                        ->where('active', 1)
                                        ->where('availability', 1)
                                        ->where('seat', '<=', $student)
                                        ->get()->first();
                                    if (isset($bus_available)) {
                                        //echo $bus_available->seat;
                                        $student = $student - $bus_available->seat;
                                        $totalCapacity += $bus_available->seat;
                                        if (!isset($bus_number[$bus_available->seat])) {
                                            $bus_number[$bus_available->seat] = 1;
                                        } else {
                                            $bus_number[$bus_available->seat] += 1;
                                        }
                                        $bus_id[$busIdNo] = $bus_available->busid;
                                        $busIdNo += 1;
                                        $id = $bus_available->id;
                                        BusNotAvailable($id);
                                    } else {
                                        $bus_available = App\BusInfo::orderBy('seat', 'asc')
                                            ->where('active', 1)
                                            ->where('availability', 1)
                                            ->where('seat', '>=', $student)
                                            ->get()->first();
                                        if (isset($bus_available)) {
                                            //echo $bus_available->seat;
                                            $student = $student - $bus_available->seat;
                                            $totalCapacity += $bus_available->seat;
                                            if (!isset($bus_number[$bus_available->seat])) {
                                                $bus_number[$bus_available->seat] = 1;
                                            } else {
                                                $bus_number[$bus_available->seat] += 1;
                                            }
                                            $bus_id[$busIdNo] = $bus_available->busid;
                                            $busIdNo += 1;
                                            $id = $bus_available->id;
                                            BusNotAvailable($id);
                                        } else {
                                            $enough = false;
                                        }

                                    }
                                }
                                ?>


                                @if(count($bus_number)>0)
                                    @foreach ($bus_number as $seatNo => $busNo )
                                        {{$busNo}}{{'x'}}{{$seatNo}}
                                    @endforeach
                                    @if(!$enough) {{"Not Enough Bus"}} @endif
                                @else
                                    {{0}}
                                @endif
                                <?php $busDepTot = $busDepTot + $bus; ?>
                            </td>
                            <td>
                                {{-- seat capacity --}}
                                {{$totalCapacity}}
                            </td> 
                            <td>
                                {{-- Alloted Bus ID --}}
                                <?php
                                $comma = count($bus_id);
                                    foreach ($bus_id as $busIdNumber)
                                    {
                                        echo $busIdNumber;
                                        $comma--;
                                        if($comma)
                                        echo ", ";
                                        else
                                        echo ".";
                                    }                                
                                ?>
                            </td> 
                            <?php
                            $busSeatDepTot = $busSeatDepTot + $totalCapacity;
                            foreach ($bus_number as $seatNo => $busNo) {
                                $busDepTot = $busDepTot + $busNo;
                            }

                            ?>

                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td>{{$stdDepTot}}</td>
                        <td>{{$busDepTot}}</td>
                        <td>{{$busSeatDepTot}}</td>
                        <td></td>

                    </tr>
                    </tbody>
                </table>

                <h4><b><big>{{"Male Students"}}</big></b></h4>
                {{"Arrival"}}
                <?php
                $busInfo = DB::table('businfo')->where('availability', '=', 0)
                    ->update(array('availability' => 1));

                ?>
                <table class="table table-responsive table-hover table-bordered table-condensed">
                    <thead class="table">
                    <tr>
                        <th>No</th>
                        <th>Route Name</th>
                        <th> No of Students</th>
                        <th>Bus Needed</th>
                        <th>Seat Capacity</th>
                        <th>Alloted Bus</th>
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
                                $student = $studentSum; // 645;
                                $totalCapacity = 0;
                                $enough = true;
                                $bus_number = array();
                                $bus_id = array();
                                $busIdNo = 0;
                                while ($student > 0 && $enough) {
                                    $bus_available = App\BusInfo::orderBy('seat', ' desc')
                                        ->where('active', 1)
                                        ->where('availability', 1)
                                        ->where('seat', '<=', $student)
                                        ->get()->first();

                                    if (isset($bus_available)) {
                                        //echo $bus_available->seat;
                                        $student = $student - $bus_available->seat;
                                        $totalCapacity += $bus_available->seat;
                                        if (!isset($bus_number[$bus_available->seat])) {
                                            $bus_number[$bus_available->seat] = 1;
                                        } else {
                                            $bus_number[$bus_available->seat] += 1;
                                        }
                                        $bus_id[$busIdNo] = $bus_available->busid;
                                            $busIdNo += 1;
                                        $id = $bus_available->id;
                                        BusNotAvailable($id);
                                    } else {
                                        $bus_available = App\BusInfo::orderBy('seat', 'asc')
                                            ->where('active', 1)
                                            ->where('availability', 1)
                                            ->where('seat', '>=', $student)
                                            ->get()->first();
                                        if (isset($bus_available)) {
                                            //echo $bus_available->seat;
                                            $student = $student - $bus_available->seat;
                                            $totalCapacity += $bus_available->seat;
                                            if (!isset($bus_number[$bus_available->seat])) {
                                                $bus_number[$bus_available->seat] = 1;
                                            } else {
                                                $bus_number[$bus_available->seat] += 1;
                                            }
                                            $bus_id[$busIdNo] = $bus_available->busid;
                                            $busIdNo += 1;
                                            $id = $bus_available->id;
                                            BusNotAvailable($id);
                                        } else {
                                            $enough = false;
                                        }
                                    }
                                }
                                ?>


                                @if(count($bus_number)>0)
                                    @foreach ($bus_number as $seatNo => $busNo )
                                        {{$busNo}}{{'x'}}{{$seatNo}}
                                    @endforeach
                                    @if(!$enough) {{"Not Enough Bus"}} @endif
                                @else
                                    {{0}}
                                @endif
                                <?php $busArvTot = $busArvTot + $bus; ?>
                            </td>
                            <td>
                                {{-- seat capacity --}}
                                {{$totalCapacity}}
                            </td>
                            <td>
                                  {{-- Alloted Bus ID --}}
                                <?php
                                $comma = count($bus_id);
                                    foreach ($bus_id as $busIdNumber)
                                    {
                                        echo $busIdNumber;
                                        $comma--;
                                        if($comma)
                                        echo ", ";
                                        else
                                        echo ".";
                                    }                                
                                ?>
                            </td> 
                            <?php
                            $busSeatArvTot = $busSeatArvTot + $totalCapacity;
                            foreach ($bus_number as $seatNo => $busNo) {
                                $busArvTot = $busArvTot + $busNo;
                            }

                            ?>

                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td>{{$stdArvTot}}</td>
                        <td>{{$busArvTot}}</td>
                        <td>{{$busSeatArvTot}}</td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
                {{"Departure"}}
                <?php
                $busInfo = DB::table('businfo')->where('availability', '=', 0)
                    ->update(array('availability' => 1));

                ?>
                <table class="table table-responsive table-hover table-bordered table-condensed">
                    <thead class="table">
                    <tr>
                        <th>No</th>
                        <th>Route Name</th>
                        <th> No of Students</th>
                        <th>Bus Needed</th>
                        <th>Seat Capacity</th>
                        <th>Alloted Bus</th>
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
                                $student = $studentSum; // 645;
                                $totalCapacity = 0;
                                $enough = true;
                                $bus_number = array();
                                $bus_id = array();
                                $busIdNo = 0;
                                while ($student > 0 && $enough) {
                                    $bus_available = App\BusInfo::orderBy('seat', ' desc')
                                        ->where('active', 1)
                                        ->where('availability', 1)
                                        ->where('seat', '<=', $student)
                                        ->get()->first();
                                    if (isset($bus_available)) {
                                        //echo $bus_available->seat;
                                        $student = $student - $bus_available->seat;
                                        $totalCapacity += $bus_available->seat;
                                        if (!isset($bus_number[$bus_available->seat])) {
                                            $bus_number[$bus_available->seat] = 1;
                                        } else {
                                            $bus_number[$bus_available->seat] += 1;
                                        }
                                        $bus_id[$busIdNo] = $bus_available->busid;
                                            $busIdNo += 1;
                                        $id = $bus_available->id;
                                        BusNotAvailable($id);
                                    } else {
                                        $bus_available = App\BusInfo::orderBy('seat', 'asc')
                                            ->where('active', 1)
                                            ->where('availability', 1)
                                            ->where('seat', '>=', $student)
                                            ->get()->first();
                                        if (isset($bus_available)) {
                                            //echo $bus_available->seat;
                                            $student = $student - $bus_available->seat;
                                            $totalCapacity += $bus_available->seat;
                                            if (!isset($bus_number[$bus_available->seat])) {
                                                $bus_number[$bus_available->seat] = 1;
                                            } else {
                                                $bus_number[$bus_available->seat] += 1;
                                            }
                                            $bus_id[$busIdNo] = $bus_available->busid;
                                            $busIdNo += 1;
                                            $id = $bus_available->id;
                                            BusNotAvailable($id);
                                        } else {
                                            $enough = false;
                                        }

                                    }
                                }

                                ?>

                                @if(count($bus_number)>0)
                                    @foreach ($bus_number as $seatNo => $busNo )
                                        {{$busNo}}{{'x'}}{{$seatNo}}
                                    @endforeach
                                    @if(!$enough) {{"Not Enough Bus"}} @endif
                                @else
                                    {{0}}
                                @endif
                            </td>
                            <td>
                                {{-- seat capacity --}}
                                {{$totalCapacity}}
                            </td>
                            <td>{{-- Alloted Bus ID --}}
                                    <?php
                                    $comma = count($bus_id);
                                        foreach ($bus_id as $busIdNumber)
                                        {
                                            echo $busIdNumber;
                                            $comma--;
                                            if($comma)
                                            echo ", ";
                                            else
                                            echo ".";
                                        }                                
                                    ?>
                            </td> 
                            <?php
                            $busSeatDepTot = $busSeatDepTot + $totalCapacity;
                            foreach ($bus_number as $seatNo => $busNo) {
                                $busDepTot = $busDepTot + $busNo;
                            }

                            ?>

                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td>{{$stdDepTot}}</td>
                        <td>{{$busDepTot}}</td>
                        <td>{{$busSeatDepTot}}</td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            @else
                <p><h4>No routes found for today ! :( </h4></p>
            @endif
        @else
            <p><h4> No Data Found For Today!</h4></p>
        @endif
    </div>
    <br>
    <?php
    function BusNotAvailable($id)
    {
        $change = App\BusInfo::findOrFail($id);

        if ($change) {
            $change->availability = 0;
            $change->save();
        }
    }
    ?>
@endsection

