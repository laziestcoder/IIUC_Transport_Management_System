<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/users/', function () {
    //return view('welcome');
    return view('pages.about');
}); */

/*  Route::post('/hello', function () {
    //return view('welcome');
    return "Hello World!";
});
 */

/*
Route::delete('/hello', function () {
   //return view('welcome');
   return "Hello World!";
});  */


/* Route::get('/', function () {
    return view('welcome');
});
 */


/* Route::get('/about', function () {
    //return view('welcome');
    return view('pages.about');
}); */


// Pages routing Index, About, Servces
Route::get('/', ['as'=> 'home page','uses'=>'PagesController@index']);
Route::get('404', ['as'=>'notfound','uses'=>'PagesController@pagenotfound']);
//Route::get('/about', 'PagesController@index');
//Route::get('/services', 'PagesController@index');
//Route::get('/test', ['as'=> 'test page','uses'=>'PagesController@test']);

// Report A Problem
Route::post('/report', ['as'=> 'user report to admin','uses'=>'PagesController@report']);
//Route::get('/contact-msg', ['as'=>'contact-msg','uses'=>'DashboardController@contact']);
//Route::post('/report', ['as' => 'report', 'uses' => 'PagesController@report']);

//Notice routing
//Route::get('/posts','PagesController@posts');

//Route::resource('/','NoticesController');


//Authorization Routing
Auth::routes();
//Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard', ['as'=> 'user dashboard','uses'=>'DashboardController@index']);
Route::resource('/management', 'ManagementController');
Route::get('/bus-schedules', ['as'=> 'user bus schedule','uses'=>'ManagementController@busSchedule']);
Route::get('/bus-routes', ['as'=> 'user bus route','uses'=>'ManagementController@busroutesdetails']);

//User Confirmation Routing
//Email Verification 1
//Route::get('/users/confirmation/{token}', 'Auth\RegisterController@confirmation')->name('confirmation');

//Email Verification 2
//Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify')->name('confirmation');


//Admin::routes();

Route::get('/admin/auth/routes', ['as'=> 'admin routes','uses'=>'BusRoutesController@index']);
//Route::resource('/admin/auth/points', 'BusPointsController');
//Route::resource('/admin/auth/notices', 'NoticesController');
//Route::resource('/admin/auth/addtime', 'TimeController');
//Route::resource('/admin/auth/newday', 'DayController');
Route::get('/admin/auth/schedule', ['as'=> 'admin schedule','uses'=>'ScheduleController@index']);
//Route::get('/admin/auth/allschedule', 'ScheduleController@all');

//Route::resource('/admin/auth/schedule/addtime', 'ScheduleController@create');
//Route::get('/admin/auth/notices/create','NoticesController@create');
//Route::get('/admin/auth/notices/create','NoticesController@store');

//PDF Converter Routes
Route::get('/test',['as'=>'htmltopdfview','uses'=>'PDFConverterController@htmltopdfview']);
Route::get('generate-pdf', 'PDFConverterController@pdfview')->name('generate-pdf');
