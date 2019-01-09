<?php

namespace App\Http\Controllers;
//namespace App\Admin\Controllers;

use App\BusPoint;
use App\BusRoute;
use App\BusStudentInfo;
use App\Day;
use App\Schedule;
use App\Time;
use Carbon\Carbon;
use DB;
use Encore\Admin\Controllers\HasResourceActions;
use Illuminate\Http\Request;
use PDF;


class PDFConverterController extends Controller
{
    use HasResourceActions;


    public function busSchedulePdf(Request $request)
    {
        $data = array(
            'schedules' => Schedule::all(),
            'title' => 'Bus Schedule Print',
            'description' => 'Here you will get available bus schedule information. You can also remove and edit Bus Schedules.',
            'titlenew' => 'Create New Schedule',
            'titleinfo' => 'Available Schedule',
            'times' => Time::all('id', 'time'),
            'days' => Day::all('id', 'dayname'),
            'points' => BusPoint::all('id', 'pointname'),
        );
        //view()->share('users',$users);
        view()->share($data);

        if ($request->has('download')) {
            // Set extra option
            //PDF::setOptions(['dpi' => 45, 'defaultFont' => 'sans-serif']);
            //set paper orientation
            //PDF::setPaper('a4', 'landscape');
            // pass view file
            $pdf = PDF::loadView('printPDF.busSchedule');
            // download pdf
            return $pdf->download('busSchedule.pdf');
        }
        return view('printPDF.busSchedule')->with($data);
    }

    public function busScheduleFriday(Request $request)
    {
        $data = array(
            'schedules' => Schedule::all(),
            'title' => 'Bus Schedule Print',
            'description' => 'Here you will get available bus schedule information. You can also remove and edit Bus Schedules.',
            'titlenew' => 'Create New Schedule',
            'titleinfo' => 'Available Schedule',
            'times' => Time::all('id', 'time'),
            'days' => Day::all('id', 'dayname'),
            'points' => BusPoint::all('id', 'pointname'),
        );
        //view()->share('users',$users);
        view()->share($data);

        if ($request->has('download')) {
            // Set extra option
            PDF::setOptions(['dpi' => 600, 'defaultFont' => 'sans-serif', 'font-size' => '12']);
            //set paper orientation
            //PDF::setPaper('a4', 'landscape');
            // pass view file
            $pdf = PDF::loadView('printPDF.busScheduleFriday');
            // download pdf
            return $pdf->download('busSchedule.pdf');
        }
        return view('printPDF.busScheduleFriday')->with($data);
    }

    public function busRequiremenrForTomorrow(Request $request)
    {
        $today = Carbon::tomorrow()->format('l');
        //$busInfo = BusInfo::all('id','active');
        // $affected = DB::table('table')->update(array('confirmed' => 1));
        // $affected = DB::table('table')->where('confirmed', '=', 0)->update(array('confirmed' => 1));
        $busInfo = DB::table('businfo')->where('availability', '=', 0)->update(array('availability' => 1));
        $data = array(
            'title' => 'Bus Requiremet Print',
            'routes' => BusRoute::orderBy('routename')->where('active', true)->where('routename', '!=', 'All Route')->get(),
            'days' => Day::all(),
            'times' => Time::orderBy('time')->get(),
            'today' => $today,
            'todayid' => Day::all()->where('dayname', $today)->first(),
            'datas' => BusStudentInfo::all(),
            //'bus_available' => BusInfo::orderBy('seat','asc')->where('availability', 1)->get(),

        );

        //view()->share('users',$users);
        view()->share($data);

        if ($request->has('download')) {
            // Set extra option
            PDF::setOptions(['dpi' => 600, 'defaultFont' => 'sans-serif', 'font-size' => '10']);
            //set paper orientation
            //PDF::setPaper('a4', 'landscape');
            // pass view file
            $pdf = PDF::loadView('printPDF.tomorrowsBusRequirement');
            // download pdf
            return $pdf->download($today . 'BusRequirementInformation.pdf');
        }
        return view('printPDF.tomorrowsBusRequirement')->with($data);
    }

//    public function export_pdf($model,$fileName)
//    {
//        // Fetch all customers from database
//        $data = $model::get();
//        // Send data to the view using loadView function of PDF facade
//        $pdf = PDF::loadView('pdf.customers', $data);
//        // If you want to store the generated pdf to the server then you can use the store function
//        $pdf->save(storage_path().'_filename.pdf');
//        // Finally, you can download the file using download function
//        return $pdf->download($fileName.'.pdf');
//    }

//    public function htmltopdfview(Request $request)
//    {
//        if($request->has('download')) {
//            $products = $request->input('download');
//
//        }/*else{
//            $products = [];
//        }*/
//        view()->share('products',$products);
//
//        if($request->has('download')){
//            //PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
//            //PDF::setPaper('a4', 'landscape');
//            //setWarnings(false)->save('myfile.pdf')
//            $pdf = PDF::loadView('pages.test');
//            //$pdf = PDF::loadView('pages.test',$products);
//            return $pdf->download('test.pdf');
//        }
//        return view('test.test');
//    }

//    public function pdfview(Request $request)
//    {
//        $users = DB::table("routes")->get();
//        view()->share('users',$users);
//
//        if($request->has('download')){
//            // Set extra option
//            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
//            //set paper orientation
//            PDF::setPaper('a4', 'landscape');
//            // pass view file
//            $pdf = PDF::loadView('test.pdfview');
//            // download pdf
//            return $pdf->download('pdfview.pdf');
//        }
//        return view('testpdf.pdfview');
//    }

}
