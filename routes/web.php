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

    Route::get('/vehicles', [
        'uses'=>'VehiclesController@listVehicles'
    ]);
    Route::get('/vehicle/add', [
        'uses'=>'VehiclesController@ShowAddVehicleForm'
    ]);
    Route::post('/vehicle/add', [
        'uses'=>'VehiclesController@StoreVehicle'
    ]);
    Route::post('/vehicle/delete', [
        'uses'=>'VehiclesController@delete'
    ]);

    Route::get('/logout', function ()    {
        Auth::logout();
        return redirect('/');
    });

});
Route::get('/internal-server-error', [
    'uses'=>'PagesController@internalServerError'
]);

Auth::routes();