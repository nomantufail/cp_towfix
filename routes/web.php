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
    Route::get('/vehicle/update/{vehicle_id}', [
        'uses'=>'VehiclesController@editVehicleForm'
    ]);
    Route::post('/vehicle/update/{vehicle_id}', [
        'uses'=>'VehiclesController@updateVehicle'
    ]);
    Route::post('/vehicle/delete', [
        'uses'=>'VehiclesController@delete'
    ]);


    Route::get('/messages', [
        'uses'=>'ConversationsController@users'
    ]);
    Route::get('/create-new-message', [
        'uses'=>'ConversationsController@create'
    ]);
    Route::post('/message/send', [
        'uses'=>'ConversationsController@send'
    ]);
    Route::get('/messages/{user_id}', [
        'uses'=>'ConversationsController@userMessages'
    ]);


    Route::get('/products', [
        'uses'=>'ProductsController@showProducts'
    ]);
    Route::get('/product/add', [
        'uses'=>'ProductsController@showAddProductForm'
    ]);
    Route::post('/product/add', [
        'uses'=>'ProductsController@addProduct'
    ]);
    Route::get('/product/{product_id}', [
        'uses'=>'ProductsController@productDetail'
    ]);


    Route::get('/newsletters', [
        'uses'=>'NewslettersController@showNewsletters'
    ]);
    Route::get('/newsletter/add', [
        'uses'=>'NewslettersController@showAddNewsletterForm'
    ]);
    Route::post('/newsletter/add', [
        'uses'=>'NewslettersController@addNewsletter'
    ]);
    Route::get('/newsletter/edit/{newsletter_id}', [
        'uses'=>'NewslettersController@showEditNewsletterForm'
    ]);
    Route::post('/newsletter/edit/{newsletter_id}', [
        'uses'=>'NewslettersController@updateNewsletter'
    ]);
    Route::get('/newsletter/{newsletter_id}', [
        'uses'=>'NewslettersController@newsletterDetail'
    ]);
    Route::post('/newsletter/delete/{newsletter_id}', [
        'uses'=>'NewslettersController@delete'
    ]);


    Route::get('/orders', [
        'uses'=>'OrdersController@showOrders'
    ]);
    Route::post('/order/delete/{order_id}', [
        'uses'=>'OrdersController@delete'
    ]);


    Route::get('/logout', function ()    {
        Auth::logout();
        return redirect('/');
    });

});
Route::get('/internal-server-error', [
    'uses'=>'PagesController@internalServerError'
]);

Route::post('/deleteImage', 'NewslettersController@deleteImage');

Auth::routes();