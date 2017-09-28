<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Comment Routes
// Using manual creation due to comments.index needing the list ID
Route::get('comments/{list}', 'API\ListCommentController@index')->name('comments.index');
Route::get('comments/get/{comment}', 'API\ListCommentController@getComment')->name('comments.get');
Route::delete('comments/{comment}', 'API\ListCommentController@destroy')->name('comments.destroy');
Route::put('comments/{comment}', 'API\ListCommentController@update')->name('comments.update');
Route::post('comments/{list}', 'API\ListCommentController@store')->name('comments.store');