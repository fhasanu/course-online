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

// Route::get('/payment/notification', 'PaymentController@notification');
// Route::get('/payment/error', 'PaymentController@error');
// Route::get('/payment/finish', 'PaymentController@finish');
// Route::get('/payment/unfinish', 'PaymentController@unfinish');

// Route::get('/vtweb', 'PagesController@vtweb');

// Route::get('/vtdirect', 'PagesController@vtdirect');
// Route::post('/vtdirect', 'PagesController@checkout_process');

// Route::get('/vt_transaction', 'PagesController@transaction');
// Route::post('/vt_transaction', 'PagesController@transaction_process');

// Route::post('/vt_notif', 'PagesController@notification');

Route::resource('/courses', 'CourseController');

Route::get('/snap', 'SnapController@snap');
Route::get('/snaptoken', 'SnapController@token');
Route::post('/snapfinish', 'SnapController@finish');
Route::post('/snapnotif', 'SnapController@notification');

Auth::routes();
Route::get('/home','HomeController@index');
Route::get('/admin','AdminController@index');
