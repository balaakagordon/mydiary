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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('entries', 'EntriesController');

// Route::get('/entries', 'EntriesController@index');
// Route::get('/entries/{entry}', 'EntriesController@show');
// Route::get('/entries/{entry}/edit', 'EntriesController@edit');
// Route::get('/entries/create', 'EntriesController@create');
// Route::post('/entries', 'EntriesController@store');
// Route::patch('/entries/{entry}', 'EntriesController@update');
// Route::delete('/entries/{entry}', 'EntriesController@delete');


Route::patch('/activities/{activity}', 'EntryActivitiesController@update');
