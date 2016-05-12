<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/user-verification', 'WelcomeController@verify');


Route::post('/car-master-create', 'CarMasterController@createCarMaster');
Route::post('/car-master-update', 'CarMasterController@updateCarMaster');
Route::post('/car-master-delete', 'CarMasterController@deleteCarMaster');
Route::get('/car-master-edit', 'CarMasterController@editCarMaster');
Route::get('/car-master-get', 'CarMasterController@getCarMaster');
Route::get('/car-master-get-available-cars', 'CarMasterController@getAvailableCars');
Route::get('/car-master-get-rented-cars', 'CarMasterController@getRentedCars');

Route::post('/customer-master-create', 'CustomerMasterController@createCustomerMaster');
Route::post('/customer-master-update', 'CustomerMasterController@updateCustomerMaster');
Route::post('/customer-master-delete', 'CustomerMasterController@deleteCustomerMaster');
Route::get('/customer-master-edit', 'CustomerMasterController@editCustomerMaster');
Route::get('/customer-master-get', 'CustomerMasterController@getCustomerMaster');
Route::get('/customer-rented-cars', 'CustomerMasterController@getRentedCars');
Route::post('/customer-master-rent-car', 'CustomerMasterController@customerRentACar');
Route::post('/customer-master-end-lease', 'CustomerMasterController@customerEndLease');
Route::post('/customer-login', 'CustomerMasterController@customerLogin');