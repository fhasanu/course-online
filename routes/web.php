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

Route::get('/home', 'HomeController@index');

Route::get('/payment/notification', 'PaymentController@notification');
Route::get('/payment/error', 'PaymentController@error');
Route::get('/payment/finish', 'PaymentController@finish');
Route::get('/payment/unfinish', 'PaymentController@unfinish');

Route::get('/snap', function  () {
	return view('snap');
});

Route::get('/snaptoken', 'PaymentController@token');
