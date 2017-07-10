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

Route::get('/', 'routingController@home');

Route::get('login', 'routingController@login');

Route::get('logout', 'routingController@logout');

Route::get('signup', 'routingController@signup');

Route::post('validate', 'routingController@formValidation');

Route::get('dashboard', 'routingController@dashboard');

Route::get('dashboard/profile', 'routingController@dashboard');

Route::get('dashboard/profile/edit', 'routingController@dashboard');

Route::get('dashboard/projects', 'routingController@dashboard');

Route::get('dashboard/projects/{project_name}', 'routingController@dashboard');

Route::get('dashboard/create', 'routingController@dashboard');

Route::post('createProject', 'routingController@createProject');

Route::post('createUser', 'routingController@createUser');

Route::get('dashboard/settings', 'routingController@dashboard');

Route::get('delete', 'routingController@delete');

