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
Route::get('/?login=1', 'HomeController@index')->name('custom-login');
Route::get('/?register=1', 'HomeController@index')->name('custom-register');
Route::post('/log-out', 'HomeController@logOut');
Route::post('/get-user', 'HomeController@getUser');


Route::group(['middleware' => 'auth'],function() {
    Route::get('/dashboard', 'HomeController@index');
    Route::get('/dashboard/add-new', 'HomeController@index');
    Route::get('/dashboard/my-offers', 'HomeController@index');
    Route::get('/dashboard/my-profile', 'HomeController@index');
    Route::post('/save-offer', 'OfferController@create');
    Route::post('/get-private-offers', 'OfferController@show');
    Route::post('/add-message-images', 'HomeController@updateUserImage');
    Route::post('/update-user', 'HomeController@updateUser');

});
