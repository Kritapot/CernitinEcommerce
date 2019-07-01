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


Route::get('/', 'IndexController@index');

//Category/listing
Route::get('/product/{url}', 'ProductController@products');

//Product detail
Route::get('/product/{id}', 'ProductController@products_detail');



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
    Route::match(['get', 'post'],'/admin/delete-category/{id}', 'CategoryController@delete_category');

    //Product
    Route::match(['get', 'post'],'/admin/add-product', 'ProductController@add_product');
    Route::get('/admin/list-product', 'ProductController@list_product');
    Route::match(['get', 'post'],'/admin/edit-product/{id}', 'ProductController@edit_product');
    Route::get('/admin/delete-pic-product/{id}', 'ProductController@delete_picture');
    Route::get('/admin/delete-product/{id}', 'ProductController@delete_product');

    //Attribute
    Route::match(['get', 'post'],'/admin/add-attributes/{id}', 'ProductController@add_attributes');
    Route::get('/admin/delete-attribute/{id}', 'ProductController@delete_attributes');
});


Route::get('/home', 'HomeController@index')->name('home');
