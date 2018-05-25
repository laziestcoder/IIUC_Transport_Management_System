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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

//Route::get('/posts','PagesController@posts');
Route::resource('notices','NoticesController');


//Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
//My Codes

Route::get('/', function () {
    $title = "Welcome to IIUC Transport Management Division";
    return view('pages.index',compact('title'));
});
/* Route::get('/', 'PagesController@index'); */

Auth::routes();
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/users/confirmation/{token}', 'Auth\RegisterController@confirmation')->name('confirmation');
