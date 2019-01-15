<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('admin.index');
    $router->get('/auth/import', 'ImportController@getImport')->name('import');
    $router->post('/auth/import_parse', 'ImportController@parseImport')->name('import_parse');
    $router->post('/auth/import_process', 'ImportController@processImport')->name('import_process');

    //Admin Panel Controllers Routing 
    // $router->resource('users', UserController::class);
    $router->resource('/auth/users', 'UserController');
    $router->resource('/auth/messages', 'MessageController');

    //Other Admin Controllers 
    // $router->resource('/auth', AuthController::class);
    // $router->resource('/helpers/routes', 'RouteController');
    // $router->resource('/helpers/terminal/database', 'TerminalController');
    // $router->resource('/helpers/scaffold', 'ScaffoldController');

    // Admin Auth Controller
    $authController = config('admin.auth.controller', AuthController::class);

    /* @var \Illuminate\Routing\Router $router */
    $router->get('auth/login', $authController.'@getLogin')->name('login');
    $router->post('auth/login', $authController.'@postLogin')->name('post.login');
    $router->get('auth/logout', $authController.'@getLogout')->name('get.logout');
    $router->get('auth/setting', $authController.'@getSetting')->name('get.Setting');
    $router->put('auth/setting', $authController.'@putSetting')->name('put.Setting');


    // Admin Other Controllers Routing
    $router->resource('/auth/admin-dashboard', 'AdminDashboardController');
    $router->resource('/auth/emergency-contact', 'EmergencyContactsController');
    $router->resource('/auth/students', 'StudentController');
    $router->resource('/auth/teachers', 'FacultyController');
    $router->resource('/auth/officer-staff', 'OfficerController');
    $router->resource('/auth/other-users', 'OtherUsersController');
    $router->resource('/auth/bus-route-info', 'StudentBusroutingInfoController');
    $router->resource('/auth/bus', 'BusInfoController');
    $router->resource('/auth/driver', 'DriverInfoController');
    $router->resource('/auth/helper', 'HelperInfoController');
    $router->resource('/auth/user-type', 'UserTypeController');
    $router->resource('/auth/transport-notice', 'NoticeController');
    $router->resource('/auth/bus-type', 'BusTypeController');
    $router->resource('/auth/bus-schedule', 'BusScheduleController');
    $router->resource('/auth/point', 'PointsController');
    $router->resource('/auth/route', 'RoutesController');
    $router->resource('/auth/day', 'DaysController');
    $router->resource('/auth/time', 'TimesController');
    $router->resource('/auth/bus-student-info', 'BusStudentInfoController');

});


//Image Optimizer
Route::middleware('optimizeImages')->group(function () {
    // all images will be optimized automatically
    //Route::post('upload-images', 'UploadController@index');
    //Route::resource('/auth/transport-notice', 'NoticeController');
    //Route::resource('/auth/driver', 'DriverInfoController');
    //Route::resource('/auth/helper', 'HelperInfoController');

    //Route::resource('images', ImageController::class);
    //Route::resource('multiple-images', MultipleImageController::class);
    // Route::resource('files', FileController::class);
    // Route::resource('users', UserController::class);

});
