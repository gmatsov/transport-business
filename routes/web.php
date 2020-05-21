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
    return view('welcome');
})->name('/');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('truck', 'TruckController');

Route::resource('refuel', 'RefuelController');

Route::get('refuel/create/{truck_id}', 'RefuelController@create')->name('refuel.create');

Route::get('refuel/truck/{truck_id}', 'RefuelController@showByTruck')->name('refuel.truck');

Route::put('refuel/{refuel}', 'RefuelController@update')->name('refuel.update');

Route::get('user/{user}/edit', 'UserController@edit')->name('user.edit');

Route::put('user/{user_id}', 'UserController@update')->name('user.update');

Route::put('user/', 'UserController@changePassword')->name('password-change');

Route::get('paid-trip/create/{truck_id}', 'PaidTripController@create')->name('paid-trip.create');

Route::post('paid-trip', 'PaidTripController@store')->name('paid-trip.store');
