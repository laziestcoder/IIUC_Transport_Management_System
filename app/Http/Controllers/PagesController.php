<?php

namespace App\Http\Controllers;


use App\Notice;
use DB;

class PagesController extends Controller
{
    public function index()
    {
        $title = 'Welcome to IIUC Transport Management System';
        //return  view('pages.index',compact('title'));
        // $posts = Post::all ();
        // $posts =  Post::orderBy('title','Post Two')->get();
        // $posts = DB::select('SELECT * FROM posts');
        // $posts =  Post::orderBy('id','desc')->take(1)->get();
        // $posts =  Post::orderBy('id','desc')->get();
        $noticetitle = 'Latest News';
        $notices = Notice::orderBy('id', 'desc')->paginate(25);
        $description = "";

        $data = array(
            'titile' => $title,
            'noticetitle' => $noticetitle,
            'notices' => $notices,
            'description' => $description
        );
        return view('pages.index')->with($data);
        //return  view('pages.index',compact('title','Welcome to IIUC Transport Division Website'));
    }
//    public function about(){
//        $title = 'About Us';
//        return  view('pages.about')->with('title',$title);
//    }
//    public function services(){
//        $data = array (
//            'title' => 'Services',
//            'services' => ['Transportation', 'Travelling', 'Picnic']
//        );
//        return  view('pages.services')->with($data);
//    }
    public function test()
    {
        $data = array(
            'title' => 'Services',
            'services' => ['Transportation', 'Travelling', 'Picnic']
        );
        return view('pages.test')->with($data);
    }

}
