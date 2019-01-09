@extends('layouts.userlayout')

@section('usercontent')
    <div class="panel-body backGround">
        <h1>Profile</h1>
    </div>
    <hr>
    <div class="panel-body">
        <div class="container ">
            <div class="userinfo">
                @include('inc.messages')
                <b><h3>Basic Info:</h3></b>
                <hr>
                <table class="table-active table-responsive-lg">
                    <thead class="">
                    <tr>
                        <td>
                            {!! $image !!}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Name: {!! $user->name !!}  {!! $verified? '<i style="font-size:20px; color:green;" class="fa fa-check-circle"></i>': '<i style="font-size:20px;" class="fa">&#x2753;</i>' !!}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ID: {{$user->jobid}} {!! $verified? '<i style="font-size:20px; color:green;" class="fa fa-check-circle"></i>': '<i style="font-size:20px; color:red;" class="fa fa-close"></i>' !!}
                        </td>

                    </tr>
                    <tr>
                        <td>
                            Gender: {{$user->gender == 0 ? 'Male' : 'Female'}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Registered
                            As: {{$user->user_type == 1 ? 'Student' : ( $user->user_type == 2 ? 'Faculty Member' :($user->user_type == 3 ? 'Officer/Staff' : 'undefined')) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email: {{$user->email}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Contact: {{$user->contact ? $user->contact : 'none'}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Verified: {!! ($verified && $adminVerification)? 'Yes': 'No' !!}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Last Updated: {!! $lastupdated !!}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Next Update: {!! $nextDate!!}
                        </td>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <br><br>
        <div id='transport' class="container">
            <div class="userrouteinfo">
                <b><h3>Transport Schedule:</h3></b>
                <hr>

                @if(Session::has('transport_message'))
                    <div id="success">
                        <div class="alert alert-success">
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <strong>
                                {{session::get('transport_message')}}
                            </strong>
                        </div>
                    </div>
                @endif

                <table class="table table-bordered table-responsive-lg">
                    <thead class="">
                    <tr>
                        <td>
                            Day
                        </td>
                        <td>
                            Pick Up Point
                        </td>
                        <td>
                            Pick Up Time
                        </td>
                        <td>
                            Drop Point
                        </td>
                        <td>
                            Leaving Time
                        </td>
                    </tr>
                    </thead>
                    <tbody class="">
                    @if(count($days) > 0 )
                        @foreach( $days as $day )
                            @if( $day->id < 8)
                                <tr>
                                    <td>
                                        {!! $day->dayname !!}
                                    </td>
                                    <td>
                                        <?php
                                        $place = App\StudentSchedule::where('user_id', $user->id)
                                            ->where('day', $day->id)->first();
                                        if ($place) {
                                            $place = App\BusPoint::where('id', $place->pickpoint)->first();
                                            if ($place) {
                                                $active = $place->active;
                                                if($active){
                                                    echo $place->pointname;
                                                }else{
                                                    $place2 = App\BusPoint::where('routeid', $place->routeid)
                                                            ->where('active',1)
                                                            ->where('weight','<',$place->weight)
                                                            ->first();
                                                            if($place2){
                                                                echo $place2->pointname;
                                                            }else{
                                                                $place2 = App\BusPoint::where('routeid', $place->routeid)
                                                            ->where('active',1)
                                                            ->where('weight','>',$place->weight)
                                                            ->first();
                                                            echo $place2->pointname;
                                                            }
                                                }
                                            } else{
                                                echo "Point Not Found";
                                            } 
                                        } else {
                                            echo "Not Selected";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $time = App\StudentSchedule::where('user_id', $user->id)
                                            ->where('day', $day->id)->first();
                                        if ($time) {
                                            $time = App\Time::where('id', ($time->picktime))->first();
                                            if ($time) {
                                                echo Carbon\Carbon::parse($time->time)->format('g:i A');
                                            } else {
                                                echo "Not Selected";
                                            }
                                        } else {
                                            echo "Not Selected";
                                        }

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $place = App\StudentSchedule::where('user_id', $user->id)
                                            ->where('day', $day->id)->first();
                                            if ($place) {
                                            $place = App\BusPoint::where('id', $place->droppoint)->first();
                                            if ($place) {
                                                $active = $place->active;
                                                if($active){
                                                    echo $place->pointname;
                                                }else{
                                                    $place2 = App\BusPoint::where('routeid', $place->routeid)
                                                            ->where('active',1)
                                                            ->where('weight','<',$place->weight)
                                                            ->first();
                                                    if($place2){
                                                        echo $place2->pointname;
                                                    }else{
                                                        $place2 = App\BusPoint::where('routeid', $place->routeid)
                                                    ->where('active',1)
                                                    ->where('weight','>',$place->weight)
                                                    ->first();
                                                    echo $place2->pointname;
                                                    }
                                                }
                                            } else{
                                                echo "Point Not Found";
                                            } 
                                        } else {
                                            echo "Not Selected";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $time = App\StudentSchedule::where('user_id', $user->id)
                                            ->where('day', $day->id)->first();
                                        if ($time) {
                                            $time = App\Time::where('id', ($time->droptime))->first();
                                            if ($time) {
                                                echo Carbon\Carbon::parse($time->time)->format('g:i A');
                                            } else {
                                                echo "Not Selected";
                                            }
                                        } else {
                                            echo "Not Selected";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif


                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
