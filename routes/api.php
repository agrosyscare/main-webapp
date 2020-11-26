<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Rutas de Loginz
Route::group(['prefix' => 'auth' ], function () {
    Route::post('login', 'AuthController@login');
    // Route::post('signup', 'AuthController@signUp');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::post('/fcm/token', 'FirebaseController@postToken');

        // Rutas de consultas
        Route::get('greenhouses', 'GreenhouseController@index');
        Route::get('greenhouse-sections', 'GreenhouseSectionController@index');

        Route::get('temperatures', 'TemperatureReadingController@index');
        Route::post('temperatures', 'TemperatureReadingController@store');

        Route::get('env-humidity', 'EnvironmentalHumidityReadingController@index');
        Route::post('env-humidity', 'EnvironmentalHumidityReadingController@store');

        Route::get('ret-humidity', 'ReticularHumidityReadingController@index');
        Route::post('ret-humidity', 'ReticularHumidityReadingController@store');
        Route::get('status', 'StatusController@index');
    });
});




