<?php

use Illuminate\Support\Facades\Route;

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
    return view('spa');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/foursquare/{id}', 'FourSquareController@index')->name('foursquare');
Route::get('/foursquare/photos/{id}', 'FourSquareController@photos')->name('foursquare.photos');
Route::get('/openweathermap/{city}/{country}', 'OpenWeatherMapController@index')->name('openweathermap');

