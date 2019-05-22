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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


/* RESTful approach with traditional REST class methods */

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', 'UserController@register')->name('register');
    Route::post('/login', 'UserController@login')->name('login');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'v1'], function () {
        Route::resource('entries', 'DiaryController');
        Route::get('/user', 'UserController@details');
    });
});
