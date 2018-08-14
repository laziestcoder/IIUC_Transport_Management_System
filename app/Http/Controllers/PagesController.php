<?php

namespace App\Http\Controllers;


use App\BusRoute;
use App\Day;
use App\Notice;
use App\Schedule;
use App\Time;
use Carbon\Carbon;
use Mail;
use DB;
use Illuminate\Http\Request;



class PagesController extends Controller
{
    public function index()
    {
        $title = 'Welcome to IIUC Transport Management System';

        // Latest News
        $noticetitle = 'Latest News';
        $notices = Notice::orderBy('id', 'desc')->paginate(4);
        $description = "";

        //Time and Today
        $now = Carbon::now()->format('H:i:s');
        $today = Carbon::today()->format('l');


        //Next Bus
        $times = Time::where('time', '>=', $now)->orderBy('time')->get();
        $todayid = Day::where('dayname', $today)->first();
        if($todayid){
            $todayid = $todayid->id;
        }

//        if ($now >= $theTime){
//            $today = Carbon::tomorrow()->format('l');
//            $todayid = Day::where('dayname', $today)->first()->id;
//        }

        // Get Route Information
        function getRoute($times, $todayid, $direction, $gender)
        {
            if (count($times) > 0) {
                foreach ($times as $time) {
//                    $check = Time::where('id', $time->id)->where($direction,1)->get();
//                    if($check) {
                        $nowid = $time->id;
                        $route = Schedule::where('day', $todayid)
                            ->where('time', $nowid)
                            ->where($direction, 1)
                            ->where($gender, 1)
                            ->first();
                        if ($route == true) {
                            return $route;
                            //return var_dump($route);
                        }
                    }
                    return false;
//                }
//                return false;
            }
            return false;
        }

        //Route Name Retrive From Table
        function getRouteName($id)
        {
            return BusRoute::where('id', $id)->first()->routename;
        }

        // Time Retreive From Table
        function getTime($id)
        {
            return Carbon::parse(Time::where('id', $id)->first()->time)->format('g:i A');
        }


        // To Campus
        // male

        $toIIUCMaleSchedule = getRoute($times, $todayid, 'toiiuc', 'male');
        //var_dump($toIIUCMaleSchedule !== false);


        if ($toIIUCMaleSchedule !== false ) //&& $now >= $theTime)
        {
            $toIIUCRouteM = getRouteName($toIIUCMaleSchedule->route);
            $toIIUCMale = getTime($toIIUCMaleSchedule->time);
        } else {
            $toIIUCRouteM = 'No Route Available';
            $toIIUCMale = 'No Time Available';
        }


        // From Campus
        //male
        $fromIIUCMaleSchedule = getRoute($times, $todayid, 'fromiiuc', 'male');
        //var_dump($fromIIUCMaleSchedule !== false);

        if ($fromIIUCMaleSchedule !== false)//&& $now >= $theTime)
        {
            $fromIIUCRouteM = getRouteName($fromIIUCMaleSchedule->route);
            $toCityMale = getTime($fromIIUCMaleSchedule->time);
        } else {
            $fromIIUCRouteM = 'No Route Available';
            $toCityMale = 'No Time Available';
        }


        //To Campus
        // female
        $toIIUCFemaleSchedule = getRoute($times, $todayid, 'toiiuc', 'female');
        //var_dump($toIIUCFemaleSchedule !== false);

        if ($fromIIUCMaleSchedule !== false && $now <= "12:00:00")
        {
            $toIIUCRouteF = getRouteName($toIIUCFemaleSchedule->route);
            $toIIUCFemale = getTime($toIIUCFemaleSchedule->time);
        } else {
            $toIIUCRouteF = 'No Route Available';
            $toIIUCFemale = 'No Time Available';
        }

        //From Campus
        // female
        $fromIIUCFemaleSchedule = getRoute($times, $todayid, 'fromiiuc', 'female');
        //var_dump($fromIIUCFemaleSchedule !== false);

        if ($fromIIUCFemaleSchedule !== false && $now <= "2:30:00")
        {
            $fromIIUCRouteF = getRouteName($fromIIUCFemaleSchedule->route);
            $toCityFemale = getTime($fromIIUCFemaleSchedule->time);
        } else {
            $fromIIUCRouteF = 'No Route Available';
            $toCityFemale = 'No Time Available';
        }

        // Todays Schedule
        $day = Day::where('dayname', $today)->first();
        $timeAll = Time::orderBy('time')->get();
        $schedules = Schedule::where('day', $day->id)->get();
        //$males = Schedule::where('male','1');
        //$females = Schedule::where('female','1');


        $data = array(
            'titile' => $title,
            'noticetitle' => $noticetitle,
            'notices' => $notices,
            'description' => $description,
            'today' => $today,
            'now' => Carbon::now()->format('g:i A'),


            //NEXT BUS Informations

            'toIIUCMale' => $toIIUCMale,// ? $toIIUCMale : 'NOT AVAILABLE',
            'toCityMale' => $toCityMale,// ? $toCityMale : 'NOT AVAILABLE',
            'fromRouteM' => $toIIUCRouteM,//== 'AK Khan' ? $fromRouteM : 'All Route',
            'toRouteM' => $fromIIUCRouteM,//== 'AK Khan' ? $toRouteM : 'All Route',

            'toIIUCFemale' => $toIIUCFemale,// ? $toIIUCFemale : 'NOT AVAILABLE',
            'toCityFemale' => $toCityFemale,// ? $toCityFemale : 'NOT AVAILABLE',
            'fromRouteF' => $toIIUCRouteF,//== 'AK Khan' ? $fromRouteF : 'All Route',
            'toRouteF' => $fromIIUCRouteF,//== 'AK Khan' ? $toRouteF : 'All Route',

            //Todays Schedules Informations
            //'males' => $males,
            // 'females' => $females,
            'day' => $day,
            'times' => $timeAll,
            //'schedules' => $schedules,

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
    // Report
    public function report(Request $request)
    {
        $this->validate($request ,[
            'name' => 'required|string', 
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required|string', 
        ]);

        Mail::send('mails.report',[
            'msg' => $request->message,
            'phone' => $request->phone,
            'email' => $request->email,
            'name' => $request->name,
        ], function($mail) use($request) {
            $mail->from( $request->email, $request->name);
            $mail->to('towfiq.projects@gmail.com','IIUC TMD')->subject('Report Message From ITMS'); 
        });
        
        return redirect('/#contact')->with('success_flash_message', $request->name.', Thank you for your message.');
        
        //dd($request->all());

        //return view('mails.report');

    }

    //Test Page
    public function test()
    {
        $data = array(
            'title' => 'Services',
            'services' => ['Transportation', 'Travelling', 'Picnic']
        );
        return view('pages.test')->with($data);
    }

}
