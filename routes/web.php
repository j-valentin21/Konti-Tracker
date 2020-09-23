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
    return view('index');
})->name('index');

Auth::routes();
Route::middleware(['auth', 'firstTimeUser'])->group(function () {
    Route::get('/register/build-your-profile', 'ProfileController@create')->name('profile');
    Route::post('/register/build-your-profile', 'ProfileController@post')->name('profile.post');
    Route::get('/register/pto_points.blade.php', 'PtoPointsController@create')->name('pto_points.blade.php');

});


Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
