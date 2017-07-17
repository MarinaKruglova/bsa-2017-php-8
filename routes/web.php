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

Route::group(['prefix' => '/cars'], function() {
    Route::get('/', 'CarController@index')->name('cars-list');
    Route::get('/{id}', 'CarController@show')->name('car-show');
    Route::get('/create', 'CarController@store')->name('car-form');
    Route::post('/{id}/edit', 'CarController@update')->name('car-edit');
    Route::post('/', 'CarController@store')->name('car-store');
});
