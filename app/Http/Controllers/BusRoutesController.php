<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Encore\Admin\Facades\Admin;
use App\BusRoute;
use DB;


class BusRoutesController extends Controller
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
        $title = 'Add Bus Route';
        $titleInfo = 'Available Bus Routes';
        $BusRoutes =  BusRoute::orderBy('routename')->paginate(20);
        $data = array(
            'title' => $title,
            'BusRoutes' => $BusRoutes,
            'titleinfo' => $titleInfo
        );
        return view('BusRoutes.create')->with($data);    
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
            'routename' => 'required|string',
        ]);

        //Create BusRoute
        $BusRoute = new BusRoute;
        $BusRoute->routename = $request->input('routename');
        $BusRoute->user_id = Admin::user()->id;
        $BusRoute->save();
        $success = array (
            'title' => 'Add Route for Bus',
            'message' => 'Bus Route Created Successfully!'
        );
        $name = $BusRoute->routename;
        return redirect('/admin/auth/routes/create')->with('success','"'.$name.'" => Bus Route Created Successfully!');
        //return redirect('/admin/auth/routes/create')->with('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $BusRoute = BusRoute::find($id);
        return view('busroutes.show')->with('BusRoute',$BusRoute);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Bus Route';
        $titleInfo = 'Available Bus Routes';
        $BusRoute = BusRoute::find($id);
        $BusRoutes = BusRoute::orderBy('routename')->paginate(20);
        $data = array(
            'title' => $title,
            'BusRoutes' => $BusRoutes,
            'titleinfo' => $titleInfo,
            'BusRoute' => $BusRoute
        );
        //Check for correct user
        /* if(Admin::user()->id !== $BusRoute->user_id)
        {
            return redirect('/admin/auth/routes/create')->with('error','Unauthorized Access Denied!');
        } */
        return view('busroutes.edit')->with($data); 

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
            'routename' => 'required|string',
        ]);

        $BusRoute = BusRoute::find($id);
        $name = $BusRoute->routename;
        $BusRoute->routename = $request->input('routename');
        $name2 = $BusRoute->routename;
        if(Admin::user()->id !== $BusRoute->user_id){
            $BusRoute->user_id = Admin::user()->id;
        }
        $BusRoute->save();
        return redirect('/admin/auth/routes/create/')->with('success','"'.$name.'" => Updated to "'.$name2.'". Bus Route Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $BusRoute = BusRoute::find($id);

        //Check for correct user

        if(Admin::user()->id !== $BusRoute->user_id)
        {
            return redirect('/admin/auth/routes/create/')->with('error','Unauthorized Access Denied!');
        }
        /* if($BusRoute->cover_image != 'noimage.jpeg' ){
            //Delete Image From Windows Directory
            Storage::delete('public/cover_images/'.$BusRoute->cover_image);
        } */
        $points = DB::table('points')->where('routeid', $id)->first();
        $name = $BusRoute->routename;
        if($points){
            if($points->routeid == $id){
                return redirect('/admin/auth/routes/create/')->with('error', '"'.$name.'" => This Bus Route has assigned one or more bus stop point. Delete all bus stop point related to the route. Then delete the route.');
            }
            else{
                return redirect('/admin/auth/routes/create/')->with('error', '"'.$name.'" => Something went worng!!');
            
            }
        }else{
            $BusRoute->delete();
            return redirect('/admin/auth/routes/create/')->with('success','"'.$name.'" => Bus Route Removed Successfully!');
        }
        
    }
}