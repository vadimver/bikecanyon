<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/list', function () {
    return view('list');
});

Route::post('/new_comment', 'CommentController@create');

Route::get('/', 'PublicationController@all');
Route::get('/subscribe', 'PublicationController@subscribe');
Route::any('/tags', 'PublicationController@tags');
Route::get('/add_publication', 'PublicationController@add_publication');

Route::post('/new_publication', 'PublicationController@create');

Auth::routes();
Route::get('/create_profile', 'HomeController@index');
