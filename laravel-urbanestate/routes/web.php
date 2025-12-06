<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/tambah', [CategoryController::class, 'create']);
Route::post('/category/store', [CategoryController::class, 'store']);
Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
Route::put('/category/update/{id}', [CategoryController::class, 'update']);
Route::get('/category/hapus/{id}', [CategoryController::class, 'delete']);
Route::get('/category/destroy/{id}', [CategoryController::class, 'destroy']);
Route::post('/Order', [WelcomeController::class, 'CreateTransaction'])->name('transaction');
Route::get('/transaksi', [TransactionController::class, 'index']);
Route::get('/transaksi/cetak', [TransactionController::class, 'cetak']);

