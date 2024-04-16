<?php


use App\Http\Controllers\AgentController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\PolicyController;
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

// Route::get('/policies/create', [PolicyController::class, 'index'])->name('policy.createPolicy');
// Route::post('/policies', [PolicyController::class, 'store'])->name('policies.store');

Route::get('/policies', [PolicyController::class, 'index'])->name('policies.index');
Route::get('/policies/create', [PolicyController::class, 'create'])->name('policies.create');
Route::post('/policies', [PolicyController::class, 'store'])->name('policies.store');
Route::get('/policies/{policy}', [PolicyController::class, 'show'])->name('policies.show');
Route::get('/policies/{policy}/edit', [PolicyController::class, 'edit'])->name('policies.edit');
Route::put('/policies/{policy}', [PolicyController::class, 'update'])->name('policies.update');
Route::delete('/policies/{policy}', [PolicyController::class, 'destroy'])->name('policies.destroy');
Route::post('/policy/{id}/upload-pdf', [PolicyController::class, 'uploadPdf'])->name('policy.upload.pdf');

Route::post('/claims/create',[ClaimController::class, 'store'])->name('claims.store');
Route::get('/claims', [ClaimController::class, 'index'])->name('claims.index');
