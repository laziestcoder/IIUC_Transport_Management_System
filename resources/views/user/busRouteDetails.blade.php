@extends('layouts.userlayout')

@section('usercontent')
    <div class="panel-body backGround">
        <h1>{!! $title !!}</h1>
    </div>
    <hr>
    <div class="panel-body">
        <div id='transport' class="container">
            <div class="userrouteinfo">
                @if( count($busroutes) > 0 )
                    <table class="table table-bordered table-responsive-lg">
                        <thead class="">
                        <tr>
                            <td>{{"No."}}</td>
                            <td>{{"Route Name"}}</td>
                            <td>{{"Bus Stop Points"}}</td>
                        </tr>
                        </thead>
                        <tbody class="">
                        <?php $sl = 0; ?>
                        @foreach($busroutes as $busroute)
                            @if($busroute->routename !== "All Route")
                                <tr>
                                    <td>{!! ++$sl !!}</td>
                                    <td>{!! $busroute->routename !!}</td>
                                    <td> <?php $points = App\BusPoint::where('routeid', $busroute->id)
                                            ->orderBy('weight', 'asc')
                                            ->where('active', true)
                                            ->get();
                                        if (count($points) > 0) {
                                            $routeFlag = count($points) - 1;
                                        } else {
                                            $routeFlag = 0;
                                        }?>
                                        @if(count($points)>0)
                                            @foreach($points as $point)
                                                {!! $point->pointname !!}
                                                @if($routeFlag)
                                                    {{" ---> "}}
                                                @endif
                                                <?php $routeFlag -= 1;?>
                                            @endforeach
                                        @else
                                            No Bus Stop Point
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>

                @else
                    <p>No Route Found</p>
                @endif
            </div>
        </div>
    </div>
@endsection
