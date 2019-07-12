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
Route::get('/product-detail/{id}', 'ProductController@products_detail');
//Get price from Product-size
Route::get('/get-product-size', 'ProductController@product_from_size');
//Add to cart
Route::match(['get', 'post'],'/add-cart', 'ProductController@add_to_cart');
//cart
Route::match(['get', 'post'],'/cart', 'ProductController@cart');
Route::get('/cart/delete/{id}', 'ProductController@delete_cart_product');
//update product quaitity
Route::get('/cart/update-quantity/{id}/{quantity}', 'ProductController@update_quantity');
//User Login-Register
Route::post('/form-register', 'UserController@register');
Route::get('/user-register', 'UserController@userLoginRegister');
Route::get('/user-logout', 'UserController@logout');
Route::post('/user-login', 'UserController@login');


Route::group(['middleware' => ['FontLogin']], function () {
    //User Account Page
    Route::match(['get', 'post'],'account', 'UserController@userAccountPage');
    //Check current password
    Route::post('/check-user-pwd', 'UserController@checkUserPassword');
    //Update User Password
    Route::post('/update-user-pwd', 'UserController@updateUserPassword');
    // Check out
    Route::match(['get', 'post'],'/checkout', 'ProductController@checkOut');
    // review order product
    Route::match(['get', 'post'],'/order-review', 'ProductController@orderReview');
    // place order
    Route::match(['get', 'post'],'/place-order', 'ProductController@placeOrder');
    // thank page
    Route::get('/thank-page', 'ProductController@thankPage');
    // show order userpage
    Route::get('/order-user-page', 'ProductController@userOrderPage');
    // show order product userpage
    Route::get('/order-user-page/{id}', 'ProductController@showOrderProduct');


});


//Check Email
Route::match(['get', 'post'],'/check-email', 'UserController@checkEmail');



Auth::routes();

Route::match(['get', 'post'], '/admin', 'AdminController@log_in');
Route::get('/logout', 'AdminController@logout');

Route::group(['middleware' => ['BackendLogin']], function () {
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
    Route::match(['get', 'post'],'/admin/edit-attributes/{id}', 'ProductController@edit_attributes');
    Route::get('/admin/delete-attribute/{id}', 'ProductController@delete_attributes');

    //Banner
    Route::match(['get', 'post'],'/admin/add-banner', 'BannerController@add_banner');
    Route::get('/admin/list-banner', 'BannerController@list_banners');
    Route::match(['get', 'post'],'/admin/edit-banner/{id}', 'BannerController@edit_banner');
    Route::get('/admin/delete-banner/{id}', 'BannerController@delete_banner');

    //Order
    Route::get('/admin/list-order', 'ProductController@showOrderAdmin');
    Route::get('/admin/list-order/{id}', 'ProductController@showDetailOrderAdmin');


});


Route::get('/home', 'HomeController@index')->name('home');
