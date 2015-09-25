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




Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'events'], function () {
    Route::get('/', "EventController@index");
    Route::get('/new', "EventController@create");
    Route::post('/new', "EventController@store");
    Route::get('/{id}', "EventController@show")->where('id', '[0-9]+');
    
});

Route::group(['prefix' => 'activities'], function () {
    Route::get('/', "ActivityController@index");
    Route::get('/new', "ActivityController@create");
});

Route::group(['prefix' => 'api/dev'], function () {
    Route::resource('events', 'EventRestController',  ['only' => ['index', 'show']]);
});
