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

Route::get('/search', function () {
    return view('search');
});

Route::post('/search', 'SearchController@search');

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
// Route::get('/home','HomeController@index');
// Route::get('/admin','AdminController@index');

Route::resource('/courses', 'CourseController');

// Route::get('/snap', 'SnapController@snap');
// Route::get('/snaptoken', 'SnapController@token');
// Route::post('/snapfinish', 'SnapController@finish');
// Route::post('/snapnotif', 'SnapController@notification');

Route::get('/checkout', 'SnapController@snap');
// <<<<<<< HEAD
// Route::get('/addtocart', 'SnapController@addtocart');
// Route::get('/snaptoken', 'SnapController@token');
// Route::post('/payment/finish', 'SnapController@finish');
// Route::post('/payment/snapnotif', 'SnapController@notification');
// =======
Route::get('/snaptoken', 'SnapController@token')->middleware('ajax');;
Route::post('/payment/snapnotif', 'SnapController@notification');
Route::post('/payment/finish', 'SnapController@finish');
Route::post('/payment/unfinish', 'SnapController@unfinish');
Route::post('/payment/error', 'SnapController@error');
Route::get('/addtocart', 'SnapController@addtocart');
Route::get('/snapreset', 'SnapController@reset');
// >>>>>>> cdb2e4810b37e7d2a581e62c412a428bfcb0e6aa

Auth::routes();

Route::get('/home', 'HomeController@index');
