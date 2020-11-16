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


Auth::routes(['register' => false]);

/* Home Controller */

Route::get('/', 'HomeController@welcome')->name('/');
Route::get('/home', 'HomeController@index')->name('home');


/* Truck Controller */
Route::resource('truck', 'TruckController');


/* Refuel Controller */
Route::get('refuel/{refuel_id}', 'RefuelController@edit')->name('refuel.edit');
Route::get('refuel/create/{truck_id}', 'RefuelController@create')->name('refuel.create');
Route::get('refuel/truck/{truck_id}', 'RefuelController@showByTruck')->name('refuel.truck');
Route::put('refuel/{refuel}', 'RefuelController@update')->name('refuel.update');
Route::post('refuel', 'RefuelController@store')->name('refuel.store');
Route::delete('refuel', 'RefuelController@destroy')->name('refuel.destroy');

/*  User Controller */
Route::get('user/{user}/edit', 'UserController@edit')->name('user.edit');
Route::put('user/{user_id}', 'UserController@update')->name('user.update');
Route::put('user/', 'UserController@changePassword')->name('password-change');


/* Paid Trip Controller */
Route::get('paid-trip/create/{truck_id}', 'PaidTripController@create')->name('paid-trip.create');
Route::get('paid-trip/{trip_id}/edit', 'PaidTripController@edit')->name('paid-trip.edit');
Route::post('paid-trip', 'PaidTripController@store')->name('paid-trip.store');
Route::put('paid-trip/{paid_trip_id}', 'PaidTripController@update')->name('paid-trip.update');
Route::delete('paid-trip/{paid_trip_id}', 'PaidTripController@destroy')->name('paid-trip.destroy');
Route::get('paid-trip/truck/{truck_id}', 'PaidTripController@showByTruck')->name('paid-trip.truck');

/* Parking Controller */
Route::get('parking/create/{truck_id}', 'ParkingController@create')->name('parking.create');
Route::get('parking/{parking_id}/edit', 'ParkingController@edit')->name('parking.edit');
Route::post('parking', 'ParkingController@store')->name('parking.store');
Route::put('parking/{parking_id}', 'ParkingController@update')->name('parking.update');
Route::delete('parking/{parking_id}', 'ParkingController@destroy')->name('parking.destroy');
Route::get('parking/truck/{truck_id}', 'ParkingController@showByTruck')->name('parking.truck');


/* Reminder Controller*/
Route::resource('reminder', 'ReminderController');
Route::post('reminder/{reminder_id}/mark-complete', 'ReminderController@markComplete')->name('reminder.complete');
Route::put('reminder/{reminder_id}/close', 'ReminderController@close')->name('reminder.close');


/* Report Controller */
Route::get('report', 'ReportController@index')->name('report.index');
Route::get('report/show', 'ReportController@show')->name('report.show');

/* Charts Routes*/
Route::get('/avg-fuel-consumption-chart', 'ChartController@AvgFuelConsumptionChart');
Route::get('/avg-fuel-price-chart', 'ChartController@AvgFuelPriceChart');
Route::get('/km-traveled-chart', 'ChartController@KmTraveledChart');
Route::get('/number-of-trucks-chart', 'ChartController@NumberOfTrucksChart');
Route::get('/paid-trips-chart', 'ChartController@PaidTripsChart');
