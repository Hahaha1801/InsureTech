<?php

use App\Http\Controllers\AgentDashboardController;
use App\Http\Controllers\CustomerDashboardController;

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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/customer/home', [CustomerDashboardController::class, 'index'])->name('customer.home');
Route::get('/agent/home', [AgentDashboardController::class, 'index'])->name('agent.home');
