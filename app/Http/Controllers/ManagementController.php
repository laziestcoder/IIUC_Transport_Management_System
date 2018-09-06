<?php

namespace App\Http\Controllers;

use App\BusPoint;
use App\BusRoute;
use App\Day;
use App\Schedule;
use App\StudentSchedule;
use App\Time;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id = auth()->user()->id;
        $user_gender = auth()->user()->gender;
        $user_role = auth()->user()->userrole;
        $check = StudentSchedule::where('user_id', $user_id)->first();
        $today = Carbon::now();
        if ($check) {
            $entrydate = Carbon::parse($check->entrydate);
            $expiredate = $entrydate->addDays(15);
            $entrydate = Carbon::parse($check->entrydate);
            $datedifference = $expiredate->diffInDays($today);
            if ($datedifference > 0) {
                //$date = $today->addDays($date)->toDateString();
                return redirect('/dashboard')->with('error', 'You have changed you bus routine on ' . $check->entrydate . '. You are not allowed to edit now! Wait till ' . $expiredate->toDateString() . ' .');
            }
        }

        $user = User::find($user_id);
        $BusRoutes = BusRoute::orderBy('routename')->get();
        $BusPoints = BusPoint::orderBy('pointname')->get();
        $days = Day::orderBy('id')->get();
        $pickuptimes = Time::where('toiiuc', 1)->orderBy('time')->get();
        $droptimes = Time::where('fromiiuc', 1)->orderBy('time')->get();
        //account verification
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
            $image = "<img src='http://upanel.iiuc.ac.bd:81/Picture/" . $user->jobid . ".jpg' alt='" . $user->name . "'/>";
        } else {
            $verified = false;
            $image = "<img src='/storage/image/user/" . $user->image . "' alt='" . $user->name . "'/>";
        }
        if (!$verified) {
            return redirect('/dashboard')->with('error', 'Your account is not verified. Please check you Varsity ID and Name.');

        }
        $data = array(
            'BusRoutes' => $BusRoutes,
            'BusPoints' => $BusPoints,
            'picktimes' => $pickuptimes,
            'droptimes' => $droptimes,
            'days' => $days,
            'user' => $user,
            "gender" => $user_gender,
        );
        return view('user.management')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //$datas = $request->all();
        $available = StudentSchedule::where('user_id', auth()->user()->id);
        if ($available) {
            $id = auth()->user()->id;
            return $this->update($request, $id);
        }
        $days = Day::orderBy('id')->get();

        foreach ($days as $day) {

            if ($day->id > 7) {
                break;
            }

            $schedule = new StudentSchedule;
            $schedule->day = $day->id;
            $schedule->pickpoint = $request->input('pickpoint' . $day->id);
            $schedule->picktime = $request->input('picktime' . $day->id);
            $schedule->droppoint = $request->input('droppoint' . $day->id);
            $schedule->droptime = $request->input('droptime' . $day->id);
            $schedule->user_id = auth()->user()->id;
            $schedule->userrole = auth()->user()->userrole;
            $schedule->entrydate = Carbon::now()->toDateString();
            $schedule->save();
        }

        $success = array(
            'transport_message' => 'Information Added Successfully!'
        );
        return redirect('/dashboard#transport')->with($success);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $days = Day::orderBy('id')->get();
        foreach ($days as $day) {


            if ($day->id > 7) {
                break;
            }
            $dataid = StudentSchedule::where('user_id', $id)->where('day', $day->id)->first()->id;
            $schedule = StudentSchedule::find($dataid);
            $schedule->pickpoint = $request->input('pickpoint' . $day->id);
            $schedule->picktime = $request->input('picktime' . $day->id);
            $schedule->droppoint = $request->input('droppoint' . $day->id);
            $schedule->droptime = $request->input('droptime' . $day->id);
            $schedule->user_id = auth()->user()->id;
            $schedule->userrole = auth()->user()->userrole;
            $schedule->entrydate = Carbon::now()->toDateString();
            $schedule->save();
        }

        $success = array(
            'transport_message' => 'Information Updated Successfully!'
        );
        return redirect('/dashboard#transport')->with($success);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function busroutes()
    {
        //account verification
        $user = User::find(auth()->user()->id);
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
            $image = "<img src='http://upanel.iiuc.ac.bd:81/Picture/" . $user->jobid . ".jpg' alt='" . $user->name . "'/>";
        } else {
            $verified = false;
            $image = "<img src='/storage/image/user/" . $user->image . "' alt='" . $user->name . "'/>";
        }
        if (!$verified) {
            return redirect('/dashboard')->with('error', 'Your account is not verified. Please check you Varsity ID and Name.');

        }
        //account verification end

        $user_gender = auth()->user()->gender;
        if ($user_gender == 0) {
            $schedules = Schedule::where('male', '1')->get();
        } else {
            $schedules = Schedule::where('female', '1')->get();
        }
        //$days = Day::all();//->where('day', '1');
        //$times = Time::all();//->where('day', '1');

        $data = array(
            //'schedules' => $schedules,
            'title' => 'Schedule Information',
            'description' => 'Here you will get available bus schedule information. You can also remove and edit Bus Schedules.',
            'titlenew' => 'Create New Schedule',
            'titleinfo' => 'Available Schedule',
            'times' => Time::all('id', 'time'),
            'days' => Day::all('id', 'dayname'),
            'points' => BusPoint::all('id', 'pointname'),
            'gender' => $user_gender,
            'userrole' => $user->userrole,
            //'days' => $days,
            //'times' => $times,
        );
        return view("user.busSchedule")->with($data);
    }
}
