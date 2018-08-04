<?php

namespace App\Http\Controllers;


use App\BusRoute;
use App\Notice;
use DB;
use App\Schedule;
use Carbon\Carbon;
use App\Day;
use App\Time;

class PagesController extends Controller
{
    public function index()
    {
        $toIIUCMale = 'To IIUC Male';
        $toIIUCFemale = 'To IIUC Female';
        $toCityMale = 'To City Male';
        $toCityFemale = 'To City Female';
        $fromRouteM = 'From Route Male';
        $fromRouteF = 'From Route Female';
        $toRouteM ='To Route Male';
        $toRouteF ='To Route Female';


        $title = 'Welcome to IIUC Transport Management System';

        $noticetitle = 'Latest News';
        $notices = Notice::orderBy('id', 'desc')->paginate(4);
        $description = "";

        // Todays Schedule
        $today = Carbon::today()->format('l');
        $males = Schedule::where('male','1');
        $females = Schedule::where('female','1');

        //Next Bus
        $now = Carbon::now()->format('g:i A');
        $todayid = Day::where('dayname',$today)->first()->id;

        // To Campus
        // male
        $fromRouteM=Schedule::where('male', 1)
            ->where( 'toiiuc',1)
            ->where( 'day', $todayid )
            ->where( 'time' ,'>', $now  )
            ->first()->route;
        $fromRouteM = BusRoute::where('id',$fromRouteM)->first()->routename;

        $time=Schedule::where('male', 1)
            ->where( 'toiiuc',1)
            ->where( 'day', $todayid )
            ->where( 'time' ,'>', $now  )
            ->first()->time;

        $toIIUCMale=Carbon::parse(Time::where('id', $time )->first()->time)->format('g:i A');

        // female
        $fromRouteF=Schedule::where('female', 1)
            ->where( 'toiiuc',1)
            ->where( 'day', $todayid )
            ->where( 'time' ,'>', $now  )
            ->first()->route;
        $fromRouteF = BusRoute::where('id',$fromRouteF)->first()->routename;
        $time=Schedule::where('female', 1)
            ->where( 'toiiuc',1)
            ->where( 'day', $todayid )
            ->where( 'time' ,'>', $now  )
            ->first()->time;

        $toIIUCFemale=Carbon::parse(Time::where('id', $time )->first()->time)->format('g:i A');;

        // To City
        //male
        $toRouteM=Schedule::where('male', 1)
            ->where( 'fromiiuc',1)
            ->where( 'day', $todayid )
            ->where( 'time' ,'>', $now  )
            ->first()->route;
        $toRouteM = BusRoute::where('id',$toRouteM)->first()->routename;
        $time=Schedule::where('male', 1)
            ->where( 'fromiiuc',1)
            ->where( 'day', $todayid )
            ->where( 'time' ,'>', $now  )
            ->first()->time;
        $toCityMale =Carbon::parse(Time::where('id', $time )->first()->time)->format('g:i A');;


        // female
        $toRouteF=Schedule::where('female', 1)
            ->where( 'fromiiuc',1)
            ->where( 'day', $todayid )
            ->where( 'time' ,'>', $now  )
            ->first()->route;
        $toRouteF = BusRoute::where('id',$toRouteF)->first()->routename;
        $time=Schedule::where('female', 1)
            ->where( 'fromiiuc',1)
            ->where( 'day', $todayid )
            ->where( 'time' ,'>', $now  )
            ->first()->time;

        $toCityFemale =Carbon::parse(Time::where('id', $time )->first()->time)->format('g:i A');;

        $data = array(
            'titile' => $title,
            'noticetitle' => $noticetitle,
            'notices' => $notices,
            'description' => $description,
            'males' => $males,
            'females' => $females,
            'toIIUCMale'=>$toIIUCMale ? $toIIUCMale : 'NOT AVAILABLE',
            'toIIUCFemale'=>$toIIUCFemale ? $toIIUCFemale : 'NOT AVAILABLE',
            'toCityMale'=>$toCityMale ? $toCityMale : 'NOT AVAILABLE',
            'toCityFemale'=>$toCityFemale ? $toCityFemale : 'NOT AVAILABLE',
            'fromRouteM'=> $fromRouteM == 'AK Khan' ? $fromRouteM : 'All Route',
            'fromRouteF'=> $fromRouteF == 'AK Khan' ? $fromRouteF : 'All Route',
            'toRouteM'=> $toRouteM ,//== 'AK Khan' ? $toRouteM : 'All Route',
            'toRouteF'=> $toRouteF ,//== 'AK Khan' ? $toRouteF : 'All Route',
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
    public function todaysSchedule()
    {
        $data = array(

        );
        return view('pages.index')->with($data);

    }
    public function test()
    {
        $data = array(
            'title' => 'Services',
            'services' => ['Transportation', 'Travelling', 'Picnic']
        );
        return view('pages.test')->with($data);
    }

}
