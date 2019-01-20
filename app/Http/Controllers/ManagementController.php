<?php

namespace App\Http\Controllers;

use App\AdminDashboard;
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
        $user_role = auth()->user()->user_type;
        $check = StudentSchedule::where('user_id', $user_id)->first();
        $today = Carbon::now();
        $datelimit = AdminDashboard::all()->first();
        $editOn = $datelimit->schedule_edit ? 0 : 1;
        if ($check) {
            $datelimit = $datelimit->editdate;
            $entrydate = Carbon::parse($check->entrydate);
            $expiredate = $entrydate->addDays($datelimit);
//            $expiredate = Carbon::parse($entrydate->addDays($datelimit))->format('d-m-Y  g:i A');
//            $entrydate = Carbon::parse($check->entrydate);
//            $entrydate = Carbon::parse($check->entrydate)->format('d-m-Y  g:i A');
            //$datedifference = $expiredate->diffInDays($today);
            if ($today <= $expiredate) {
                //$date = $today->addDays($date)->toDateString();
                return redirect('/dashboard')->with('error', 'You have changed your bus routine on ' . $check->entrydate . '. You are not allowed to edit now! Wait till ' . $expiredate->toDateString() . ' .');
            }
        }

        $user = User::find($user_id);
        $BusRoutes = BusRoute::orderBy('routename')->where('active', true)->get();
        $BusPoints = BusPoint::orderBy('pointname')->where('active', true)->get();
        $days = Day::orderBy('id')->get();
        $pickuptimes = Time::where('toiiuc', 1)->orderBy('time')->get();
        $droptimes = Time::where('fromiiuc', 1)->orderBy('time')->get();
        //account verification
        $url = "http://upanel.iiuc.ac.bd:81/Picture/" . $user->varsity_id . ".jpg";
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
        $adminVerification = $user->confirmation;
        if ($file == 200 && $file2[0] != '<') {
            $verified = true;
            $image = "<img src='http://upanel.iiuc.ac.bd:81/Picture/" . $user->varsity_id . ".jpg' alt='" . $user->name . "'/>";
        } else {
            //$verified = false;
            $image = "<img src='/storage/image/user/" . $user->image . "' alt='" . $user->name . "'/>";
        }
        if (!$verified && !$adminVerification ) {
            return redirect('/dashboard')->with('error', 'Your account is not verified. Please check your \'Varsity ID\' and \'Name\' or contact with an administrative person. Thank you.');
        }
        if($editOn){
            return redirect('/dashboard')->with('error', 'Transport Schedule Edit is now closed. Thank you.');
        }
        $data = array(
            //'BusRoutes' => $BusRoutes,
            'BusPoints' => $BusPoints,
            'picktimes' => $pickuptimes,
            'droptimes' => $droptimes,
            'days' => $days,
            'user' => $user,
            'gender' => $user_gender,
            'editOn' =>$editOn,
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
        $available = StudentSchedule::where('user_id', auth()->user()->id)->get();
        if (count($available)) {
            $id = auth()->user()->id;
            return $this->update($request, $id);
        }
        $days = Day::orderBy('id')->get();

        foreach ($days as $day) {

            if ($day->id > 7) {
                break;
            }

            $schedule = new StudentSchedule;
            $dayid = $schedule->day = $day->id;
            $pickid = $schedule->pickpoint = $request->input('pickpoint' . $day->id);
            $picktime = $schedule->picktime = $request->input('picktime' . $day->id);
            $dropid = $schedule->droppoint = $request->input('droppoint' . $day->id);
            $schedule->pick_point_route = BusPoint::find($pickid)->first()->routeid;
            $schedule->drop_point_route = BusPoint::find($dropid)->first()->routeid;
            $droptime = $schedule->droptime = $request->input('droptime' . $day->id);
            $schedule->user_id = auth()->user()->id;
            $schedule->user_type = auth()->user()->user_type;
            $gender = $schedule->user_gender = auth()->user()->gender;
            $schedule->entrydate = Carbon::now()->toDateString();
            $schedule->save();
            if ($pickid && $dropid) {
                $routeid = BusPoint::where('id', $pickid)->first()->routeid;
                $studentNo = BusStudentInfo::where('dayid', $dayid)
                    ->where('routeid', $routeid)
                    ->where('pointid', $pickid)
                    ->where('timeid', $picktime)
                    ->where('gender', $gender)
                    ->get();
                $studentNo = count($studentNo);
                $this->bus_student_number_per_route($dayid, $routeid, $pickid, $picktime, $gender, $studentNo);
                $routeid = BusPoint::where('id', $dropid)->first()->routeid;
                $studentNo = BusStudentInfo::where('dayid', $dayid)
                    ->where('routeid', $routeid)
                    ->where('pointid', $pickid)
                    ->where('timeid', $picktime)
                    ->where('gender', $gender)
                    ->get();
                $studentNo = count($studentNo);
                $this->bus_student_number_per_route($dayid, $routeid, $dropid, $droptime, $gender, $studentNo);
            }
        }

        $success = array(
            'transport_message' => 'Information Added Successfully!',
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
            $dataid = StudentSchedule::where('user_id', $id)->where('day', $day->id)->first();
            if ($dataid) {
                $dataid = $dataid->id;
            } else {
                continue;
            }
            $schedule = StudentSchedule::find($dataid);
            $dayid = $day->id;
            $pickid = $schedule->pickpoint = $request->input('pickpoint' . $day->id); // days wise pickpoint
            $picktime = $schedule->picktime = $request->input('picktime' . $day->id); //  days wise picktime
            $dropid = $schedule->droppoint = $request->input('droppoint' . $day->id);  // days wise droppoint
            $droptime = $schedule->droptime = $request->input('droptime' . $day->id); //  days wise droptime thats why dayId is concated with keyname.
            $schedule->pick_point_route = BusPoint::find($pickid)->first()->routeid;
            $schedule->drop_point_route = BusPoint::find($dropid)->first()->routeid;
            $schedule->user_id = auth()->user()->id;
            $schedule->user_type = auth()->user()->user_type;
            $gender = $schedule->user_gender = auth()->user()->gender;
            $schedule->entrydate = Carbon::now()->toDateString();
            $schedule->save();
            if ($pickid && $dropid) {
                $routeid = BusPoint::where('id', $pickid)->first()->routeid;
                // $studentNo = BusStudentInfo::where('dayid', $dayid)
                //     ->where('routeid', $routeid)
                //     ->where('pointid', $pickid)
                //     ->where('timeid', $picktime)
                //     ->where('gender', $gender)
                //     ->get();
                //$studentNo = count($studentNo);
               // $this->bus_student_number_per_route($dayid, $routeid, $pickid, $picktime, $gender, $studentNo);
                $routeid = BusPoint::where('id', $dropid)->first()->routeid;
                // $studentNo = BusStudentInfo::where('dayid', $dayid)
                //     ->where('routeid', $routeid)
                //     ->where('pointid', $pickid)
                //     ->where('timeid', $picktime)
                //     ->where('gender', $gender)
                //     ->get();
               // $studentNo = count($studentNo);
               // $this->bus_student_number_per_route($dayid, $routeid, $dropid, $droptime, $gender, $studentNo);
            }
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
//    public function show($id)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
//    public function edit($id)
//    {
//        //
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    //    public function destroy($id)
    //    {
    //        //
    //    }

    protected function bus_student_number_per_route($dayid, $routeid, $pointid, $timeid, $gender, $studentNumber)
    {
        // $exist = BusStudentInfo::where('dayid', $dayid)
        //     ->where('routeid', $routeid)
        //     ->where('pointid', $pointid)
        //     ->where('timeid', $timeid)
        //     ->where('gender', $gender)
        //     ->get();
        if (count($exist) > 0) {
            $dataid = $exist->first()->id;
            //$form = BusStudentInfo::find($dataid);

            $form->routeid = $routeid;
            $form->pointid = $pointid;
            $form->studentno = $studentNumber;
            $form->dayid = $dayid;
            $form->timeid = $timeid;
            $form->gender = $gender;

            $form->save();

        } else {
           // $form = new BusStudentInfo;

            $form->routeid = $routeid;
            $form->pointid = $pointid;
            $form->studentno = $studentNumber;
            $form->dayid = $dayid;
            $form->timeid = $timeid;
            $form->gender = $gender;

            $form->save();
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function busSchedule()
    {
        //account verification
        $user = User::find(auth()->user()->id);
        $url = "http://upanel.iiuc.ac.bd:81/Picture/" . $user->varsity_id . ".jpg";
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
        $adminVerification = $user->confirmation;
        if ($file == 200 && $file2[0] != '<') {
            $verified = true;
            $image = "<img src='http://upanel.iiuc.ac.bd:81/Picture/" . $user->varsity_id . ".jpg' alt='" . $user->name . "'/>";
        } else {
            $verified = false;
            $image = "<img src='/storage/image/user/" . $user->image . "' alt='" . $user->name . "'/>";
        }
        if (!$verified && !$adminVerification) {
            return redirect('/dashboard')->with('error', 'Your account is not verified. Please check your \'Varsity ID\' and \'Name\' or contact with an administrative person. Thank you.');

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
            'times' => Time::orderBy('time', 'asc')->get(),
            'days' => Day::where('active', 1)->get(),
            'points' => BusPoint::orderBy('pointname', 'asc')->where('active', true)->get(),
            'gender' => $user_gender,
            'user_type' => $user->user_type,
            //'days' => $days,
            //'times' => $times,
        );
        return view("user.busSchedule")->with($data);
    }

    protected function busroutesdetails()
    {
        $data = array(
            'busroutes' => BusRoute::orderBy('routename', 'asc')->where('active', true)->get(),
            //'points' => BusPoint::all(),
            'title' => 'Route Information',
        );
        return view("user.busRouteDetails")->with($data);

    }
}
