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

Route::get('/', function () {
    return view('subscribe');
});

Route::get('/list', function () {
    return view('list');
});

Route::get('/all', function () {
    return view('all');
});

Route::get('/tags', function () {
    return view('tags');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
