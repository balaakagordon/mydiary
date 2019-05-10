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

/* Original code */
// Route::get('/', function () {
//     return view('welcome');
// });

/* Commonly used and RESTful but also customizable class methods */
// Route::get('/entries', 'EntriesController@index');
// Route::get('/entries/{entry}', 'EntriesController@show');
// Route::get('/entries/{entry}/edit', 'EntriesController@edit');
// Route::get('/entries/create', 'EntriesController@create');
// Route::post('/entries', 'EntriesController@store');
// Route::patch('/entries/{entry}', 'EntriesController@update');
// Route::delete('/entries/{entry}', 'EntriesController@delete');

// /* RESTful approach with traditional REST class methods */
// Route::resource('api/v1/entries', 'DiaryController');
// Route::post('/auth/register', 'RegisterController@create');
// Route::post('/auth/login', 'LoginController@index');



Route::patch('/activities/{activity}', 'EntryActivitiesController@update');


