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

Route::get('dashboard', 'DashboardController@index')->name('dashboard');


// "/controller/action"

/**
 * Account Routes
 */
Route::group(['prefix' => 'account', 'middleware' => 'auth'], function () {
    Route::get('edit', 'AccountController@index')->name('editAccount');

    Route::post('update', [
        'before' => 'csrf',
        'uses' => 'AccountController@updateAccount',
    ]);
});
