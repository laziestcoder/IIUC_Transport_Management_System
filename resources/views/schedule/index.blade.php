@extends('admin::index')


@section('content')

    {{--<script>--}}
    {{--$(document).ready(function () {--}}
    {{--$('[data-toggle=confirmation]').confirmation({--}}
    {{--rootSelector: '[data-toggle=confirmation]',--}}
    {{--onConfirm: function (event, element) {--}}
    {{--element.closest('form').submit();--}}
    {{--}--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}
    <section class="content-header">
        @include('inc.messages')
        <h1>
            {{$title}}
            <small>{{$description}}</small>
        </h1>
    </section>
    <br>
    <section class="content">
        <h2>{{$titleinfo}}
        </h2>

        @if( count($days) > 0 )
            @foreach($days as $day)
                <h3><b>{{$day->dayname}}</b></h3>

                {{-- @if( $day->id == 7  )
                    <a class="btn btn-success" target="_blank" href='/bus-schedule-friday'>
                        <i class="fa fa-print"></i>Print
                    </a> --}}
                {{-- @elseif ($day->id <= 5 && $day->id >= 1 ) --}}
                    {{-- <a class="btn btn-success" target="_blank" href='/bus-schedule-pdf'>
                        <i class="fa fa-print"></i> Print
                    </a> --}}
                    <form action="/bus-schedule-pdf" target="_blank">
                    <input type="hidden" name="dayid" value="{!! $day->id !!}"></input>
                    <button class="btn btn-success"  type="submit" value="Print">
                        <i class="fa fa-print"></i> Print
                    </button>

                    </form>
                {{-- @endif --}}
                <br>
                <h4><b>{{"Towards IIUC"}}</b></h4>
                <table class="table table-hover table-bordered table-responsive-lg">
                    <thead class="table">
                    <tr>
                        <th>{{"No."}}</th>
                        <th>{{"Starting Time"}}</th>
                        <th>{{"Gender"}}</th>
                        <th>{{"Route"}}</th>
                        <th>{{"Added By"}}</th>
                        {{--<th>{{"Action"}}</th>--}}
                    </tr>
                    </thead>
                    <tbody class="table">
                    <?php $sl = 0; ?>
                    @foreach($times as $time)
                        <?php 
                        $filter = $day->id; 
                                  $schedules = App\Schedule::whereHas('day', function($q) use ($filter) {
                                    $q->where('id', $filter);})
                            ->where('time', $time->id)
                            ->where('toiiuc', 1)
                            ->get();?>
                        @if(count($schedules) > 0)
                            <tr>

                                <td>{{$sl +=1}}</td>
                                <td>{{\Carbon\Carbon::parse(App\Time::where('id',$time->id)->first()->time)->format('g:i A')}}</td>

                                <?php
                                $filter = $day->id; 
                                $male = App\Schedule::whereHas('day', function($q) use ($filter) {
                                  $q->where('id', $filter);})
                                    ->where('time', $time->id)
                                    ->where('male', '1')
                                    ->get();
                                $female = App\Schedule::whereHas('day', function($q) use ($filter) {
                                    $q->where('id', $filter);})
                                    ->where('time', $time->id)
                                    ->where('female', '1')
                                    ->get();?>

                                <td>
                                    {{count($male)? 'Male':''}}
                                    @if(count($male) && count($female))
                                        {{","}}
                                    @endif
                                    {{count($female)? 'Female':''}}
                                </td>

                                <?php $filter = $day->id; 
                                $routes = App\Schedule::whereHas('day', function($q) use ($filter) {
                                  $q->where('id', $filter);})
                                    ->where('time', $time->id)
                                    ->first();
                                $routes = $routes->route;
                                
                                if (count($routes) > 1) {
                                    $routeFlag = count($routes) - 1;
                                } else {
                                    $routeFlag = 0;
                                }
                                ?>

                                <td>
                                    @foreach($routes as $route)
                                        {{$route->routename}}
                                        @if($routeFlag)
                                            {{", "}}
                                        @endif
                                        <?php $routeFlag -= 1;?>
                                    @endforeach
                                </td>
                                <?php $filter = $day->id; 
                                $userid = App\Schedule::whereHas('day', function($q) use ($filter) {
                                  $q->where('id', $filter);})
                                    ->where('time', $time->id)
                                    ->first(); ?>
                                <td>{{Admin::user()->where('id',$userid->user_id)->first()->name}}</td>

                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
                <h4><b>{{"From IIUC"}}</b></h4>
                <table class="table table-hover table-bordered table-responsive-lg">
                    <thead class="table">
                    <tr>
                        <th>{{"No."}}</th>
                        <th>{{"Starting Time"}}</th>
                        <th>{{"Gender"}}</th>
                        <th>{{"Route"}}</th>
                        <th>{{"Added By"}}</th>
                        {{--<th>{{"Action"}}</th>--}}
                    </tr>
                    </thead>
                    <tbody class="table">
                    <?php $sl = 0; ?>
                    @foreach($times as $time)
                        <?php 
                        $filter = $day->id; 
                        $schedules = App\Schedule::whereHas('day', function($q) use ($filter) {
                          $q->where('id', $filter);})
                            ->where('time', $time->id)
                            ->where('fromiiuc', 1)
                            ->get();?>
                        @if(count($schedules) > 0)
                            <tr>

                                <td>{{$sl +=1}}</td>
                                <td>{{\Carbon\Carbon::parse(App\Time::where('id',$time->id)->first()->time)->format('g:i A')}}</td>

                                <?php $filter = $day->id; 
                                $male = App\Schedule::whereHas('day', function($q) use ($filter) {
                                  $q->where('id', $filter);})
                                    ->where('time', $time->id)
                                    ->where('male', '1')
                                    ->get();
                                $female = App\Schedule::whereHas('day', function($q) use ($filter) {
                                    $q->where('id', $filter);})
                                    ->where('time', $time->id)
                                    ->where('female', '1')
                                    ->get();?>

                                <td>
                                    {{count($male)? 'Male':''}}
                                    @if(count($male) && count($female))
                                        {{","}}
                                    @endif
                                    {{count($female)? 'Female':''}}
                                </td>
                                <?php $filter = $day->id; 
                                $routes = App\Schedule::whereHas('day', function($q) use ($filter) {
                                  $q->where('id', $filter);})
                                    ->where('time', $time->id)
                                    ->first();
                                $routes = $routes->route;
                                if (count($routes) > 1) {
                                    $routeFlag = count($routes) - 1;
                                } else {
                                    $routeFlag = 0;
                                }?>

                                <td>
                                    @foreach($routes as $route)
                                        {{-- {{\App\BusRoute::where('id',$route->id)->first()->routename}} --}}
                                        {{$route->routename}}
                                        @if($routeFlag)
                                            {{", "}}
                                        @endif
                                        <?php $routeFlag -= 1;?>
                                    @endforeach
                                </td>
                                <?php $filter = $day->id; 
                                $userid = App\Schedule::whereHas('day', function($q) use ($filter) {
                                  $q->where('id', $filter);})
                                    ->where('time', $time->id)
                                    ->first(); ?>
                                <td>{{Admin::user()->where('id',$userid->user_id)->first()->name}}</td>

                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            @endforeach
        @else
            <p>No Schedule Found</p>
        @endif

    </section>
@endsection
