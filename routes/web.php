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
Route::get('style-guide', function () {
    return View::make('pages.style-guide');
});


// Account Routes
Route::prefix('account')->group(function () {
    Route::get('edit', 'AccountController@index')->name('editAccount');

    Route::post('update', [
        'before' => 'csrf',
        'uses' => 'AccountController@updateAccount',
    ]);
});

// List Routes
Route::resource('lists', 'ListController');

/*
Verb        URI                    Action          Route Name

GET         /lists                 index           lists.index
GET         /lists/create          create          lists.create
POST        /lists                 store           lists.store
GET         /lists/{id}            show            lists.show
GET         /lists/{id}/edit       edit            lists.edit
PUT/PATCH   /lists/{id}            update          lists.update
DELETE      /lists/{id}            destroy         lists.destroy
*/
