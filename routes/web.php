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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//Login with Facebook
Route::get('/login/facebook', [
    'uses' => 'Auth\LoginController@redirectToProvider',
    'as' => 'login.facebook'
]);
Route::get('/login/callback', [
    'uses' => 'Auth\LoginController@handleProviderCallback',
    'as' => 'login.callback'
]);

Route::middleware('auth')->group(function (){
//  site
    Route::get('/tickets', [
       'uses' => 'HomeController@tickets',
       'as' => 'tickets'
    ]);
    Route::post('/paypal', [
        'uses' => 'PaymentController@postPayment',
        'as' => 'paypal'
    ]);
    Route::get('/paypal', [
        'uses' => 'PaymentController@getPaymentStatus',
        'as' => 'status'
    ]);
    Route::post('/vote/{pool}', [
        'uses' => 'PoolsController@vote',
        'as' => 'pool.vote'
    ]);
    Route::post('/take-in/{raffle}', [
        'uses' => 'RafflesController@take_in',
        'as' => 'raffle.take_in'
    ]);

//  admin site
    Route::get('/admin', [
        'uses' => 'DashboardController@index',
        'as' => 'dashboard'
    ]);
    Route::get('/admin/pools', [
        'uses' => 'PoolsController@index',
        'as' => 'pool.index'
    ]);
    Route::get('/admin/pool/create', [
        'uses' => 'PoolsController@create',
        'as' => 'pool.create'
    ]);
    Route::get('/admin/pool/edit/{pool}', [
        'uses' => 'PoolsController@edit',
        'as' => 'pool.edit'
    ]);
    Route::get('/admin/pool/close_pool/{pool}', [
        'uses' => 'PoolsController@close_pool',
        'as' => 'pool.close_pool'
    ]);
    Route::post('/admin/pool/store', [
        'uses' => 'PoolsController@store',
        'as' => 'pool.store'
    ]);
    Route::post('/admin/pool/update/{pool}', [
        'uses' => 'PoolsController@update',
        'as' => 'pool.update'
    ]);
    Route::get('/admin/pool/delete/{pool}', [
        'uses' => 'PoolsController@delete',
        'as' => 'pool.delete'
    ]);

    Route::get('/admin/raffles', [
        'uses' => 'RafflesController@index',
        'as' => 'raffle.index'
    ]);
    Route::get('/admin/raffle/create', [
        'uses' => 'RafflesController@create',
        'as' => 'raffle.create'
    ]);
    Route::get('/admin/raffle/edit/{raffle}', [
        'uses' => 'RafflesController@edit',
        'as' => 'raffle.edit'
    ]);
    Route::post('/admin/raffle/store', [
        'uses' => 'RafflesController@store',
        'as' => 'raffle.store'
    ]);
    Route::post('/admin/raffle/update/{raffle}', [
        'uses' => 'RafflesController@update',
        'as' => 'raffle.update'
    ]);
    Route::get('/admin/raffle/delete/{raffle}', [
        'uses' => 'RafflesController@delete',
        'as' => 'raffle.delete'
    ]);
    Route::get('/admin/raffle/participants/{raffle}', [
        'uses' => 'RafflesController@participants',
        'as' => 'raffle.participants'
    ]);
    Route::get('/admin/raffle/raffle-winner/{raffle}', [
        'uses' => 'RafflesController@raffle_winner',
        'as' => 'raffle.raffle_winner'
    ]);
    Route::get('/admin/raffle/winner/{raffle}', [
        'uses' => 'RafflesController@show_winner',
        'as' => 'raffle.show_winner'
    ]);

    Route::get('/admin/transactions', [
        'uses' => 'TransactionsController@index',
        'as' => 'transactions'
    ]);
    Route::get('/admin/transaction/show/{transaction}', [
        'uses' => 'TransactionsController@show',
        'as' => 'transaction.show'
    ]);

    Route::get('/admin/users', [
        'uses' => 'UsersController@index',
        'as' => 'users'
    ]);
    Route::post('/admin/user/update/{user}', [
        'uses' => 'UsersController@update',
        'as' => 'user.update'
    ]);
    Route::get('/admin/user/edit/{user}', [
        'uses' => 'UsersController@edit',
        'as' => 'user.edit'
    ]);
});
