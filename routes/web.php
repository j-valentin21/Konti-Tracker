<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@index')->name('index');
Route::get('/contact-us', 'ContactUsController@index')->name('contact-us');
Route::post('/contact-us', 'ContactUsController@create')->name('contact-us.create');

Auth::routes(['verify' => true]);

Route::get('/register/build-your-profile', 'ProfileController@index')->name('profile.index');
Route::post('/register/build-your-profile', 'ProfileController@create')->name('profile.create');
Route::get('/register/avatar', 'AvatarController@index')->name('avatar.index');
Route::post('/register/avatar', 'AvatarController@create')->name('avatar.create');
Route::delete('/register/remove-avatar', 'AvatarController@destroy')->name('avatar.destroy');
Route::get('/register/confirmation', 'ConfirmationController@index')->name('confirmation.index');
Route::post('/register/store', 'ConfirmationController@store')->name('confirmation.store');

Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard.index');
Route::put('/dashboard', 'Dashboard\DashboardController@update')->name('dashboard.update');
Route::post('/dashboard', 'Dashboard\DashboardController@create')->name('dashboard.create');
Route::get('/dashboard/pto-chart', 'Dashboard\DashboardController@getPTOChartData')->name('dashboard.getPTOChartData');
Route::get('/dashboard/points-chart', 'Dashboard\DashboardController@getPointsChartData')->name('dashboard.getPointsChartData');
Route::get('/dashboard/get-activity', 'Dashboard\DashboardActivityController@getActivityData')->name('dashboard.getActivityData');
Route::get('/dashboard/get-notifications', 'Dashboard\DashboardController@getNotificationsData')->name('dashboard.getNotificationsData');
Route::get('/dashboard/notifications', 'Dashboard\DashboardNotificationController@index')->name('dashboard.notification.index');
Route::delete('/dashboard/notifications/{id}', 'Dashboard\DashboardNotificationController@destroy')->name('dashboard.notification.destroy');
Route::delete('/dashboard/activity/{id}', 'Dashboard\DashboardActivityController@destroy')->name('dashboard.notification.destroy');
Route::get('/dashboard/profile', 'Dashboard\DashboardProfileController@index')->name('dashboard.profile.index');
Route::put('/dashboard/profile', 'Dashboard\DashboardProfileController@update')->name('dashboard.profile.update');
Route::delete('/dashboard/remove-avatar', 'Dashboard\DashboardProfileController@destroy')->name('dashboard.profile.destroy');
Route::get('/dashboard/pto-points-data', 'Dashboard\DashboardPTOPointsController@index')->name('dashboard.PTOPoints.index');
Route::put('/dashboard/pto-points-data', 'Dashboard\DashboardPTOPointsController@update')->name('dashboard.PTOPoints.update');
Route::get('/dashboard/activity', 'Dashboard\DashboardActivityController@index')->name('dashboard.activity.index');
Route::delete('/dashboard/activity/{id}', 'Dashboard\DashboardActivityController@destroy')->name('dashboard.activity.destroy');
Route::get('/dashboard/change-password', 'Dashboard\DashboardPasswordController@index')->name('dashboard.password.index');
Route::put('/dashboard/change-password', 'Dashboard\DashboardPasswordController@update')->name('dashboard.password.update');
Route::post('/dashboard/calendar', 'Dashboard\DashboardCalendarController@store')->name('calendar.store');
Route::get('/dashboard/calendar', 'Dashboard\DashboardCalendarController@index')->name('calendar.index');
Route::get('/dashboard/calendar/events', 'Dashboard\DashboardCalendarController@getCalendarData')->name('calendar.getCalendarData');
Route::get('/dashboard/calendar/{calendar}', 'Dashboard\DashboardCalendarController@show')->name('calendar.show');
Route::delete('/dashboard/calendar/{calendar}', 'Dashboard\DashboardCalendarController@destroy')->name('calendar.destroy');
Route::put('/dashboard/calendar/{calendar}', 'Dashboard\DashboardCalendarController@update')->name('calendar.update');
Route::get('/dashboard/weather', 'Dashboard\DashboardWeatherController@index')->name('dashboard.weather.index');

