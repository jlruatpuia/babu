<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionsController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('/customers', CustomersController::class);
Route::get('/transactions/{dt?}', [TransactionsController::class, 'index'])->name('transactions');
Route::post('/transactions/{dt?}', [TransactionsController::class, 'indexDate'])->name('transactions.date');
Route::get('/transaction/create', [TransactionsController::class, 'create'])->name('transaction.create');
Route::post('/transaction', [TransactionsController::class, 'store'])->name('transaction.store');
Route::get('/transaction/customer/{id}', [TransactionsController::class, 'show'])->name('transaction.show');
