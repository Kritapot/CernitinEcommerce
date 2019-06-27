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
    Route::get('/admin/check-pwd', 'AdminController@check_password');
    Route::post('/admin/update-password', 'AdminController@update_password');

    //Category
    Route::get('/admin/add-category', 'CategoryController@add_category');
    Route::post('/admin/add-category/save', 'CategoryController@save');
    Route::get('/admin/show-category', 'CategoryController@show_category');
    Route::get('/admin/show-category', 'CategoryController@show_category');
    Route::get('/admin/edit-category/{id}', 'CategoryController@edit_category');
    Route::post('/admin/update-category/{id}', 'CategoryController@update_category');
});


Route::get('/home', 'HomeController@index')->name('home');
