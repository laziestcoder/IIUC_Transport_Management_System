<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index');
    $router->resource('/auth/students', 'StudentController');
    $router->resource('/auth/teachers', 'FacultyController');
    $router->resource('/auth/officer-staff', 'OfficerController');
    $router->resource('/auth/bus-route-info', 'BusRouteStudentInfoController');
    $router->resource('/auth/bus', 'BusInfoController');
    $router->resource('/auth/driver', 'DriverInfoController');
    $router->resource('/auth/helper', 'HelperInfoController');
    $router->resource('/auth/user-role', 'UserRoleController');
    $router->resource('/auth/transport-notice', 'NoticeController');
    $router->resource('/auth/bus-type', 'BusTypeController');
    $router->resource('/auth/bus-schedule', 'BusScheduleController');
});
