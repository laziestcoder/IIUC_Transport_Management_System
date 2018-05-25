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

Route::get('/', function () {
    $title = "Welcome to IIUC Transport Management Division";
    return view('pages.index',compact('title'));
});
/* Route::get('/', 'PagesController@index'); */

Auth::routes();
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/users/confiration/{token}', 'Auth\RegisterController@confirmation')->name('confirmation');
