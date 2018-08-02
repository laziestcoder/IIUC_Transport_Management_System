<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\Time;
use App\BusPoint;
use App\Day;
use DB;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;

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
        $data = array(
            'title' => 'Schedule Information',
            'description'=>'Here you will get available bus schedule information. You can also remove and edit Bus Schedules.',
            'titlenew' => 'Create New Schedule',
            'titleinfo' => 'Available Schedule',
            'times' => Time::all('id','time'),
            'days' => Day::all('id','dayname'),
            'points' => BusPoint::all('id','pointname'),
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
            'description'=>'Here you can add New Bus Schedule.',
            'titlenew' => 'Create New Schedule',
            'titleinfo' => 'Available Schedule',
            'times' => Time::all('id','time'),
            'days' => Day::all('id','dayname'),
            'points' => BusPoint::all('id','pointname'),
        );
        return view("schedule.create")->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $this->validate($request, [
//            'time' => 'required',
//        ]);
//
//        //Create BusRoute
//        $time = new Time;
//        $time->time = $request->input('time');
//        $time->toiiuc = $request->input('toiiuc') ? $request->input('toiiuc') : 0;
//        $time->fromiiuc = $request->input('fromiiuc') ? $request->input('fromiiuc') : 0;
//        $time->user_id = Admin::user()->id;
//        $time->save();
//        $success = array(
//            'success' => 'Bus Time Created Successfully!'
//        );
//        return redirect('/admin/auth/schedule/addtime')->with($success);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
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
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
//        $time = Time::find($id);
//
//        //Check for correct user
//
//        if (Admin::user()->id !== $time->user_id) {
//            return redirect('/admin/auth/schedule/addtime')->with('error', 'Unauthorized Access Denied!');
//        }
//        /* if($BusRoute->cover_image != 'noimage.jpeg' ){
//            //Delete Image From Windows Directory
//            Storage::delete('public/cover_images/'.$BusRoute->cover_image);
//        } */
//
//        // Check other Tables if the time is used
//        $points = DB::table('points')->where('routeid', $id)->first();
//        $name = $time->time;
//        if ($points) {
//            if ($points->routeid == $id) {
//                return redirect('/admin/auth/schedule/addtime')->with('error', '"' . $name . '" => This Bus Route has assigned one or more bus stop point. Delete all bus stop point related to the route. Then delete the route.');
//            } else {
//                return redirect('/admin/auth/schedule/addtime')->with('error', '"' . $name . '" => Something went worng!!');
//
//            }
//        } else {
//            $time->delete();
//            return redirect('/admin/auth/schedule/addtime')->with('success', '" ' . $name . ' " => Bus Time Removed Successfully!');
//        }
    }
}
