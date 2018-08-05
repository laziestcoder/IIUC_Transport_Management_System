<?php

namespace App\Http\Controllers;

use App\BusPoint;
use App\BusRoute;
use App\Day;
use App\Schedule;
use App\Time;
use Carbon\Carbon;
use DB;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Response;

class ScheduleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('admin', ['except' => ['index','show'] ]);
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::all();
        //$days = Day::all();//->where('day', '1');
        //$times = Time::all();//->where('day', '1');

        $data = array(
            'schedules' => $schedules,
            'title' => 'Schedule Information',
            'description' => 'Here you will get available bus schedule information. You can also remove and edit Bus Schedules.',
            'titlenew' => 'Create New Schedule',
            'titleinfo' => 'Available Schedule',
            'times' => Time::all('id', 'time'),
            'days' => Day::all('id', 'dayname'),
            'points' => BusPoint::all('id', 'pointname'),
            //'days' => $days,
            //'times' => $times,
        );
        return view("schedule.index")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = array(
            'title' => 'New Bus Schedule',
            'description' => 'Here you can add New Bus Schedule.',
            'titlenew' => 'Create New Schedule',
            'titleinfo' => 'Available Schedule',
            'times' => Time::all('id', 'time'),
            'days' => Day::all('id', 'dayname'),
            'points' => BusPoint::all('id', 'pointname'),
            'routes' => BusRoute::all()->sortBy('routename'),
//            'routes' => BusRoute::orderBy('routename', 'asc')->get(),
        );
        return view("schedule.create")->with($data);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $schedules = Schedule::all()->sortBy('route');

        $data = array(
            'schedules' => $schedules,
            'title' => 'Schedule Information',
            'titleinfo' => 'All Individual Schedule',
            'description' => 'Here you will get available bus schedule information. You can also remove and edit Bus Schedules.',
            'times' => Time::all('id', 'time'),
            'days' => Day::all('id', 'dayname'),
            'points' => BusPoint::all('id', 'pointname'),
        );
        return view("schedule.allschedule")->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'day' => 'required|integer',
            'toiiuc' => 'boolean',
            'fromiiuc' => 'boolean',
            'male' => 'boolean',
            'female' => 'boolean',
            'time' => 'required|integer',
            'user' => 'required|integer',
            'route' => 'required|int',
        ]);

        function dataCheck($day, $route, $time, $male, $female, $toiiuc, $fromiiuc,$user){
            $data = Schedule::where('day',$day)
                ->where('route',$route)
                ->where('time',$time)
                ->where('male',$male)
                ->where('female',$female)
                ->where('toiiuc',$toiiuc)
                ->where('fromiiuc',$fromiiuc)
                ->where('user',$user)
                ->get();
            if(count($data)>0)
                return true;
            else
                return true;

        }
        $day= $request->input('day'); $route= $request->input('route'); $time= $request->input('time');
        $male= $request->input('male'); $female= $request->input('female');
        $toiiuc= $request->input('toiiuc'); $fromiiuc= $request->input('fromiiuc'); $user = $request->input('user');



        if ($day == '9') {
            for ($i = 1; $i <= 5; $i = $i + 1) {
                if(dataCheck($i, $route, $time, $male, $female, $toiiuc, $fromiiuc,$user)){
                    continue;
                }
                $schedule = new Schedule;
                $schedule->day = $i;
                $schedule->toiiuc = $request->input('toiiuc') ? $request->input('toiiuc') : 0;
                $schedule->fromiiuc = $request->input('fromiiuc') ? $request->input('fromiiuc') : 0;
                $schedule->male = $request->input('male') ? $request->input('male') : 0;
                $schedule->female = $request->input('female') ? $request->input('female') : 0;
                $schedule->time = $request->input('time');
                $schedule->user = $request->input('user');
                $schedule->route = $request->input('route');
                $schedule->user_id = Admin::user()->id;
                $schedule->save();

            }

        } else {
            if(dataCheck($day, $route, $time, $male, $female, $toiiuc, $fromiiuc,$user)){
                return redirect('/admin/auth/schedule/create')->with('error', 'Data Exist');
            }
            //Create BusRoute
            $schedule = new Schedule;
            $schedule->day = $request->input('day');
            $schedule->toiiuc = $request->input('toiiuc') ? $request->input('toiiuc') : 0;
            $schedule->fromiiuc = $request->input('fromiiuc') ? $request->input('fromiiuc') : 0;
            $schedule->male = $request->input('male') ? $request->input('male') : 0;
            $schedule->female = $request->input('female') ? $request->input('female') : 0;
            $schedule->time = $request->input('time');
            $schedule->user = $request->input('user');
            $schedule->route = $request->input('route');
            $schedule->user_id = Admin::user()->id;
            $schedule->save();
        }
        $success = array(
            'success' => 'Bus Schedule Created Successfully!'
        );
        if ($this) {
            return redirect('/admin/auth/schedule/create')->with($success);
        } else {
            return redirect('/admin/auth/schedule/create')->with('error', 'validation failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

//        $BusRoute = BusRoute::find($id);
//        $BusRoutes = BusRoute::orderBy('routename')->paginate(20);
//        $data = array(
//            'title' => 'Edit Bus Route',
//            'titleinfo' => 'Available Bus Routes',
//            'BusRoutes' => $BusRoutes,
//            'BusRoute' => $BusRoute
//        );
//        //Check for correct user
//        /* if(Admin::user()->id !== $BusRoute->user_id)
//        {
//            return redirect('/admin/auth/routes/create')->with('error','Unauthorized Access Denied!');
//        } */
//        return view('busroutes.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::find($id);

        //Check for correct user

        if((Admin::user()->id == $schedule->user_id)||(DB::table('admin_role_users')->where('user_id',(Admin::user()->id))->first()->role_id <= 4))
//        if (Admin::user()->id !== $schedule->user_id)
        {
            /* if($BusRoute->cover_image != 'noimage.jpeg' ){
                //Delete Image From Windows Directory
                Storage::delete('public/cover_images/'.$BusRoute->cover_image);
            } */

            // Check other Tables if the time is used
            $points = DB::table('points')->where('routeid', $id)->first();
            $name = DB::table('day')->where('id', $schedule->day)->first()->dayname;
            $time = Carbon::parse(DB::table('time')->where('time', $schedule->time)->first())->format('g:i A');
            $route = $schedule->route ? 'AK Khan Shuttle' : 'All Route';
            if ($points && !$points) {
                if ($points->routeid == $id) {
                    return redirect('/admin/auth/allschedule')->with('error', 'Day "' . $name . '" Time "' . $time . '" Route > "' . $route . '"<br>=> This Bus Schedule has assigned one or more students schedule.<br> Delete all students schedule related to the schedule.<br> Then delete the schedule.');
                } else {
                    return redirect('/admin/auth/allschedule')->with('error', 'Day "' . $name . '" Time "' . $time . '" Route > "' . $route . '"<br>=> Something went worng!!');

                }
            } else {
                $schedule->delete();
                return redirect('/admin/auth/allschedule')->with('success', 'Day > "' . $name . '" Time > "' . $time . '" Route > "' . $route . '"<br>=> Bus Schedule Removed Successfully!');
                //return redirect('/admin/auth/schedule')->with('success', 'Day '.$name.$time);
            }
        }
        else{
            return redirect('/admin/auth/allschedule')->with('error', 'Unauthorized Access Denied!');

        }
    }
}
