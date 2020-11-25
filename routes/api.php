<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/weather-current', function () {
    $weatherKey = config('services.openweather.key');
    $response = Http::get("api.openweathermap.org/data/2.5/weather?q=allentown&appid=$weatherKey");
    return $response->json();
});

Route::get('/weather-daily', function () {
    $weatherKey = config('services.openweather.key');
    $baseUrl = 'https://api.openweathermap.org/data/2.5/onecall?';
    $lat = 40.61;
    $lon = -75.49;
    $response = Http::get( $baseUrl . "lat=$lat&lon=$lon&exclude=current,minutely,hourly,alerts&units=imperial&appid=$weatherKey" );
//      $response = Http::get("api.openweathermap.org/data/2.5/weather?q=allentown&appid=$weatherKey");
    return $response->json();
});
