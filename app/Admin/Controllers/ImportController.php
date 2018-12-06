<?php

namespace App\Admin\Controllers;
use App\
AdminDashboard;
use App\
BusInfo;
use App\
BusPoint;
use App\
BusRoute;
use App\
BusStudentInfo;
use App\
BusType;
use App\
CsvData;
use App\
Day;
use App\
Driver;
use App\
EmergencyContact;
use App\
GetTableColumns;
use App\
Helper ;
use App\
ModelList;
use App\
Notice;
use App\
Schedule;
use App\
StudentSchedule;
use App\
Time;
use App\
User;
use App\
UserRole ;

use App\Http\Requests\CsvImportRequest;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;


class ImportController extends Controller
{

    public function getImport()
    {
        $data = array(
            'models' => ModelList::all(),
            'allModels' =>  $allModels = $this->getModels(app_path()),
        );
        return view('import.import')->with($data);
    }

    public function parseImport(CsvImportRequest $request)
    {

        $path = $request->file('csv_file')->getRealPath();
//        $models = ModelList::all();
        if ($request->has('header')) {
            $data = Excel::load($path, function ($reader) {
            })->get()->toArray();
        } else {
            $data = array_map('str_getcsv', file($path));
        }

        if (count($data) > 0) {
            if ($request->has('header')) {
                $csv_header_fields = [];
                foreach ($data[0] as $key => $value) {
                    $csv_header_fields[] = $key;
                }
            }
            $csv_data = array_slice($data, 0);
            $file = $request->file('csv_file')->getClientOriginalName();
            $model_name = $request->model_name;
            $csv_table_name = pathinfo($file, PATHINFO_FILENAME);
            //$extension = pathinfo($file, PATHINFO_EXTENSION);
            $field_names = DB::getSchemaBuilder()->getColumnListing($csv_table_name);
            CsvData::truncate();
            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data),
            ]);
        } else {
            return redirect()->back();
        }
        $dataArray = array(
            //'models' => $models,
            'csv_header_fields' => $csv_header_fields,
            'csv_data' => $csv_data,
            'csv_data_file' => $csv_data_file,
            'csv_table_name' => $csv_table_name,
            'model_name' => $model_name,
            'field_names' => $field_names,
        );

        return view('import.import_fields')->with($dataArray); //compact( 'csv_header_fields', 'csv_data', 'csv_data_file','csv_table_name','field_names'));

    }

    public function processImport(Request $request)
    {
        $path = app_path();
        $data = CsvData::find($request->csv_data_file_id);
        $table_name = $request->csv_data_file_name;
        $model_name = $request->model_name;
        $allModels = $this->getModels($path);
        $csv_data = json_decode($data->csv_data, true);
        //$entry_data = new BusType();
        $field_names = DB::getSchemaBuilder()->getColumnListing($table_name);
        foreach ($csv_data as $row) {
            $flag = True;
            //$model_name = get_class($model_name);
            switch ($model_name) {
                case 'AdminDashboard': $entry_data = new AdminDashboard(); break;
                case 'BusInfo': $entry_data = new BusInfo(); break;
                case 'BusPoint': $entry_data = new BusPoint(); break;
                case 'BusRoute': $entry_data = new BusRoute(); break;
                case 'BusStudentInfo': $entry_data = new BusStudentInfo(); break;
                case 'BusType': $entry_data = new BusType(); break;
                case 'CsvData': $entry_data = new CsvData(); break;
                case 'Day': $entry_data = new Day(); break;
                case 'Driver': $entry_data = new Driver(); break;
                case 'EmergencyContact': $entry_data = new EmergencyContact(); break;
                case 'Helper': $entry_data = new Helper(); break;
                case 'ModelList': $entry_data = new ModelList(); break;
                case 'Notice': $entry_data = new Notice(); break;
                case 'Schedule': $entry_data = new Schedule(); break;
                case 'StudentSchedule': $entry_data = new StudentSchedule(); break;
                case 'Time': $entry_data = new Time(); break;
                case 'User': $entry_data = new User(); break;
                case 'UserRole': $entry_data = new UserRole(); break;
                default:
                    $flag = false;
                    break;
            }

            //$entry_data = new BusType();
            //$field_names =  Schema::getColumnListing($entry_data);
            //foreach (config('app.db_fields') as $index => $field) {
            if ($flag) {
                foreach ($field_names as $index => $field) {
                    if ($field != 'id') {
                        if ($data->csv_header) {
                            $entry_data->$field = $row[$request->fields[$field]];
                        } else {
                            $entry_data->$field = $row[$request->fields[$index]];
                        }
                    }
                }

                $entry_data->save();
            }
        }
        $dataArray = array(
            'fieldNames' => $field_names,
            'table' => $table_name,
            'model' => $model_name,
            'allModels' => $allModels,
        );

        return view('import.import_success')->with($dataArray);
    }


    public function getModels($path)
    {
        $out = [];
        $results = scandir($path);
        foreach ($results as $result) {
            if ($result === '.' or $result === '..') continue;
            //$filename = '\\App' . '\\' . $result;
            $filename = $result;

            if (is_dir($filename)) {
                $out = array_merge($out, $this->getModels($filename));
            } else {
                $out[] = substr($filename, 0, -4);
            }
        }
        return $out;
    }

}
