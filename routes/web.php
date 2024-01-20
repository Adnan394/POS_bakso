<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Transaction;
use App\Models\Produk;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\TabelController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\MinumanController;
use App\Http\Controllers\PesananOutletController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiDetailController;

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
Route::get('/403', function() {
    return view('403');
});
Route::get('/', [LoginController::class, 'index'])->name('login'); // Mengarahkan ke halaman login
Route::prefix('/superadmin')->middleware('auth', 'superadmin_access')->group(function() {
    Route::get('/', function () {
        return view('superadmin.dashboard');
    });
    Route::resource('/products', ProductController::class);
    Route::resource('/accounts', AccountController::class);
    Route::resource('/locations', LocationController::class);
    Route::resource('/tables', TabelController::class);
    Route::resource('/payments', PaymentController::class);
    Route::resource('/outlets', OutletController::class);
});

Route::prefix('/admin')->middleware('auth', 'admin_access')->group(function() {
    Route::get('/', function () {
        return view('admin.dashboard');
    });
    Route::resource('/products', ProductController::class);
    Route::resource('/payments', PaymentController::class);
    Route::resource('/outlets', OutletController::class);
    Route::resource('/tables', TabelController::class);

});

Route::prefix('/kasir')->middleware('auth', 'kasir_access')->group(function() {
    Route::get('/', function () {
        $transaksi_active = Transaction::where('payment_id', null)->get();
        $transaksi_done = Transaction::where('payment_id', '!=', null)->get();
        $transaksi_total = $transaksi_active->count() + $transaksi_done->count();
        $persentase_active = $transaksi_active == null || $transaksi_active->count() == 0 ? 0 : ($transaksi_active->count() / $transaksi_total) * 100;
        $produks = Produk::all();
        $produk = $produks->count();
        return view('kasir.dashboard', ['transaksi_active' => $transaksi_active, 'transaksi_done' => $transaksi_done, 'transaksi_total' => $transaksi_total, 'persentase_active' => $persentase_active, 'produks' => $produks, 'produk' => $produk]);
    });
    Route::resource('/transaksi', TransaksiController::class);
    Route::post('/transaksi/tambah', [TransaksiController::class, 'tambah_pesanan'])->name('tambah_pesanan');
    Route::get('/berjalan', [TransaksiController::class, 'berjalan'])->name('transaksi.berjalan');
    Route::get('/selesai', [TransaksiController::class, 'selesai'])->name('transaksi.selesai');
    Route::get('/nota/{id}', [TransaksiController::class, 'nota'])->name('transaksi.nota');
    Route::post('/selesaikan_pesanan', [TransaksiController::class, 'selesaikan_pesanan'])->name('selesaikan_pesanan');
});
Route::prefix('/outlet')->middleware('auth', 'outlet_access')->group(function() {
    Route::get('/', function () {
        return view('outlet.dashboard');

    });
    Route::resource('/pesanan', PesananOutletController::class);
});


Route::get('testnotif', [PesananOutletController::class, 'testnotif']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');