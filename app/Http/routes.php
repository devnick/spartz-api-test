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

// Cities Resources
Route::resource('cities', 'CitiesController');

// States Resources
Route::resource('states', 'StatesController');
Route::resource('states.cities', 'StatesCitiesController');

// Users Resources
Route::resource('users', 'UsersController');
Route::resource('users.visits', 'VisitsController', ['only' => ['store', 'index']]);