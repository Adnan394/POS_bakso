<?php

use App\Models\Produk;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TabelController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\MinumanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\PengeluranController;
use App\Http\Controllers\PesananOutletController;
use App\Http\Controllers\TransaksiDetailController;
use App\Http\Controllers\bahanSetengahJadiController;
use App\Http\Controllers\JurnalHarianController;

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
Route::prefix('/superadmin')->group(function() {
    Route::get('/', function () {
        return view('superadmin.dashboard');
    })->middleware('auth');
    Route::resource('/products', ProductController::class)->middleware('auth', 'admin_access', 'superadmin_access');
    Route::resource('/accounts', AccountController::class)->middleware('auth', 'superadmin_access');
    Route::resource('/locations', LocationController::class)->middleware('auth', 'superadmin_access');
    Route::resource('/tables', TabelController::class)->middleware('auth', 'admin_access', 'superadmin_access');
    Route::resource('/payments', PaymentController::class)->middleware('auth', 'admin_access', 'superadmin_access');
    Route::resource('/outlets', OutletController::class)->middleware('auth', 'admin_access', 'superadmin_access');
    Route::resource('bahan_setengah_jadi', bahanSetengahJadiController::class)->middleware('auth', 'superadmin_access');
});

Route::prefix('/admin')->group(function() {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->middleware('auth');
    Route::resource('/products', ProductController::class)->middleware('auth', 'admin_access', 'superadmin_access');
    Route::resource('/payments', PaymentController::class)->middleware('auth', 'admin_access', 'superadmin_access');
    Route::resource('/outlets', OutletController::class)->middleware('auth', 'admin_access', 'superadmin_access');
    Route::resource('/tables', TabelController::class)->middleware('auth', 'admin_access', 'superadmin_access');

});

Route::prefix('/kasir')->middleware('auth')->group(function() {
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
    Route::post('/transaksi/tambah', [TransaksiController::class, 'tambah_pesanan'])->name('kasir_tambah_pesanan');
    Route::get('create_transaksi', [TransaksiController::class, 'create_transaksi'])->name('create_transaksi');
    Route::get('/berjalan', [TransaksiController::class, 'berjalan'])->name('transaksi.kasir_berjalan');
    Route::get('/selesai', [TransaksiController::class, 'selesai'])->name('transaksi.kasir_selesai');
    Route::get('/nota/{id}', [TransaksiController::class, 'nota'])->name('transaksi.nota');
    Route::post('/selesaikan_pesanan', [TransaksiController::class, 'selesaikan_pesanan'])->name('kasir_selesaikan_pesanan');
    Route::get('/pesanan_selesai', [TransaksiController::class, 'pesanan_selesai'])->name('kasir_pesanan_selesai');
    Route::get('/pesanan_diproses', [TransaksiController::class, 'pesanan_diproses'])->name('kasir_pesanan_diproses');
    Route::get('/konfirmasi', [TransaksiController::class, 'konfirmasi'])->name('kasir_konfirmasi');
    Route::put('/konfirmasi_store/{id}', [TransaksiController::class, 'konfirmasi_store'])->name('konfirmasi_store');
    Route::get('/rekap_harian', [TransaksiController::class, 'rekap_harian'])->name('rekap_harian');
    Route::get('/rekap_produk', [TransaksiController::class, 'rekap_produk'])->name('rekap_produk');
    Route::resource('/pengeluaran_harian', PengeluranController::class);
    Route::resource('/jurnal_harian', JurnalHarianController::class);
});
Route::prefix('/waiters')->middleware('auth')->group(function() {
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
    Route::get('/pesanan_selesai', [TransaksiController::class, 'pesanan_selesai'])->name('pesanan_selesai');
    Route::get('/pesanan_diproses', [TransaksiController::class, 'pesanan_diproses'])->name('pesanan_diproses');
    Route::get('/konfirmasi', [TransaksiController::class, 'konfirmasi'])->name('konfirmasi');
});

Route::prefix('/outlet')->middleware('auth', 'outlet_access')->group(function() {
    Route::get('/', function () {
        return view('outlet.dashboard');

    });
    Route::resource('/pesanan', PesananOutletController::class);
    Route::get('/pesanan-selesai', [PesananOutletController::class, 'selesai'])->name('pesanan-selesai');
});


Route::get('testnotif', [PesananOutletController::class, 'testnotif']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');