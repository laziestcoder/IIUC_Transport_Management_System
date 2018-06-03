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
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

//Notice routing
//Route::get('/posts','PagesController@posts');

Route::resource('notices','NoticesController');

//Authorization Routing
Auth::routes();
//Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard', 'DashboardController@index');

//User Confirmation Routing
//Email Verification 1
//Route::get('/users/confirmation/{token}', 'Auth\RegisterController@confirmation')->name('confirmation');

//Email Verification 2
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify')->name('confirmation');
//Admin::routes();
Route::resource('/admin/auth/routes','BusRoutesController');
Route::resource('/admin/auth/points','BusPointsController');
/* Route::get('/admin/auth/notices/create','NoticesController@create');
Route::get('/admin/auth/notices/create','NoticesController@store'); */