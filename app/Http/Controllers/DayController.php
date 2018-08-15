<?php

namespace App\Http\Controllers;

use App\Day;
use DB;
use Illuminate\Http\Request;

class DayController extends Controller
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
            'title' => 'Bus Day Information',
            'titleinfo' => 'Available Bus Day',
            'newday' => 'Add Bus Day',
            'days' => Day::orderBy('id')->paginate(15),
        );
        return view('schedule.day')->with($data);
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
            'day' => 'required|string',
        ]);

        //Create BusRoute
        $day = new Day;
        $day->dayname = $request->input('day');
        $day->user_id = Admin::user()->id;
        $day->save();
        $name = $day->dayname;
        $data = array(
//            'newday' => 'Add Bus Day',
            'success' => $name . ' => Bus Day Added Successfully!'
        );

        return redirect('/admin/auth/newday')->with($data);
        //return redirect('/admin/auth/routes/create')->with('success');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        $day = Day::find($id);

        //Check for correct user

//        if (Admin::user()->id !== $day->user_id) {
//            return redirect('/admin/auth/addtime')->with('error', 'Unauthorized Access Denied!');
//        }
        /* if($BusRoute->cover_image != 'noimage.jpeg' ){
            //Delete Image From Windows Directory
            Storage::delete('public/cover_images/'.$BusRoute->cover_image);
        } */

        // Check other Tables if the time is used
        $points = null;
        $name = $day->dayname;
        if (!$points && $points) {
            if ($points->routeid == $id) {
                return redirect('/admin/auth/addtime')->with('error', '"' . $name . '" => This Bus Route has assigned one or more bus stop point. Delete all bus stop point related to the route. Then delete the route.');
            } else {
                return redirect('/admin/auth/addtime')->with('error', '"' . $name . '" => Something went worng!!');

            }
        } else {
            $day->delete();
            return redirect('/admin/auth/newday')->with('success', '" ' . $name . ' " => Bus Day Removed Successfully!');
        }
    }
}
