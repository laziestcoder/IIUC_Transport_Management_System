<?php

namespace App\Http\Controllers;

use App\Day;
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');//->except('contact');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        //$BusRoutes = BusRoute::orderBy('routename')->get();
        //$BusPoints = BusPoint::orderBy('pointname')->get();
        $days = Day::orderBy('id')->get();
        //$studentSchedules = StudentSchedule::where('user_id',$user_id)->get();
        //$times = Time::orderBy('time')->get();
        $data = array(
            //'BusRoutes' => $BusRoutes,
            //'BusPoints' => $BusPoints,
            'days' => $days,
            'user' => $user,

        );
        return view('dashboard')->with($data);
    }

}
