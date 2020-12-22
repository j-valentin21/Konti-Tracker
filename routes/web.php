<?php

use Illuminate\Support\Facades\Http;
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
    return view('index');
})->name('index');

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'firstTimeUser', 'verified'])->group(function () {
    Route::get('/register/build-your-profile', 'ProfileController@create')->name('profile');
    Route::post('/register/build-your-profile', 'ProfileController@post')->name('profile.post');
    Route::get('/register/avatar', 'AvatarController@create')->name('avatar');
    Route::post('/register/avatar', 'AvatarController@post')->name('avatar.post');
    Route::delete('/register/remove-avatar', 'AvatarController@destroy')->name('avatar.destroy');
    Route::get('/register/confirmation', 'ConfirmationController@create')->name('confirmation');
    Route::post('/register/store', 'ConfirmationController@store')->name('confirmation.store');
});

Route::middleware(['auth', 'NotFirstTimeUser', 'verified'])->group(function () {
    Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard.index');
    Route::put('/dashboard', 'Dashboard\DashboardController@update')->name('dashboard.update');
    Route::post('/dashboard', 'Dashboard\DashboardController@create')->name('dashboard.create');
    Route::get('/dashboard/pto-chart', 'Dashboard\DashboardController@getPTOChartData')->name('dashboard.getPTOChartData');
    Route::get('/dashboard/points-chart', 'Dashboard\DashboardController@getPointsChartData')->name('dashboard.getPointsChartData');
    Route::get('/dashboard/profile', 'Dashboard\DashboardProfileController@index')->name('dashboard.profile.index');
    Route::put('/dashboard/profile', 'Dashboard\DashboardProfileController@update')->name('dashboard.profile.update');
    Route::delete('/dashboard/remove-avatar', 'Dashboard\DashboardProfileController@destroy')->name('dashboard.profile.destroy');
    Route::get('/dashboard/pto-points-data', 'Dashboard\DashboardPTOPointsController@index')->name('dashboard.PTOPoints.index');
    Route::put('/dashboard/pto-points-data', 'Dashboard\DashboardPTOPointsController@update')->name('dashboard.PTOPoints.update');
    Route::get('/dashboard/activity', 'Dashboard\DashboardActivityController@index')->name('dashboard.activity.index');
    Route::delete('/dashboard/activity/{id}', 'Dashboard\DashboardActivityController@destroy')->name('dashboard.activity.destroy');
    Route::get('/dashboard/change-password', 'Dashboard\DashboardPasswordController@index')->name('dashboard.password.index');
    Route::put('/dashboard/update-password', 'Dashboard\DashboardPasswordController@update')->name('dashboard.password.update');
    Route::post('/dashboard/calendar', 'Dashboard\DashboardCalendarController@store')->name('calendar.store');
    Route::get('/dashboard/calendar', 'Dashboard\DashboardCalendarController@index')->name('calendar.index');
    Route::get('/dashboard/calendar/events', 'Dashboard\DashboardCalendarController@getCalendarData')->name('calendar.getCalendarData');
    Route::get('/dashboard/calendar/{calendar}', 'Dashboard\DashboardCalendarController@show')->name('calendar.show');
    Route::delete('/dashboard/calendar/{calendar}', 'Dashboard\DashboardCalendarController@destroy')->name('calendar.destroy');
    Route::put('/dashboard/calendar/{calendar}', 'Dashboard\DashboardCalendarController@update')->name('calendar.update');
    Route::get('/dashboard/weather', 'Dashboard\DashboardWeatherController@index')->name('dashboard.weather.index');
});
