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


# Profile
Route::any('/list', 'ProfileController@index');
Route::post('/subscribe', 'ProfileController@subscribe');
Route::post('/unsubscribe', 'ProfileController@unsubscribe');

Route::get('/create_profile', 'HomeController@index');
Route::post('/new_profile', 'ProfileController@create_profile');
Route::get('/edit_profile/{id}', 'ProfileController@edit_profile');
Route::post('/edit_profile_post', 'ProfileController@edit_profile_post');
Route::get('/my_profiles', 'ProfileController@my_profiles');
Route::get('/my_destroy/{id}', 'ProfileController@my_destroy');

# Comment
Route::post('/new_comment', 'CommentController@create');
Route::post('/comment_like', 'CommentController@comment_like');

# Publication
Route::any('/', 'PublicationController@all');
Route::get('/subscribe', 'PublicationController@subscribe');
Route::any('/tags', 'PublicationController@tags');
Route::get('/add_publication', 'PublicationController@add_publication');
Route::post('/new_publication', 'PublicationController@create');
Route::post('/test', 'PublicationController@pub_like' );

# Settings
Route::get('/settings', 'SettingsController@settings');
Route::post('/update_settings', 'SettingsController@update_settings');

# Statistic
Route::get('/statistic', 'StatisticController@statistic');

# Auth
Auth::routes();


Route::post('/pub_like', 'PublicationController@pub_like');
