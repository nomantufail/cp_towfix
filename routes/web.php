<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [
        'uses'=>'HomeController@index'
    ]);
    Route::get('/vehicle/add', [
        'uses'=>'VehiclesController@ShowAddVehicleForm'
    ]);
    Route::post('/vehicle/add', [
        'uses'=>'VehiclesController@StoreVehicle'
    ]);

    Route::get('/logout', function ()    {
        Auth::logout();
        return redirect('/');
    });

});
Auth::routes();