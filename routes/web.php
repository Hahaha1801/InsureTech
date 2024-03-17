<?php


use App\Http\Controllers\AgentController;
use App\Http\Controllers\CustomerController;

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

Route::get('/customers', [CustomerController::class, 'index'])->name('customer.viewAll');
Route::get('/customer/{customer}', [CustomerController::class, 'show'])->name('customer.show');
Route::delete('/customer/{customer}', [CustomerController::class, 'destroy'])->name('customer.destroy');

Route::get('/agents', [AgentController::class, 'index'])->name('agent.viewAll');
Route::get('/agent/{agent}', [AgentController::class, 'show'])->name('agent.show');
Route::delete('/agent/{agent}', [AgentController::class, 'destroy'])->name('agent.destroy');
