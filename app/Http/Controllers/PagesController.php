<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to IIUC Transport Management System';
        //return  view('pages.index',compact('title'));
        return  view('pages.index',compact('title','Welcome to IIUC Transport Division Website'));
    }
    public function about(){
        $title = 'About Us';
        return  view('pages.about')->with('title',$title);
    }
    public function services(){
        $data = array (
            'title' => 'Services',
            'services' => ['Transportation', 'Travelling', 'Picnic']
        );
        return  view('pages.services')->with($data);
    }
    public function test(){
        $data = array (
            'title' => 'Services',
            'services' => ['Transportation', 'Travelling', 'Picnic']
        );
        return  view('pages.test')->with($data);
    }

}
