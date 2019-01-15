<?php

use App\ModelList;
use Illuminate\Database\Seeder;

class ModelListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelList::truncate();
        ModelList::insert([
            [
                'model_name' => 'AdminDashboard',
                'table_name' => 'dashboard',
            ],
            [
                'model_name' => 'BusInfo',
                'table_name' => 'businfo',
            ],
            [
                'model_name' => 'BusPoint',
                'table_name' => 'points',
            ],
            [
                'model_name' => 'BusRoute',
                'table_name' => 'routes',
            ],
            [
                'model_name' => 'BusType',
                'table_name' => 'bus_type',
            ],
            [
                'model_name' => 'CsvData',
                'table_name' => 'csv_data',
            ],
            [
                'model_name' => 'Day',
                'table_name' => 'day',
            ],
            [
                'model_name' => 'Driver',
                'table_name' => 'driverinfo',
            ],
            [
                'model_name' => 'EmergencyContact',
                'table_name' => 'emergency_contact',
            ],
            [
                'model_name' => 'Helper',
                'table_name' => 'helperinfo',
            ],
            [
                'model_name' => 'ModelList',
                'table_name' => 'model_list',
            ],
            [
                'model_name' => 'Notice',
                'table_name' => 'notices',
            ],
            [
                'model_name' => 'Schedule',
                'table_name' => 'schedule',
            ],
            [
                'model_name' => 'StudentSchedule',
                'table_name' => 'schedulestudent',
            ],
            [
                'model_name' => 'Time',
                'table_name' => 'time',
            ],
            [
                'model_name' => 'User',
                'table_name' => 'users',
            ],
            [
                'model_name' => 'UserType',
                'table_name' => 'user_type',
            ],
        ]);
    }
}
