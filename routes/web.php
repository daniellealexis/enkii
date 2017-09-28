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
+--------+-----------+----------------------------+------------------+------------------------------------------------------------------------+--------------+
| Domain | Method    | URI                        | Name             | Action                                                                 | Middleware   |
+--------+-----------+----------------------------+------------------+------------------------------------------------------------------------+--------------+
|        | GET|HEAD  | /                          | home             | App\Http\Controllers\HomeController@index                              | web          |
|        | GET|HEAD  | account/edit               | editAccount      | App\Http\Controllers\AccountController@index                           | web,auth     |
|        | POST      | account/update             |                  | App\Http\Controllers\AccountController@updateAccount                   | web,auth     |
|        | GET|HEAD  | api/comments/get/{comment} | comments.get     | App\Http\Controllers\ListCommentController@getComment                  | api          |
|        | DELETE    | api/comments/{comment}     | comments.destroy | App\Http\Controllers\ListCommentController@destroy                     | api,auth     |
|        | PUT       | api/comments/{comment}     | comments.update  | App\Http\Controllers\ListCommentController@update                      | api,auth     |
|        | GET|HEAD  | api/comments/{list}        | comments.index   | App\Http\Controllers\ListCommentController@index                       | api          |
|        | POST      | api/comments/{list}        | comments.store   | App\Http\Controllers\ListCommentController@store                       | api,auth     |
|        | GET|HEAD  | api/user                   |                  | Closure                                                                | api,auth:api |
|        | GET|HEAD  | dashboard                  | dashboard        | App\Http\Controllers\DashboardController@index                         | web,auth     |
|        | GET|HEAD  | lists                      | lists.index      | App\Http\Controllers\ListController@index                              | web          |
|        | POST      | lists                      | lists.store      | App\Http\Controllers\ListController@store                              | web          |
|        | GET|HEAD  | lists/create               | lists.create     | App\Http\Controllers\ListController@create                             | web          |
|        | GET|HEAD  | lists/{list}               | lists.show       | App\Http\Controllers\ListController@show                               | web          |
|        | PUT|PATCH | lists/{list}               | lists.update     | App\Http\Controllers\ListController@update                             | web          |
|        | DELETE    | lists/{list}               | lists.destroy    | App\Http\Controllers\ListController@destroy                            | web          |
|        | GET|HEAD  | lists/{list}/edit          | lists.edit       | App\Http\Controllers\ListController@edit                               | web          |
|        | GET|HEAD  | login                      | login            | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
|        | POST      | login                      |                  | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
|        | POST      | logout                     | logout           | App\Http\Controllers\Auth\LoginController@logout                       | web          |
|        | POST      | password/email             | password.email   | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest    |
|        | GET|HEAD  | password/reset             | password.request | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest    |
|        | POST      | password/reset             |                  | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest    |
|        | GET|HEAD  | password/reset/{token}     | password.reset   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest    |
|        | GET|HEAD  | register                   | register         | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |
|        | POST      | register                   |                  | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    |
|        | GET|HEAD  | style-guide                |                  | Closure                                                                | web          |
+--------+-----------+----------------------------+------------------+------------------------------------------------------------------------+--------------+
 */
