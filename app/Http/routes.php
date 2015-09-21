<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




Route::get('/', "EventController@create");
Route::get('/activities', "ActivityController@index");
Route::get('/activities/new', "ActivityController@create");
Route::get('/events', "EventController@index");
Route::get('/events/new', "EventController@create");

Route::post('/events/new',"EventController@store");
