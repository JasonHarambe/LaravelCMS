<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::group(['middleware' => ['auth', 'active_user']], function() {
    Route::get('/home', 'HomeController@index')->name('main');
    Route::get('/', 'HomeController@index');

    Route::get('/clients/all', 'ClientController@showAll')->name('clients.all');
    Route::get('/orders/all', 'OrderController@showAll')->name('orders.all');
    Route::get('/users/all', 'UserController@showAll')->name('users.all');
    
    Route::get('/clients/{client}/edit', 'ClientController@editClient')->name('clients.edit');
    Route::get('/orders/{order}/edit', 'OrderController@editOrder')->name('orders.edit');
    
    Route::get('/orders/{order}/pdf','OrderController@createPDF')->name('orders.pdf');
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/clients/create', 'ClientController@createClient')->name('clients.create');
    Route::post('/clients', 'ClientController@storeClient')->name('clients.store');
    Route::put('/clients/{client}/update', 'ClientController@updateClient')->name('clients.update');
    Route::delete('/clients/{client}/destroy', 'ClientController@deleteClient')->name('clients.delete');

    Route::get('/users/create', 'UserController@createUser')->name('users.create');
    Route::post('/users', 'UserController@storeUser')->name('users.store');
    Route::get('/users/{user}/edit', 'UserController@editUser')->name('users.edit');
    Route::put('/users/{user}/block', 'UserController@blockUser')->name('users.block');
    Route::put('/users/{user}/unblock', 'UserController@unblockUser')->name('users.unblock');
    Route::put('/users/{user}/make', 'UserController@makeAdmin')->name('users.make');
    Route::put('/users/{user}/unmake', 'UserController@unmakeAdmin')->name('users.unmake');
    Route::put('/users/{user}/update', 'UserController@updateUser')->name('users.update');


    Route::put('/orders/{order}/update', 'OrderController@updateOrder')->name('orders.update');
    Route::get('/orders/create', 'OrderController@createOrder')->name('orders.create');
    Route::post('/orders', 'OrderController@storeOrder')->name('orders.store');
    Route::delete('/orders/{order}/destroy', 'OrderController@deleteOrder')->name('orders.delete');
    Route::put('/orders/{order}/restore', 'OrderController@restoreOrder')->name('orders.restore');
});