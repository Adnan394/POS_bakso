<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OutletController;
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

Route::get('/', [LoginController::class, 'index'])->name('login'); // Mengarahkan ke halaman login
Route::prefix('/superadmin')->middleware('auth')->group(function() {
    Route::get('/', function () {
        return view('superadmin.dashboard');
    });
    Route::resource('/products', ProductController::class);
    Route::resource('/accounts', AccountController::class);
    Route::resource('/locations', LocationController::class);
    Route::resource('/payments', PaymentController::class);
    Route::resource('/outlets', OutletController::class);
});

Route::prefix('/admin')->middleware('auth')->group(function() {
    Route::get('/', function () {
        return view('admin.dashboard');
    });
    Route::resource('/products', ProductController::class);
    Route::resource('/payments', PaymentController::class);
    Route::resource('/outlets', OutletController::class);
});

Route::prefix('/kasir')->middleware('auth')->group(function() {
    Route::get('/', function () {
        return view('kasir.dashboard');
    });
    Route::resource('/products', ProductController::class);
    Route::resource('/payments', PaymentController::class);
    Route::resource('/outlets', OutletController::class);
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
