@extends('admin::index')


@section('content')

    <section class="content-header">
        @include('inc.messages')
        <h1>
            {{$title}}
            <small>{{$smallTitle}}</small>
        </h1>
    </section>
    <br><br>
    <section class="content">
        <h1>{{$titleinfo}}</h1>
        @if(count($BusRoutes) > 0)
            @foreach($days as $day)
                {{$day->dayname}}
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
                    @foreach($BusRoutes as $route)
                        <tr> <?php $bus = 0; $studentSum = 0; $seat = 0;?>
                            <td>{{$flag+=1}}</td>
                            <td>
                                <a href="/admin/auth/routes/{{$route->id}}">{{$route->routename}}</a>
                            </td>
                            <td><?php $studentSum = DB::table('schedulestudent')
                                    ->where('schedulestudent.pickpoint', $route->id)
                                    ->get(); ?>
                                {!! count($studentSum) !!}
                            </td>
                            <td>
                                <?php $student = $studentSum = 60; ?>
                                @if(($studentSum/60) > 1)
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
            @endforeach
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