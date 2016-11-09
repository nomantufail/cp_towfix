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
        'uses'=>'HomeController@index',
        'as'=>'home'
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
    Route::post('/vehicle/{vehicle_id}/add_document', [
        'uses'=>'VehiclesController@addDocument'
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
    Route::get('/vehicle/{vehicle_id}', [
        'uses'=>'VehiclesController@detail'
    ]);

    Route::post('/vehicle/{vehicle_id}/add_document', [
        'uses'=>'VehiclesController@addDocument'
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
        'uses'=>'ConversationsController@userMessages',
        'as' => 'user_messages'
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
    Route::get('/product/update/{product_id}', [
        'uses'=>'ProductsController@editProductForm'
    ]);
    Route::post('/product/update/{product_id}', [
        'uses'=>'ProductsController@updateProduct'
    ]);
    Route::post('/product/delete/{product_id}', [
        'uses'=>'ProductsController@delete'
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


    Route::get('/customers', [
        'uses'=>'UsersController@listCustomers'
    ]);
    Route::get('/customer/services', [
        'uses'=>'ServicesController@showNewsletters'
    ]);
    Route::get('/customer/edit/{user_id}', [
        'uses'=>'UsersController@editCustomer'
    ]);
    Route::post('/customer/update/{customer_id}', [
        'uses'=>'UsersController@updateCustomer'
    ]);
    Route::post('/customer/delete/{user_id}', [
        'uses'=>'UsersController@delete'
    ]);

    Route::get('/orders', [
        'uses'=>'OrdersController@showOrders'
    ]);
    Route::post('/order/delete/{order_id}', [
        'uses'=>'OrdersController@delete'
    ]);

    Route::get('/service_requests', [
        'uses'=>'ServicesController@listServices', 'as'=>'service_requests'
    ]);
    Route::get('/service_request/create', [
        'uses'=>'ServicesController@showCreateRequestForm'
    ]);
    Route::post('/service_request/create', [
        'uses'=>'ServicesController@sendRequest'
    ]);
    Route::get('/service_request/edit/{request_id}', [
        'uses'=>'ServicesController@showEditRequestForm'
    ]);
    Route::post('/service_request/edit/{request_id}', [
        'uses'=>'ServicesController@updateRequest'
    ]);
    Route::post('/service_request/accept/{request_id}', [
        'uses'=>'ServicesController@acceptRequest'
    ]);
    Route::post('/service_request/delete/{request_id}', [
        'uses'=>'ServicesController@deleteRequest'
    ]);


    Route::get('/franchises', [
        'uses'=>'FranchisesController@showFranchises'
    ]);
    Route::get('/franchise/add', [
        'uses'=>'FranchisesController@showAddFranchiseForm'
    ]);
    Route::post('/franchise/add', [
        'uses'=>'FranchisesController@storeFranchise'
    ]);
    Route::get('/franchise/update/{franchise_id}', [
        'uses'=>'FranchisesController@editFranchiseForm'
    ]);
    Route::post('/franchise/update/{franchise_id}', [
        'uses'=>'FranchisesController@updateFranchise'
    ]);
    Route::post('/franchise/delete/{franchise_id}', [
        'uses'=>'FranchisesController@delete'
    ]);


    Route::get('/manuals', [
        'uses'=>'ManualsControllers@showManuals'
    ]);
    Route::get('/manual/add', [
        'uses'=>'ManualsControllers@showAddManualForm'
    ]);
    Route::post('/manual/add', [
        'uses'=>'ManualsControllers@addManual'
    ]);
    Route::get('/manual/update/{manual_id}', [
        'uses'=>'ManualsControllers@editManualForm'
    ]);
    Route::post('/manual/update/{manual_id}', [
        'uses'=>'ManualsControllers@updateManual'
    ]);
    Route::post('/manual/delete/{manual_id}', [
        'uses'=>'ManualsControllers@delete'
    ]);
    Route::get('/manual/{manual_id}', [
        'uses'=>'ManualsControllers@manualDetail'
    ]);


    /**
     * Cart routes ------------------------------>
     */
    Route::get('/cart', [
        'uses'=>'CartController@myCart'
    ]);
    Route::post('/cart/remove/{product_id}', [
        'uses' => 'CartController@removeItem'
    ]);
    Route::post('/cart/confirm', [
        'uses'=>'CartController@confirmCart'
    ]);
    Route::post('/cart/checkout', [
        'uses'=>'CartController@checkout'
    ]);
    /* ----------------------------------------------- */



    /****
     * API ROUTES...
     ****/
    Route::post('product_image/delete/{image_id}', [
        'uses' => 'ProductsController@deleteImageById',
    ]);
    Route::post('newsletter_image/delete/{image_id}', [
        'uses' => 'NewslettersController@deleteImageById',
    ]);
    Route::post('manual_image/delete/{image_id}', [
        'uses' => 'ManualsControllers@deleteImageById',
    ]);
    Route::post('cart/add/{product_id}', [
        'uses' => 'CartController@addProduct',
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