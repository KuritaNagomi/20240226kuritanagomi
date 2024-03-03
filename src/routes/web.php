<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
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

Route::get('/', [ContactController::class, 'index'])->name('index');;

Route::post('/confirm', [ContactController::class, 'confirm']);

Route::post('/', [ContactController::class, 'edit']);

Route::post('/thanks', [ContactController::class, 'store']);

Route::get('/login', [AuthController::class, 'index'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AuthController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/admin', [AdminController::class, 'getContact']);

Route::delete('/admin', [AdminController::class, 'destroy']);

Route::get('/admin', [AdminController::class, 'search'])->name('admin');

Route::get('/admin/export', [AdminController::class, 'exportCSV'])->name('admin.export');
