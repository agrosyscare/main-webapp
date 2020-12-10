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
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Usuarios
Route::resource('users', 'UserController');

// Invernaderos
Route::resource('/greenhouses', 'GreenhouseController');

// Canchas
Route::resource('/greenhouse-sections', 'GreenhouseSectionController');

// Gestión de Variables de invernaderos
Route::get('/settings/{greenhouse_section}', 'SettingController@edit');
Route::post('/settings', 'SettingController@store');

// Auditorias
Route::get('/audits', 'AuditController@index');
Route::get('/audits/{id}/show', 'AuditController@show');

// Graficos de temperatura
Route::get('charts/temperatures', 'ChartController@temperatures');
Route::get('charts/temperatures/data', 'ChartController@temperaturesJson');

// Graficos de humedad ambiental
Route::get('charts/env-humidity', 'ChartController@environmentalHumidities');
Route::get('charts/env-humidity/data', 'ChartController@environmentalHumiditiesJson');

// Graficos de humedad radicular
Route::get('charts/ret-humidity', 'ChartController@reticularHumidities');
Route::get('charts/ret-humidity/data', 'ChartController@reticularHumiditiesJson');

// Schedule
Route::get('/schedule', 'ScheduleController@edit');
Route::post('/schedule', 'ScheduleController@store');

Route::middleware(['auth', 'admin'])->group(function () {
    // Arduinos
    Route::resource('/arduinos', 'ArduinoController');
    // Sensores
    Route::resource('/sensors', 'SensorController');
});
