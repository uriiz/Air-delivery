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

//Route::get('/', function () {
//    return view('home');
//});

Auth::routes();
Route::get('/', 'HomeController@index');
Route::post('/log-out', 'HomeController@logOut');
Route::post('/get-user', 'HomeController@getUser');
//Route::get('/', 'HomeController@index')->name('home');
Route::get('/join', 'HomeController@index');
Route::group(['middleware' => 'auth'],function() {
    Route::get('/dashboard', 'HomeController@index');
    Route::get('/dashboard/add-new', 'HomeController@index');
    Route::get('/dashboard/my-offers', 'HomeController@index');
    Route::post('/save-offer', 'OfferController@create');
    Route::post('/get-private-offers', 'OfferController@show');

});
