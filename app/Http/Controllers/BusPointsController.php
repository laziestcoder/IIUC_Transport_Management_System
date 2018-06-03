<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Encore\Admin\Facades\Admin;
use App\BusRoute;
use App\BusPoint;
use DB;

class BusPointsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add Bus Stop Point';
        $titleInfo = 'Available Bus Stop Points';
        $BusRoutes = BusRoute::orderBy('routename')->get();
        $BusPoints = BusPoint::orderBy('pointname')->paginate(20);
        $data = array(
            'title' => $title,
            'BusRoutes' => $BusRoutes,
            'titleinfo' => $titleInfo,
            'BusPoints' => $BusPoints,
        );
        //dd($data);
        //return view('buspoints.create',compact('data')); 
        return view('buspoints.create')->with($data);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'routename' => 'required|integer',
            'pointname' => 'required|string',
        ]);

        //Create BusRoute
        $BusPoint = new BusPoint;
        $BusPoint->pointname = $request->input('pointname');
        $BusPoint->routeid = $request->input('routename');
        $BusPoint->user_id = Admin::user()->id;
        
        $BusPoint->save();
        return redirect('/admin/auth/points/create')->with('success','Bus Stop Point Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $BusPoint = BusPoint::find($id);
        //return view('buspoints.show')->with('BusPoint',$BusPoint);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Bus Stop Point';
        $titleInfo = 'Available Bus Stop Points';
        $BusPoint = BusPoint::find($id);
        $BusRoutes = BusRoute::orderBy('routename')->get();
        $BusPoints = BusPoint::orderBy('pointname')->paginate(20);
        $data = array(
            'title' => $title,
            'BusRoutes' => $BusRoutes,
            'titleinfo' => $titleInfo,
            'BusPoints' => $BusPoints,
            'BusPoint' => $BusPoint,
        );
        //Check for correct user
        /* if(Admin::user()->id !== $BusRoute->user_id)
        {
            return redirect('/admin/auth/routes/create')->with('error','Unauthorized Access Denied!');
        } */
        return view('buspoints.edit')->with($data); 

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
       /*  $data = array(
            'title' => $title,
            'posts' => $posts
        );
        return view('posts.update')->with($data); */
        
        $this->validate($request, [
            'routename' => 'required|integer',
            'pointname' => 'required|string'
        ]);

        $BusPoint = BusPoint::find($id);
        $BusPoint->pointname = $request->input('pointname');
        $BusPoint->routeid = $request->input('routename');
        if(Admin::user()->id !== $BusPoint->user_id){
            $BusPoint->user_id = Admin::user()->id;
        }
        $BusPoint->save();
        return redirect('/admin/auth/points/create/')->with('success','Bus Stop Point Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $BusPoint = BusPoint::find($id);

        //Check for correct user

        if(Admin::user()->id !== $BusPoint->user_id)
        {
            return redirect('/admin/auth/points/create/')->with('error','Unauthorized Access Denied!');
        }
        /* if($BusRoute->cover_image != 'noimage.jpeg' ){
            //Delete Image From Windows Directory
            Storage::delete('public/cover_images/'.$BusRoute->cover_image);
        } */

        $BusPoint->delete();
        return redirect('/admin/auth/points/create/')->with('success','Bus Stop Point Removed Successfully!');
    }

    /* public function adminName($id){
        //$users = Admin::name()->where;
        $user = DB::table('admin_users')->where('id', $id)->first();
        return $user->name;
    } */
}
