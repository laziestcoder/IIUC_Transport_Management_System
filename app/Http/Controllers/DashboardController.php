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

        $url = "http://upanel.iiuc.ac.bd:81/Picture/" . $user->jobid . ".jpg";
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $lines_string = curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $file2 = $lines_string;
        $file = $retcode;
        $verified = false;
        if ($file == 200 && $file2[0] != '<') {
            $verified = true;
            $image = "<img style='max-width:100px;max-height:100px' class='img img-thumbnail' src='http://upanel.iiuc.ac.bd:81/Picture/" . $user->jobid . ".jpg' alt='" . $user->name . "'/>";
        } else {
            $verified = false;
            $image = "<img style='max-width:100px;max-height:100px' class='img img-thumbnail' src='/storage/image/user/" . $user->image . "' alt='" . $user->name . "'/>";
        }

        $data = array(
            //'BusRoutes' => $BusRoutes,
            //'BusPoints' => $BusPoints,
            'days' => $days,
            'user' => $user,
            'image' => $image,
            'verified' => $verified,

        );
        return view('user.dashboard')->with($data);
    }

}
