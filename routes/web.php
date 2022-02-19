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
Route::post('/register-to-wait', 'WaitController@store');
Route::get('/app-login', 'HomeController@index');


Route::group(['middleware' => 'auth'],function() {
    Route::get('/dashboard', 'HomeController@index');
    Route::get('/app-dashboard', 'HomeController@index');
    Route::get('/admin-feeds', 'HomeController@index');
    Route::get('/dashboard/add-new', 'HomeController@index');
    Route::get('/dashboard/shipment-status', 'HomeController@index');
    Route::get('/dashboard/my-offers', 'HomeController@index');
    Route::get('/dashboard/my-profile', 'HomeController@index');
    Route::post('/save-offer', 'OfferController@create');
    Route::post('/update-offer', 'OfferController@update');
    Route::post('/delete-offer', 'OfferController@deleteOffer');
    Route::post('/get-private-offers', 'OfferController@show');
    Route::post('/add-message-images', 'HomeController@updateUserImage');
    Route::post('/update-user', 'HomeController@updateUser');
    Route::post('/get-order-details', 'OfferController@getOfferDetails');
    Route::get('/dashboard/offer/{id}', 'HomeController@index');
    Route::post('/app/get-orders', 'OfferController@getAppOffers');
    Route::post('/get-countries', 'OfferController@getCountries');
    Route::post('/set-price', 'OfferController@setPrice');
    Route::post('/get-price-offer', 'OfferController@getPriceOffer');
    Route::get('/app-dashboard/edit', 'HomeController@index');
    Route::post('/get-user', 'HomeController@getUser');
    Route::post('/set-feedback', 'FeedBackController@store');
    Route::post('/admin/get-users', 'HomeController@getUsers');
    Route::post('/app/delete-offer-custom', 'IgnoreController@store');
    Route::post('/admin/get-shipper', 'HomeController@getShipper');
    Route::post('/admin/get-waiting', 'WaitController@show');
    Route::post('/admin/delete-user', 'HomeController@deleteUser');
    Route::post('/register-with-admin', 'WaitController@insertUser');
    Route::post('/app/get-confirm-orders', 'OfferController@getConfirmOffers');
    Route::get('/admin-dashboard', 'HomeController@index');
    Route::get('/admin-waiting-shipper', 'HomeController@index');
    Route::get('/admin-confirm', 'HomeController@index');
    Route::get('/app-dashboard/confirmed', 'HomeController@index');
    Route::get('/admin-dashboard-shipper', 'HomeController@index');
    Route::post('/confirm-offer', 'OfferController@confirmOffer');
    Route::post('/confirm-admin', 'ResponseController@show');
    Route::post('/confirm-offer-final', 'ResponseController@edit');
    Route::post('/admin/get-feeds', 'FeedBackController@show');
    Route::post('/admin/delete-feed', 'FeedBackController@update');
    Route::post('/app/delete-offer', 'ResponseController@appDeleteResponse');
    Route::post('/update-quot-status', 'OfferController@updateQuotStatus');
    Route::post('/admin/update-qut-status', 'OfferController@updateQuotStatusAdmin');


});
