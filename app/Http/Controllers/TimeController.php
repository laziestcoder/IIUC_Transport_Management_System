<?php

namespace App\Http\Controllers;

use App\Time;
use Carbon\Carbon;
use DB;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;

class TimeController extends Controller
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
            'title' => 'Bus Time Information',
            'titleinfo' => 'Available Bus Time',
            'addtime' => 'Add Bus Time',
            'times' => Time::orderBy('time')->paginate(20),
        );
        return view('schedule.time')->with($data);
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
        $this->validate($request, [
            'time' => 'required|date_format:H:i',
        ]);

        //Create BusRoute
        $time = new Time;
        $time->time = $request->input('time');
        $time->toiiuc = $request->input('toiiuc') ? $request->input('toiiuc') : 0;
        $time->fromiiuc = $request->input('fromiiuc') ? $request->input('fromiiuc') : 0;
        $time->user_id = Admin::user()->id;
        $time->save();
        $success = array(
            'success' => 'Bus Time Created Successfully!'
        );
        return redirect("/admin/auth/addtime")->with($success);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Time $time
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Time $time
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Time $time
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Time $time
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $time = Time::find($id);

        //Check for correct user

        if ((Admin::user()->id !== $time->user_id) && !(DB::table('admin_role_users')->where('user_id', (Admin::user()->id))->first()->role_id <= 1)) {
            return redirect('/admin/auth/addtime')->with('error', 'Unauthorized Access Denied!');
        }
        /* if($BusRoute->cover_image != 'noimage.jpeg' ){
            //Delete Image From Windows Directory
            Storage::delete('public/cover_images/'.$BusRoute->cover_image);
        } */

        // Check other Tables if the time is used
        $points = null;
        $name = Carbon::parse($time->time)->format('g:i A');
        if ($points) {
            if ($points->routeid == $id) {
                return redirect('/admin/auth/addtime')->with('error', '"' . $name . '" => This Bus Route has assigned one or more bus stop point. Delete all bus stop point related to the route. Then delete the route.');
            } else {
                return redirect('/admin/auth/addtime')->with('error', '"' . $name . '" => Something went worng!!');

            }
        } else {
            $time->delete();
            return redirect('/admin/auth/addtime')->with('success', '" ' . $name . ' " => Bus Time Removed Successfully!');
        }
    }
}
