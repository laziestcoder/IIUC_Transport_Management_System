<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Notice;
use DB;

class NoticesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show'] ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all ();
        // $posts =  Post::orderBy('title','Post Two')->get();
        // $posts = DB::select('SELECT * FROM posts');
        // $posts =  Post::orderBy('id','desc')->take(1)->get();
        // $posts =  Post::orderBy('id','desc')->get();
        $title = 'Notices';
        $notices =  Notice::orderBy('id','desc')->paginate(25);
        $data = array(
            'title' => $title,
            'notices' => $notices
        );
        return view('notices.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data = array(
            'title' => 'Create Notice',
            'notices' => ''
        );
        return view('notices.create')->with($data);  
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
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //Handle File Upload

         if($request->hasFile('cover_image'))
        {
            //Get Filename with extension
            $filenameWithExt = $request -> file('cover_image')->getClientOriginalName();
            
            // Get just file name
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

            // Get just file extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // File name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            
            //uload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);

        }
        else 
        {
            $fileNameToStore ='noimage.jpeg';
        } 

        //Create Post
        $notice = new Notice;
        $notice->title = $request->input('title');
        $notice->body = $request->input('body');
        $notice->user_id = auth()->user()->id;
        $notice->cover_image = $fileNameToStore;
        //$post->cover_image = 'noimage.jpeg';
        $notice->save();
        return redirect('/notices')->with('success','Notice Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notice = Notice::find($id);
        return view('notices.show')->with('notice',$notice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notice = Notice::find($id);
        
        //Check for correct user

        if(auth()->user()->id !== $notice->user_id){
            return redirect('/notices')->with('error','Unauthorized Access Denied!');

        }

        // Edit notice
        
        $data = array(
            'title' => 'Edit Notice',
            'notice' => $notice
        );
        return view('notices.edit')->with($data);
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
            'notices' => $notices
        );
        return view('notices.update')->with($data); */
        
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);
        //Update Post
        //$post = new Post; //Handle File Upload

         if($request->hasFile('cover_image'))
         {
             //Get Filename with extension
             $filenameWithExt = $request -> file('cover_image')->getClientOriginalName();
             
             // Get just file name
             $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
 
             // Get just file extension
             $extension = $request->file('cover_image')->getClientOriginalExtension();
 
             // File name to store
             $fileNameToStore = $filename.'_'.time().'.'.$extension;
             
             //uload image
             $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
 
         }

        $notice = Notice::find($id);
        $notice->title = $request->input('title');
        $notice->body = $request->input('body');
        if($request->hasFile('cover_image'))
         {  
             $notice->cover_image = $fileNameToStore;
         }
        $notice->save();
        return redirect('/notices/'.$id)->with('success','notice Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notice = Notice::find($id);

        //Check for correct user

        if(auth()->user()->id !== $notice->user_id){
            return redirect('/notices')->with('error','Unauthorized Access Denied!');

        }
        if($notice->cover_image != 'noimage.jpeg' ){
            //Delete Image From Windows Directory
            Storage::delete('public/cover_images/'.$notice->cover_image);
        }

        $notice->delete();
        return redirect('/notices')->with('success','notice Removed Successfully!');
    
    }
}
