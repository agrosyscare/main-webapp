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

// Schedule
Route::get('/schedule', 'Manager\ScheduleController@edit');
Route::post('/schedule', 'Manager\ScheduleController@store');

// Invernaderos
Route::resource('/greenhouses', 'GreenhouseController');

// Canchas
Route::resource('/greenhouse-sections', 'GreenhouseSectionController');

// Arduinos
Route::resource('/arduinos', 'ArduinoController');

// Sensores
Route::resource('/sensors', 'SensorController');

// Gestión de Variables
Route::get('/settings/{greenhouse_section}', 'SettingController@edit');
Route::post('/settings', 'SettingController@store');

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

// MODIFICAR CUANDO TERMINE APP

// Route::middleware(['auth', 'admin'])->group(function () {
//     // Speciality
//     Route::get('/greenhouses', 'GreenhouseController@index');
//     Route::get('/greenhouses/create', 'GreenhouseController@create'); // form registro
//     Route::get('/greenhouses/{greenhouse}/edit', 'GreenhouseController@edit');
//     Route::post('/greenhouses', 'GreenhouseController@store'); // envío del form
//     Route::put('/greenhouses/{greenhouse}', 'GreenhouseController@update');
//     Route::delete('/greenhouses/{greenhouse}', 'GreenhouseController@destroy');

//     // Doctors
//     Route::resource('users', 'UserController');
// });

// Route::middleware(['auth', 'manager'])->namespace('manager')->group(function () {
//     // Speciality
//     Route::get('/schedule', 'ScheduleController@edit');
//     Route::post('/schedule', 'ScheduleController@store');
// });



// Route::get('/greenhouses', 'GreenhouseController@index');
// Route::get('/greenhouses/create', 'GreenhouseController@create'); // form registro
// Route::get('/greenhouses/{greenhouse}/edit', 'GreenhouseController@edit');
// Route::post('/greenhouses', 'GreenhouseController@store'); // envío del form
// Route::put('/greenhouses/{greenhouse}', 'GreenhouseController@update');
// Route::delete('/greenhouses/{greenhouse}', 'GreenhouseController@destroy');
