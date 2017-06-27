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

// User Authentication Routes
Auth::routes();

// Patterns for parameters
Route::pattern('id', '\d+');
Route::pattern('username', '[a-z0-9_-]{3,16}');


// Pages
Route::get('/', 'HomeController@index')->name('home');
Route::get('dashboard', 'DashboardController@index')->name('dashboard');


// Account Routes
Route::group(['prefix' => 'account', 'middleware' => 'auth'], function () {
    Route::get('edit', 'AccountController@index')->name('editAccount');

    Route::post('update', [
        'before' => 'csrf',
        'uses' => 'AccountController@updateAccount',
    ]);
});

// List Routes
Route::group(['prefix' => 'lists'], function () {
    Route::get('{id}', 'ListController@getListById');
    Route::post('new', 'ListController@createNewList');
    Route::put('{id}', 'ListController@updateList');
    Route::delete('{id}', 'ListController@deleteList');
});
