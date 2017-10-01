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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;


// this is assuming that our domain will have 1 TLD, i.e. enkii.io and not enkii.co.in
$domain = join('.', array_slice(explode('.', request()->getHost()), -2, 2));


Route::domain('{account}.' . $domain)->group(function() {

    // Short URL shared link for all user's lists
    Route::get('/', 'ShareController@indexAll')->name('share.index_all');

    // Short URL shared link for specific lists
    Route::get('/{list}', 'ShareController@indexList')->name('share.index_list');

    // Short URL shared link for specific lists
    Route::get('/l/{item}', 'ShareController@indexItem')->name('share.index_item');

});


Route::domain($domain)->group(function() {

    // User Authentication Routes
    Auth::routes();

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
});

/*
+---------------------+-----------+-----------------------------------------+------------------+----------------------------------------------------------------------------+--------------+
| Domain              | Method    | URI                                     | Name             | Action                                                                     | Middleware   |
+---------------------+-----------+-----------------------------------------+------------------+----------------------------------------------------------------------------+--------------+
| {account}.enkii.com | GET|HEAD  | /                                       | share.index_all  | App\Http\Controllers\ShareController@indexAll                              | web          |
| enkii.com           | GET|HEAD  | /                                       | home             | App\Http\Controllers\HomeController@index                                  | web          |
| enkii.com           | GET|HEAD  | account/edit                            | editAccount      | App\Http\Controllers\AccountController@index                               | web,auth     |
| enkii.com           | POST      | account/update                          |                  | App\Http\Controllers\AccountController@updateAccount                       | web,auth     |
|                     | GET|HEAD  | api/comments/get/{comment}              | comments.get     | App\Http\Controllers\API\ListCommentController@getComment                  | api          |
|                     | DELETE    | api/comments/{comment}                  | comments.destroy | App\Http\Controllers\API\ListCommentController@destroy                     | api,auth:api |
|                     | PUT       | api/comments/{comment}                  | comments.update  | App\Http\Controllers\API\ListCommentController@update                      | api,auth:api |
|                     | GET|HEAD  | api/comments/{list}                     | comments.index   | App\Http\Controllers\API\ListCommentController@index                       | api          |
|                     | POST      | api/comments/{list}                     | comments.store   | App\Http\Controllers\API\ListCommentController@store                       | api,auth:api |
|                     | GET|HEAD  | api/user                                |                  | Closure                                                                    | api,auth:api |
| enkii.com           | GET|HEAD  | dashboard                               | dashboard        | App\Http\Controllers\DashboardController@index                             | web,auth     |
| {account}.enkii.com | GET|HEAD  | l/{item}                                | share.index_item | App\Http\Controllers\ShareController@indexItem                             | web          |
| enkii.com           | GET|HEAD  | lists                                   | lists.index      | App\Http\Controllers\ListController@index                                  | web          |
| enkii.com           | POST      | lists                                   | lists.store      | App\Http\Controllers\ListController@store                                  | web          |
| enkii.com           | GET|HEAD  | lists/create                            | lists.create     | App\Http\Controllers\ListController@create                                 | web          |
| enkii.com           | GET|HEAD  | lists/{list}                            | lists.show       | App\Http\Controllers\ListController@show                                   | web          |
| enkii.com           | PUT|PATCH | lists/{list}                            | lists.update     | App\Http\Controllers\ListController@update                                 | web          |
| enkii.com           | DELETE    | lists/{list}                            | lists.destroy    | App\Http\Controllers\ListController@destroy                                | web          |
| enkii.com           | GET|HEAD  | lists/{list}/edit                       | lists.edit       | App\Http\Controllers\ListController@edit                                   | web          |
| enkii.com           | GET|HEAD  | login                                   | login            | App\Http\Controllers\Auth\LoginController@showLoginForm                    | web,guest    |
| enkii.com           | POST      | login                                   |                  | App\Http\Controllers\Auth\LoginController@login                            | web,guest    |
| enkii.com           | POST      | logout                                  | logout           | App\Http\Controllers\Auth\LoginController@logout                           | web          |
|                     | GET|HEAD  | oauth/authorize                         |                  | \Laravel\Passport\Http\Controllers\AuthorizationController@authorize       | web,auth     |
|                     | POST      | oauth/authorize                         |                  | \Laravel\Passport\Http\Controllers\ApproveAuthorizationController@approve  | web,auth     |
|                     | DELETE    | oauth/authorize                         |                  | \Laravel\Passport\Http\Controllers\DenyAuthorizationController@deny        | web,auth     |
|                     | GET|HEAD  | oauth/clients                           |                  | \Laravel\Passport\Http\Controllers\ClientController@forUser                | web,auth     |
|                     | POST      | oauth/clients                           |                  | \Laravel\Passport\Http\Controllers\ClientController@store                  | web,auth     |
|                     | PUT       | oauth/clients/{client_id}               |                  | \Laravel\Passport\Http\Controllers\ClientController@update                 | web,auth     |
|                     | DELETE    | oauth/clients/{client_id}               |                  | \Laravel\Passport\Http\Controllers\ClientController@destroy                | web,auth     |
|                     | GET|HEAD  | oauth/personal-access-tokens            |                  | \Laravel\Passport\Http\Controllers\PersonalAccessTokenController@forUser   | web,auth     |
|                     | POST      | oauth/personal-access-tokens            |                  | \Laravel\Passport\Http\Controllers\PersonalAccessTokenController@store     | web,auth     |
|                     | DELETE    | oauth/personal-access-tokens/{token_id} |                  | \Laravel\Passport\Http\Controllers\PersonalAccessTokenController@destroy   | web,auth     |
|                     | GET|HEAD  | oauth/scopes                            |                  | \Laravel\Passport\Http\Controllers\ScopeController@all                     | web,auth     |
|                     | POST      | oauth/token                             |                  | \Laravel\Passport\Http\Controllers\AccessTokenController@issueToken        | throttle     |
|                     | POST      | oauth/token/refresh                     |                  | \Laravel\Passport\Http\Controllers\TransientTokenController@refresh        | web,auth     |
|                     | GET|HEAD  | oauth/tokens                            |                  | \Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController@forUser | web,auth     |
|                     | DELETE    | oauth/tokens/{token_id}                 |                  | \Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController@destroy | web,auth     |
| enkii.com           | POST      | password/email                          | password.email   | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail      | web,guest    |
| enkii.com           | GET|HEAD  | password/reset                          | password.request | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm     | web,guest    |
| enkii.com           | POST      | password/reset                          |                  | App\Http\Controllers\Auth\ResetPasswordController@reset                    | web,guest    |
| enkii.com           | GET|HEAD  | password/reset/{token}                  | password.reset   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm            | web,guest    |
| enkii.com           | GET|HEAD  | register                                | register         | App\Http\Controllers\Auth\RegisterController@showRegistrationForm          | web,guest    |
| enkii.com           | POST      | register                                |                  | App\Http\Controllers\Auth\RegisterController@register                      | web,guest    |
| enkii.com           | GET|HEAD  | style-guide                             |                  | Closure                                                                    | web          |
| {account}.enkii.com | GET|HEAD  | {list}                                  | share.index_list | App\Http\Controllers\ShareController@indexList                             | web          |
+---------------------+-----------+-----------------------------------------+------------------+----------------------------------------------------------------------------+--------------+
 */
