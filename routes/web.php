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
    return view('welcome');
});
Auth::routes();

Route::match(['get', 'post'], '/admin', 'AdminController@log_in');
Route::get('/logout', 'AdminController@logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin/dashboard', 'AdminController@Dashboard');
    Route::get('/admin/setting', 'AdminController@setting');
});


Route::get('/home', 'HomeController@index')->name('home');
