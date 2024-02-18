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
use App\Http\Controllers\StokHarianController;
use App\Models\Stok_harian;

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
           $revenue_today = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('payment_id', '!=', null)
            ->whereDate('transactions.created_at', today())
            ->sum('pay_amount');
            $revenue_week = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('payment_id', '!=', null)
            ->whereBetween('transactions.created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('pay_amount');
            $revenue_month = Transaction::join('users', 'users.id', 'transactions.user_id')
                ->join('user_details', 'users.id', 'user_details.user_id')
                ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
                ->where('payment_id', '!=', null)
                ->whereMonth('transactions.created_at', now()->month)
                ->sum('pay_amount');
            $revenue_outlet_depan_today = Transaction::join('users', 'users.id', 'transactions.user_id')
                ->join('user_details', 'users.id', 'user_details.user_id')
                ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
                ->where('outlet_details.id', 1)
                ->whereDate('transactions.created_at', today())->where('payment_id', '!=', null)->sum('pay_amount');
            $revenue_outlet_belakang_today = Transaction::join('users', 'users.id', 'transactions.user_id')
                ->join('user_details', 'users.id', 'user_details.user_id')
                ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
                ->where('outlet_details.id', 2)
                ->whereDate('transactions.created_at', today())->where('payment_id', '!=', null)->sum('pay_amount');
            $revenue_senin_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
                ->join('user_details', 'users.id', 'user_details.user_id')
                ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
                ->where('payment_id', '!=', null)
                ->whereDate('transactions.created_at', now()->startOfWeek()) // Hari Senin
                ->sum('pay_amount');
            $revenue_selasa_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
                ->join('user_details', 'users.id', 'user_details.user_id')
                ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
                ->where('payment_id', '!=', null)
                ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(1)) // Hari Selasa
                ->sum('pay_amount');
            $revenue_rabu_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
                ->join('user_details', 'users.id', 'user_details.user_id')
                ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
                ->where('payment_id', '!=', null)
                ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(2)) // Hari Rabu
                ->sum('pay_amount');
            $revenue_kamis_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
                ->join('user_details', 'users.id', 'user_details.user_id')
                ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
                ->where('payment_id', '!=', null)
                ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(3)) // Hari Kamis
                ->sum('pay_amount');
            $revenue_jumat_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
                ->join('user_details', 'users.id', 'user_details.user_id')
                ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
                ->where('payment_id', '!=', null)
                ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(4)) // Hari Jumat
                ->sum('pay_amount');
            $revenue_sabtu_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
                ->join('user_details', 'users.id', 'user_details.user_id')
                ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
                ->where('payment_id', '!=', null)
                ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(5)) // Hari Sabtu
                ->sum('pay_amount');
            $revenue_minggu_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
                ->join('user_details', 'users.id', 'user_details.user_id')
                ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
                ->where('payment_id', '!=', null)
                ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(6)) // Hari Minggu
                ->sum('pay_amount');
        return view('superadmin.dashboard', [
            'revenue_today' => number_format($revenue_today, 0, ",", ","),
            'revenue_week' => number_format($revenue_week, 0, ",", ","),
            'revenue_month' => number_format($revenue_month, 0, ",", ","),
            'revenue_outlet_belakang_today' => $revenue_outlet_belakang_today,
            'revenue_outlet_depan_today' => $revenue_outlet_depan_today,
            'revenue_senin_minggu_ini' => $revenue_senin_minggu_ini,
            'revenue_selasa_minggu_ini' => $revenue_selasa_minggu_ini,
            'revenue_rabu_minggu_ini' => $revenue_rabu_minggu_ini,
            'revenue_kamis_minggu_ini' => $revenue_kamis_minggu_ini,
            'revenue_jumat_minggu_ini' => $revenue_jumat_minggu_ini,
            'revenue_sabtu_minggu_ini' => $revenue_sabtu_minggu_ini,
            'revenue_minggu_minggu_ini' => $revenue_minggu_minggu_ini,
    ]);
    })->middleware('auth');
    Route::resource('/products', ProductController::class)->middleware('auth', 'admin_access', 'superadmin_access');
    Route::resource('/accounts', AccountController::class)->middleware('auth', 'superadmin_access');
    Route::resource('/locations', LocationController::class)->middleware('auth', 'superadmin_access');
    Route::resource('/tables', TabelController::class)->middleware('auth', 'admin_access', 'superadmin_access');
    Route::resource('/payments', PaymentController::class)->middleware('auth', 'admin_access', 'superadmin_access');
    Route::resource('/outlets', OutletController::class)->middleware('auth', 'admin_access', 'superadmin_access');
    Route::resource('bahan_setengah_jadi', bahanSetengahJadiController::class)->middleware('auth', 'superadmin_access');
    Route::get('/rekap_admin', [TransaksiController::class, 'rekap_admin'])->name('rekap_admin');
    Route::resource('/pengeluaran_admin', PengeluranController::class);
    Route::resource('/jurnal_admin', JurnalHarianController::class);
});

Route::prefix('/admin')->group(function() {
    Route::get('/', function () {
        $revenue_today = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->join('user_details', 'users.id', 'user_details.user_id')
        ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
        ->where('payment_id', '!=', null)
        ->whereDate('transactions.created_at', today())
        ->sum('pay_amount');
        $revenue_week = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->join('user_details', 'users.id', 'user_details.user_id')
        ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
        ->where('payment_id', '!=', null)
        ->whereBetween('transactions.created_at', [now()->startOfWeek(), now()->endOfWeek()])
        ->sum('pay_amount');
        $revenue_month = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('payment_id', '!=', null)
            ->whereMonth('transactions.created_at', now()->month)
            ->sum('pay_amount');
        $revenue_outlet_depan_today = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', 1)
            ->whereDate('transactions.created_at', today())->where('payment_id', '!=', null)->sum('pay_amount');
        $revenue_outlet_belakang_today = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', 2)
            ->whereDate('transactions.created_at', today())->where('payment_id', '!=', null)->sum('pay_amount');
        $revenue_senin_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('payment_id', '!=', null)
            // ->where('transaction.user_id.location_id', 1)
            ->whereDate('transactions.created_at', now()->startOfWeek()) // Hari Senin
            ->sum('pay_amount');
        $revenue_selasa_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('payment_id', '!=', null)
            // ->where('transaction.user_id.location_id', 1)
            ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(1)) // Hari Selasa
            ->sum('pay_amount');
        $revenue_rabu_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('payment_id', '!=', null)
            // ->where('transaction.user_id.location_id', 1)
            ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(2)) // Hari Rabu
            ->sum('pay_amount');
        $revenue_kamis_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('payment_id', '!=', null)
            // ->where('transaction.user_id.location_id', 1)
            ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(3)) // Hari Kamis
            ->sum('pay_amount');
        $revenue_jumat_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('payment_id', '!=', null)
            // ->where('transaction.user_id.location_id', 1)
            ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(4)) // Hari Jumat
            ->sum('pay_amount');
        $revenue_sabtu_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('payment_id', '!=', null)
            // ->where('transaction.user_id.location_id', 1)
            ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(5)) // Hari Sabtu
            ->sum('pay_amount');
        $revenue_minggu_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('payment_id', '!=', null)
            // ->where('transaction.user_id.location_id', 1)
            ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(6)) // Hari Minggu
            ->sum('pay_amount');
    return view('admin.dashboard', [
        'revenue_today' => number_format($revenue_today, 0, ",", ","),
        'revenue_week' => number_format($revenue_week, 0, ",", ","),
        'revenue_month' => number_format($revenue_month, 0, ",", ","),
        'revenue_outlet_belakang_today' => $revenue_outlet_belakang_today,
        'revenue_outlet_depan_today' => $revenue_outlet_depan_today,
        'revenue_senin_minggu_ini' => $revenue_senin_minggu_ini,
        'revenue_selasa_minggu_ini' => $revenue_selasa_minggu_ini,
        'revenue_rabu_minggu_ini' => $revenue_rabu_minggu_ini,
        'revenue_kamis_minggu_ini' => $revenue_kamis_minggu_ini,
        'revenue_jumat_minggu_ini' => $revenue_jumat_minggu_ini,
        'revenue_sabtu_minggu_ini' => $revenue_sabtu_minggu_ini,
        'revenue_minggu_minggu_ini' => $revenue_minggu_minggu_ini,
]);
    })->middleware('auth');
    Route::resource('/products', ProductController::class)->middleware('auth', 'admin_access', 'superadmin_access');
    Route::resource('/payments', PaymentController::class)->middleware('auth', 'admin_access', 'superadmin_access');
    Route::resource('/outlets', OutletController::class)->middleware('auth', 'admin_access', 'superadmin_access');
    Route::resource('/tables', TabelController::class)->middleware('auth', 'admin_access', 'superadmin_access');
    Route::resource('stok_harian', StokHarianController::class)->middleware('admin_access');
});

Route::prefix('/kasir')->middleware('auth')->group(function() {
    Route::get('/', function () {
        $transaksi_active =    $query = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->join('user_details', 'users.id', 'user_details.user_id')
        ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
        ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)->where('transactions.payment_id', null)
        ->whereDate('transactions.created_at', today())
        ->select('transactions.*')
        ->get();
        $transaksi_done =   $query = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->join('user_details', 'users.id', 'user_details.user_id')
        ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
        ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)->where('transactions.payment_id', '!=', null)
        ->whereDate('transactions.created_at', today())
        ->select('transactions.*')->get();
        $transaksi_total = $transaksi_active->count() + $transaksi_done->count();
        $persentase_active = $transaksi_active == null || $transaksi_active->count() == 0 ? 0 : ($transaksi_active->count() / $transaksi_total) * 100;
        $produks = Produk::all();
        $produk = $produks->count();
        $revenue_outlet_depan_today = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->join('user_details', 'users.id', 'user_details.user_id')
        ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
        ->where('outlet_details.id', 1)
        ->whereDate('transactions.created_at', today())->where('payment_id', '!=', null)->sum('pay_amount');
        $revenue_outlet_belakang_today = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->join('user_details', 'users.id', 'user_details.user_id')
        ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
        ->where('outlet_details.id', 2)
        ->whereDate('transactions.created_at', today())->where('payment_id', '!=', null)->sum('pay_amount');
        $revenue_today = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->join('user_details', 'users.id', 'user_details.user_id')
        ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
        ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
        ->whereDate('transactions.created_at', today())->where('payment_id', '!=', null)->sum('pay_amount');
        $revenue_week = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->join('user_details', 'users.id', 'user_details.user_id')
        ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
        ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
        ->where('payment_id', '!=', null)
        ->whereBetween('transactions.created_at', [now()->startOfWeek(), now()->endOfWeek()])
        ->sum('pay_amount');
        $revenue_month = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->where('payment_id', '!=', null)
            ->whereMonth('transactions.created_at', now()->month)
            ->sum('pay_amount');
        $revenue_senin_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->where('payment_id', '!=', null)
            ->whereDate('transactions.created_at', now()->startOfWeek()) // Hari Senin
            ->sum('pay_amount');
        $revenue_selasa_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->where('payment_id', '!=', null)
            ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(1)) // Hari Selasa
            ->sum('pay_amount');
        $revenue_rabu_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->where('payment_id', '!=', null)
            ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(2)) // Hari Rabu
            ->sum('pay_amount');
        $revenue_kamis_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->where('payment_id', '!=', null)
            ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(3)) // Hari Kamis
            ->sum('pay_amount');
        $revenue_jumat_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->where('payment_id', '!=', null)
            ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(4)) // Hari Jumat
            ->sum('pay_amount');
        $revenue_sabtu_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->where('payment_id', '!=', null)
            ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(5)) // Hari Sabtu
            ->sum('pay_amount');
        $revenue_minggu_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->where('payment_id', '!=', null)
            ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(6)) // Hari Minggu
            ->sum('pay_amount');
            $revenue_total_today = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('payment_id', '!=', null)
            ->whereDate('transactions.created_at', today())
            ->sum('pay_amount');
            $revenue_total_week = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('payment_id', '!=', null)
            ->whereBetween('transactions.created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('pay_amount');
            $revenue_total_month = Transaction::join('users', 'users.id', 'transactions.user_id')
                ->join('user_details', 'users.id', 'user_details.user_id')
                ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
                ->where('payment_id', '!=', null)
                ->whereMonth('transactions.created_at', now()->month)
                ->sum('pay_amount');
        return view('kasir.dashboard', [
            'revenue_senin_minggu_ini' => $revenue_senin_minggu_ini,
            'revenue_selasa_minggu_ini' => $revenue_selasa_minggu_ini,
            'revenue_rabu_minggu_ini' => $revenue_rabu_minggu_ini,
            'revenue_kamis_minggu_ini' => $revenue_kamis_minggu_ini,
            'revenue_jumat_minggu_ini' => $revenue_jumat_minggu_ini,
            'revenue_sabtu_minggu_ini' => $revenue_sabtu_minggu_ini,
            'revenue_minggu_minggu_ini' => $revenue_minggu_minggu_ini,
            'revenue_outlet_belakang_today' => $revenue_outlet_belakang_today,
            'revenue_outlet_depan_today' => $revenue_outlet_depan_today,
            'revenue_today' => number_format($revenue_today, 0, ",", ","),
            'revenue_week' => number_format($revenue_week, 0, ",", ","),
            'revenue_month' => number_format($revenue_month, 0, ",", ","),
            'revenue_total_today' => number_format($revenue_total_today, 0, ",", ","),
            'revenue_total_week' => number_format($revenue_total_week, 0, ",", ","),
            'revenue_total_month' => number_format($revenue_total_month, 0, ",", ","),
            'transaksi_active' => $transaksi_active, 'transaksi_done' => $transaksi_done, 'transaksi_total' => $transaksi_total,  'persentase_active' => $persentase_active, 'produks' => $produks, 'produk' => $produk]);
});
    Route::resource('/transaksi', TransaksiController::class);
    Route::post('/transaksi/tambah', [TransaksiController::class, 'tambah_pesanan'])->name('kasir_tambah_pesanan');
    Route::get('create_transaksi', [TransaksiController::class, 'create_transaksi'])->name('create_transaksi');
    Route::get('/berjalan', [TransaksiController::class, 'berjalan'])->name('transaksi.kasir_berjalan');
    Route::get('/selesai', [TransaksiController::class, 'selesai'])->name('transaksi.kasir_selesai');
    Route::get('/nota/{id}', [TransaksiController::class, 'nota'])->name('transaksi.nota');
    Route::get('/print_rekap_produk', [TransaksiController::class, 'print_rekap_produk'])->name('print_rekap_produk');
    Route::get('/print_rekap_harian', [TransaksiController::class, 'print_rekap_harian'])->name('print_rekap_harian');
    Route::post('/selesaikan_pesanan', [TransaksiController::class, 'selesaikan_pesanan'])->name('kasir_selesaikan_pesanan');
    Route::get('/pesanan_selesai', [TransaksiController::class, 'pesanan_selesai'])->name('kasir_pesanan_selesai');
    Route::get('/pesanan_diproses', [TransaksiController::class, 'pesanan_diproses'])->name('kasir_pesanan_diproses');
    Route::get('/konfirmasi', [TransaksiController::class, 'konfirmasi'])->name('kasir_konfirmasi');
    Route::put('/konfirmasi_store/{id}', [TransaksiController::class, 'konfirmasi_store'])->name('konfirmasi_store');
    Route::get('/rekap_harian', [TransaksiController::class, 'rekap_harian'])->name('rekap_harian');
    Route::get('/rekap_produk', [TransaksiController::class, 'rekap_produk'])->name('rekap_produk');
    Route::resource('/pengeluaran_harian', PengeluranController::class);
    Route::get('/pengeluaran_harian_print', [PengeluranController::class, 'pengeluaran_harian_print'])->name('pengeluaran_harian_print');
    Route::resource('/jurnal_harian', JurnalHarianController::class);
    Route::get('/jurnal_harian_print', [JurnalHarianController::class, 'jurnal_harian_print'])->name('jurnal_harian_print');
    Route::post('transaction_salah/{id}', [TransaksiController::class, 'transaction_salah_store'])->name('transaction_salah_store');
    Route::get('transaction_salah', [TransaksiController::class, 'transaction_salah'])->name('transaction_salah');
});
Route::prefix('/waiters')->middleware('auth')->group(function() {
    Route::get('/', function () {
        $transaksi_active =    $query = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->join('user_details', 'users.id', 'user_details.user_id')
        ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
        ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)->where('transactions.payment_id', null)
        ->whereDate('transactions.created_at', today())
        ->select('transactions.*')
        ->get();
        $transaksi_done =   $query = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->join('user_details', 'users.id', 'user_details.user_id')
        ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
        ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)->where('transactions.payment_id', '!=', null)
        ->whereDate('transactions.created_at', today())
        ->select('transactions.*')->get();
        $transaksi_total = $transaksi_active->count() + $transaksi_done->count();
        $persentase_active = $transaksi_active == null || $transaksi_active->count() == 0 ? 0 : ($transaksi_active->count() / $transaksi_total) * 100;
        $produks = Produk::all();
        $produk = $produks->count();
        $revenue_outlet_depan_today = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->join('user_details', 'users.id', 'user_details.user_id')
        ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
        ->where('outlet_details.id', 1)
        ->whereDate('transactions.created_at', today())->where('payment_id', '!=', null)->sum('pay_amount');
        $revenue_outlet_belakang_today = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->join('user_details', 'users.id', 'user_details.user_id')
        ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
        ->where('outlet_details.id', 2)
        ->whereDate('transactions.created_at', today())->where('payment_id', '!=', null)->sum('pay_amount');
        $revenue_today = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->join('user_details', 'users.id', 'user_details.user_id')
        ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
        ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
        ->whereDate('transactions.created_at', today())->where('payment_id', '!=', null)->sum('pay_amount');
        $revenue_week = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->join('user_details', 'users.id', 'user_details.user_id')
        ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
        ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
        ->where('payment_id', '!=', null)
        ->whereBetween('transactions.created_at', [now()->startOfWeek(), now()->endOfWeek()])
        ->sum('pay_amount');
        $revenue_month = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->where('payment_id', '!=', null)
            ->whereMonth('transactions.created_at', now()->month)
            ->sum('pay_amount');
        $revenue_senin_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->where('payment_id', '!=', null)
            ->whereDate('transactions.created_at', now()->startOfWeek()) // Hari Senin
            ->sum('pay_amount');
        $revenue_selasa_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->where('payment_id', '!=', null)
            ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(1)) // Hari Selasa
            ->sum('pay_amount');
        $revenue_rabu_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->where('payment_id', '!=', null)
            ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(2)) // Hari Rabu
            ->sum('pay_amount');
        $revenue_kamis_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->where('payment_id', '!=', null)
            ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(3)) // Hari Kamis
            ->sum('pay_amount');
        $revenue_jumat_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->where('payment_id', '!=', null)
            ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(4)) // Hari Jumat
            ->sum('pay_amount');
        $revenue_sabtu_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->where('payment_id', '!=', null)
            ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(5)) // Hari Sabtu
            ->sum('pay_amount');
        $revenue_minggu_minggu_ini = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->where('payment_id', '!=', null)
            ->whereDate('transactions.created_at', now()->startOfWeek()->addDays(6)) // Hari Minggu
            ->sum('pay_amount');
            $revenue_total_today = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('payment_id', '!=', null)
            ->whereDate('transactions.created_at', today())
            ->sum('pay_amount');
            $revenue_total_week = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('payment_id', '!=', null)
            ->whereBetween('transactions.created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('pay_amount');
            $revenue_total_month = Transaction::join('users', 'users.id', 'transactions.user_id')
                ->join('user_details', 'users.id', 'user_details.user_id')
                ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
                ->where('payment_id', '!=', null)
                ->whereMonth('transactions.created_at', now()->month)
                ->sum('pay_amount');
        return view('waiters.dashboard', [
            'revenue_senin_minggu_ini' => $revenue_senin_minggu_ini,
            'revenue_selasa_minggu_ini' => $revenue_selasa_minggu_ini,
            'revenue_rabu_minggu_ini' => $revenue_rabu_minggu_ini,
            'revenue_kamis_minggu_ini' => $revenue_kamis_minggu_ini,
            'revenue_jumat_minggu_ini' => $revenue_jumat_minggu_ini,
            'revenue_sabtu_minggu_ini' => $revenue_sabtu_minggu_ini,
            'revenue_minggu_minggu_ini' => $revenue_minggu_minggu_ini,
            'revenue_outlet_belakang_today' => $revenue_outlet_belakang_today,
            'revenue_outlet_depan_today' => $revenue_outlet_depan_today,
            'revenue_today' => number_format($revenue_today, 0, ",", ","),
            'revenue_week' => number_format($revenue_week, 0, ",", ","),
            'revenue_month' => number_format($revenue_month, 0, ",", ","),
            'revenue_total_today' => number_format($revenue_total_today, 0, ",", ","),
            'revenue_total_week' => number_format($revenue_total_week, 0, ",", ","),
            'revenue_total_month' => number_format($revenue_total_month, 0, ",", ","),
            'transaksi_active' => $transaksi_active, 'transaksi_done' => $transaksi_done, 'transaksi_total' => $transaksi_total,  'persentase_active' => $persentase_active, 'produks' => $produks, 'produk' => $produk]);
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
    Route::get('stok_harian', [StokHarianController::class, 'index'])->name('stok_harian');
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