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



Route::name('packages.')->group(function () {

	Route::get('/{provider}/{package}', 'HomeController@show')->name('show');

	Route::get('/', 'HomeController@index')->name('index');

});