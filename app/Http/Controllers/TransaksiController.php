<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Table;
use App\Models\Produk;
use App\Models\Payment;
use App\Models\Location;
use App\Models\Transaction;
use Illuminate\Http\Request;
use GuzzleHttp\Handler\Proxy;
use App\Events\OutletNotification;
use App\Models\Transaction_detail;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('kasir.dashboard');
    }

    public function konfirmasi(Request $request)
    {    
        // $data = Transaction::whereIn('user_id', User::where('role_id', 5)->pluck('id'))->get();
        $data = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->join('user_details', 'users.id', 'user_details.user_id')
        ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
        ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
        ->whereIn('transactions.user_id', User::where('role_id', 5)->pluck('id'))->select('transactions.*')->get();
        
        return view('kasir.transaksi.konfirmasi', ['transaksi' => $data]);
    }
    
    public function konfirmasi_store($id) {
        Transaction::where('id', $id)->update(['confirm_order' => 1]);
        return redirect()->back();
    }
    public function berjalan(Request $request)
    {
        $keyword = $request->input('keyword');
    
        // Query dasar untuk mendapatkan transaksi yang belum memiliki payment_id
        $query = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->join('user_details', 'users.id', 'user_details.user_id')
        ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
        ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)->where('transactions.payment_id', null)
        ->select('transactions.*');
    
        // Jika ada keyword, tambahkan kondisi pencarian
        if ($keyword) {
            $query->where(function ($subQuery) use ($keyword) {
                $subQuery->where('name_customer', 'like', "%$keyword%")
                    ->orWhereHas('table', function ($tableQuery) use ($keyword) {
                        $tableQuery->where('number', 'like', "%$keyword%");
                    });
            });
        }
    
        // Ambil hasil query dan kirimkan ke view
        $transaksi = $query->get();
        
        return view('kasir.transaksi.berjalan', ['transaksi' => $transaksi]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = Table::where('outlet_detail_id', Auth::user()->user_detail->outlet_detail_id)->get();
        $products = Produk::where('status_stock', 'Tersedia')->get();
        return view('kasir.transaksi.baru', ['products' => $products, 'tables' => $tables]);
    }
    public function create_transaksi()
    {
        $tables = Table::where('outlet_detail_id', Auth::user()->user_detail->outlet_detail_id)->get();
        $products = Produk::where('status_stock', 'Tersedia')->get();
        return view('kasir.transaksi.baru', ['products' => $products, 'tables' => $tables]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
            $transaction = Transaction::create([
                'payment_id' => ($request->payment_id) ? $request->payment_id : null,
                'table_id' => $request->table_id,
                'price_amount' => $request->price_amount,
                'payment_image' => ($request->payment_image) ? $request->payment_image : null,
                'discount' => ($request->discount) ? $request->discount : null,
                'pay_amount' => $request->price_amount,
                'order_type' => $request->order_type,
                'user_id' => Auth::user()->id,
                'name_customer' => $request->name_customer
            ]);

            foreach($request->produk as $index => $product) {
                $qty = $request->qty[$index];
                $pesan = $request->pesan[$index];
                
                if ($qty != null) {
                    Transaction_detail::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $product,
                        'price' => Produk::where('id', $product)->first()->price,
                        'qty' => $qty,
                        'note' => $pesan,
                        'status' => "Berjalan",
                        'order_status' => 'Diproses',
                        'order_sequence' => 1
                    ]);
                }
            }

            $datasend = [
                'transaction_id' => $transaction->id,
                'product_id' => $product,
                'qty' => $qty,
                'time' => $transaction->created_at->format('D, d/mY'),
                'message' => 'Transaksi Baru',
            ];

            event(new OutletNotification($datasend));

            
            if (Auth::user()->role_id == 3) {
                return redirect()->route('transaksi.kasir_berjalan')->with('success', 'Data Transaksi berhasil ditambahkan.');
            } elseif (Auth::user()->role_id == 5) {
                return redirect()->route('transaksi.berjalan')->with('success', 'Data Transaksi berhasil ditambahkan.');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Produk::all();
        $tables = Table::all();        
        $data = Transaction::where('transactions.id', $id)
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->select(['transactions.*', 'transaction_details.id as transaction_detail_id', 'transaction_details.*'])
            ->get();

        return view('kasir.transaksi.detail', ['product' => $data, 'products' => $products , 'tables' => $tables, 'data' => Transaction::where('id', $id)->first()]);
    }   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment = Payment::all();
        $products = Produk::all();
        $tables = Table::all();        
        $data = Transaction::where('transactions.id', $id)
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->select(['transactions.*', 'transaction_details.*'])
            ->get();
        // return Transaction::where('id', $id)->first();
        return view('kasir.transaksi.edit', ['data' => Transaction::where('id', $id)->first(),'product' => $data, 'products' => $products, 'payment' => $payment]);
    }

    public function selesai(Request $request) {

        $keyword = $request->input('keyword');
    
        // Query dasar untuk mendapatkan transaksi yang belum memiliki payment_id
        $query = Transaction::join('users', 'users.id', 'transactions.user_id')
        ->join('user_details', 'users.id', 'user_details.user_id')
        ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
        ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)->where('transactions.payment_id', '!=', null)
        ->select('transactions.*');
    
        // Jika ada keyword, tambahkan kondisi pencarian
        if ($keyword) {
            $query->where(function ($subQuery) use ($keyword) {
                $subQuery->where('name_customer', 'like', "%$keyword%")
                    ->orWhereHas('table', function ($tableQuery) use ($keyword) {
                        $tableQuery->where('number', 'like', "%$keyword%");
                    });
            });
        }
        
    
        // Ambil hasil query dan kirimkan ke view
        $transaksi = $query->get();

        return view('kasir.transaksi.selesai', ['transaksi' => $transaksi]);
    }

    public function selesaikan_pesanan(Request $request) {
        Transaction::where('id', $request->transaction_id)->update([
            'payment_id' => $request->payment_id,
            'pay_receive' => $request->paid,
            'pay_return' => $request->return
        ]);

        foreach (Transaction_detail::where('transaction_id', $request->transaction_id)->get() as $td) {
            Transaction_detail::where('id', $td->id)->update([
                'status' => "Selesai"
            ]);
        }

        $data = Transaction::where('transactions.id', $request->transaction_id)
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->select(['transactions.*', 'transaction_details.*'])
            ->get();
        return view('kasir.transaksi.nota', ['product' => $data,  'data' => Transaction::where('id', $request->transaction_id)->first(), 'location' => Location::where('id', Auth::user()->location->id)->first(), 'paid' => $request->paid]);
    }

    public function nota($id) {
        $data = Transaction::where('transactions.id', $id)
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->select(['transactions.*', 'transaction_details.*'])
            ->get();
        return view('kasir.transaksi.nota', ['product' => $data,  'data' => Transaction::where('id', $id)->first(), 'location' => Location::where('id', Auth::user()->location->id)->first()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    public function tambah_pesanan(Request $request) {
        $order_sequence = Transaction_detail::where('transaction_id', $request->transaksi_id)->orderBy('created_at', 'DESC')->limit(1)->first();
        $transaction = Transaction::where('id', $request->transaksi_id)->update([
            'price_amount' => $request->price_amount, 
            'pay_amount' => $request->price_amount,
            'order_type' => $request->order_type
        ]);

        foreach ($request->prev_transaction_detail_id as $index => $transaction_id) {
            $prev_produk = $request->prev_produk[$index];
            $prev_status = $request->prev_status[$index];
            $prev_order_sequence = $request->prev_order_sequence[$index];
            $prev_qty = $request->prev_qty[$index];

            Transaction_detail::where('id', $transaction_id)->update([
                'product_id' => $prev_produk,
                'status' => $prev_status,
                'qty' => $prev_qty,
                'order_sequence' => $prev_order_sequence,
            ]);
        }

        foreach($request->produk as $index => $product) {
            $qty = $request->qty[$index];
            $pesan = $request->pesan[$index];
            
            if ($qty != null) {
                Transaction_detail::create([
                    'transaction_id' => $request->transaksi_id,
                    'product_id' => $product,
                    'price' => Produk::where('id', $product)->first()->price,
                    'qty' => $qty,
                    'status' => "Berjalan",
                    'order_status' => "Diproses",
                    'order_sequence' => $order_sequence->order_sequence + 1,
                    'note' => $pesan
                ]);
            }
        }

        $datasend = [
            'transaction_id' => $request->transaksi_id,
            'product_id' => $product,
            'qty' => $qty,
            'message' => 'Transaksi Tambahan Baru',
        ];

        event(new OutletNotification($datasend));

        return redirect()->route('transaksi.berjalan');
    }

    public function pesanan_diproses()
    {
        // $transaksi = Transaction::where('payment_id', null)->get();
        $user = User::join('user_details', 'users.id', '=', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', '=', 'outlet_details.id')
            ->where('users.id', Auth::user()->id)
            ->select('outlet_details.id')
            ->first();
        $transaksi = Transaction::join('transaction_details', function($q) {
                $q->on('transactions.id', 'transaction_details.transaction_id')
                ->where('transaction_details.order_status', 'Diproses')
                ->orderByDesc('transaction_details.created_at')
                ->limit(1);
            })
            ->join('users', 'transactions.user_id', 'users.id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', $user->id)
            ->orderBy('transaction_details.updated_at')
            ->select(['transactions.*'])
            ->distinct()
            ->get();
        return view('kasir.transaksi.pesanan', ['transaksi' => $transaksi]);
    }

    public function pesanan_selesai() {
        // $transaksi = Transaction::where('payment_id', null)->get();
        $user = User::join('user_details', 'users.id', '=', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', '=', 'outlet_details.id')
            ->where('users.id', Auth::user()->id)
            ->select('outlet_details.id')
            ->first();
        $transaksi = Transaction::join('transaction_details', function($q) {
                $q->on('transactions.id', 'transaction_details.transaction_id')
                ->where('transaction_details.order_status', 'Jadi')
                ->orderByDesc('transaction_details.created_at')
                ->limit(1);
            })
            ->join('users', 'transactions.user_id', 'users.id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', $user->id)
            ->orderByDesc('transaction_details.updated_at')
            ->select(['transactions.*'])
            ->distinct()
            ->get();
        return view('kasir.transaksi.pesanan-selesai', ['transaksi' => $transaksi]);
    }

    public function rekap_harian(Request $request) {
        // ada req date 
        if($request->date) {
            $time = $request->date;
            $carbonDate = Carbon::parse($time);
            $humanTime = $carbonDate->format('d F Y');
            $transaction = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->whereDate('transactions.created_at', $time)
            ->select(['transactions.*', 'users.name as user_name'])
            ->get();
            $transaction_detail = Transaction::join('transaction_details', 'transactions.id', 'transaction_details.transaction_id')
                                ->join('produks', 'transaction_details.product_id', 'produks.id')
                                ->join('users', 'users.id', 'transactions.user_id')
                                ->join('user_details', 'users.id', 'user_details.user_id')
                                ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
                                ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
                                ->whereDate('transactions.created_at', $time)
                                ->select(['transaction_details.*', 'users.name as user_name', 'produks.name as produk_name'])
                                ->get();
            $revenue = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->whereDate('transactions.created_at', $time)->where('payment_id', '!=', null)->sum('pay_amount');
            $earningCash = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->whereDate('transactions.created_at', $time)->where('payment_id', 1)->sum('pay_amount');
            $earningQris = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->whereDate('transactions.created_at', $time)->where('payment_id', 2)->sum('pay_amount');
            $earningBank = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->whereDate('transactions.created_at', $time)->where('payment_id', 3)->sum('pay_amount');
            $minus = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->whereDate('transactions.created_at', $time)->where('payment_id', null)->sum('pay_amount');
            echo json_encode([
                'transactions' => $transaction, 
                'transaction_details' => $transaction_detail,
                'human_time' => $humanTime,
                'revenue' => number_format($revenue, 0, ",", ","),
                'earningCash' => number_format($earningCash, 0, ",", ","),
                'earningQris' => number_format($earningQris, 0, ",", ","),
                'earningBank' => number_format($earningBank, 0, ",", ","),
                'minus' => number_format($minus, 0, ",", ",")
            ]);
        }else {
            $time = now()->format('Y-m-d');
            $data = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->whereDate('transactions.created_at', $time)->select('transactions.*')->get();
            $carbonDate = Carbon::parse($time);
            $humanTime = $carbonDate->format('d F Y');
            $revenue = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->whereDate('transactions.created_at', $time)->where('payment_id', '!=', null)->sum('pay_amount');
            $earningCash = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->whereDate('transactions.created_at', $time)->where('payment_id', 1)->sum('pay_amount');
            $earningQris = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->whereDate('transactions.created_at', $time)->where('payment_id', 2)->sum('pay_amount');
            $earningBank = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->whereDate('transactions.created_at', $time)->where('payment_id', 3)->sum('pay_amount');
            $minus = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', Auth::user()->user_detail->outlet_detail_id)
            ->whereDate('transactions.created_at', $time)->where('payment_id', null)->sum('pay_amount');
            return view('kasir.laporan.rekap_harian', [
                'data' => $data, 
                'human_time' => $humanTime,
                'revenue' => number_format($revenue, 0, ",", ","),
                'earningCash' => number_format($earningCash, 0, ",", ","),
                'earningQris' => number_format($earningQris, 0, ",", ","),
                'earningBank' => number_format($earningBank, 0, ",", ","),
                'minus' => number_format($minus, 0, ",", ",")
            ]);
        }
    }

    public function rekap_admin(Request $request) {
        // ada req date 
        if($request->date) {
            $time = $request->date;
            $carbonDate = Carbon::parse($time);
            $humanTime = $carbonDate->format('d F Y');
            $transaction = Transaction::join('user_details', 'user_details.user_id', 'transactions.user_id')
                ->whereDate('transactions.created_at', $time)
                ->select(['transactions.*'])
                ->get();
            $transaction_detail = Transaction::join('transaction_details', 'transactions.id', 'transaction_details.transaction_id')
                ->join('produks', 'transaction_details.product_id', 'produks.id')
                ->join('user_details', 'user_details.user_id', 'transactions.user_id')
                ->whereDate('transactions.created_at', $time)
                ->select(['transaction_details.*', 'produks.name as produk_name'])
                ->get();
            $revenue = Transaction::join('user_details', 'user_details.user_id', 'transactions.user_id')
                ->whereDate('transactions.created_at', $time)
                ->where('payment_id', '!=', null)
                ->sum('pay_amount');
            $earningCash = Transaction::join('user_details', 'user_details.user_id', 'transactions.user_id')
                ->whereDate('transactions.created_at', $time)
                ->where('payment_id', 1)
                ->sum('pay_amount');
            $earningQris = Transaction::join('user_details', 'user_details.user_id', 'transactions.user_id')
                ->whereDate('transactions.created_at', $time)
                ->where('payment_id', 2)
                ->sum('pay_amount');
            $earningBank = Transaction::join('user_details', 'user_details.user_id', 'transactions.user_id')
                ->whereDate('transactions.created_at', $time)
                ->where('payment_id', 3)
                ->sum('pay_amount');
            $minus = Transaction::join('user_details', 'user_details.user_id', 'transactions.user_id')
                ->whereDate('transactions.created_at', $time)
                ->where('payment_id', null)
                ->sum('pay_amount');
            echo json_encode([
                'transactions' => $transaction, 
                'transaction_details' => $transaction_detail,
                'human_time' => $humanTime,
                'revenue' => number_format($revenue, 0, ",", ","),
                'earningCash' => number_format($earningCash, 0, ",", ","),
                'earningQris' => number_format($earningQris, 0, ",", ","),
                'earningBank' => number_format($earningBank, 0, ",", ","),
                'minus' => number_format($minus, 0, ",", ",")
            ]);
        } else {
            $time = now()->format('Y-m-d');
            $data = Transaction::join('user_details', 'user_details.user_id', 'transactions.user_id')
                ->whereDate('transactions.created_at', $time)
                ->select('transactions.*')
                ->get();
            $carbonDate = Carbon::parse($time);
            $humanTime = $carbonDate->format('d F Y');
            $revenue = Transaction::join('user_details', 'user_details.user_id', 'transactions.user_id')
                ->whereDate('transactions.created_at', $time)
                ->where('payment_id', '!=', null)
                ->sum('pay_amount');
            $earningCash = Transaction::join('user_details', 'user_details.user_id', 'transactions.user_id')
                ->whereDate('transactions.created_at', $time)
                ->where('payment_id', 1)
                ->sum('pay_amount');
            $earningQris = Transaction::join('user_details', 'user_details.user_id', 'transactions.user_id')
                ->whereDate('transactions.created_at', $time)
                ->where('payment_id', 2)
                ->sum('pay_amount');
            $earningBank = Transaction::join('user_details', 'user_details.user_id', 'transactions.user_id')
                ->whereDate('transactions.created_at', $time)
                ->where('payment_id', 3)
                ->sum('pay_amount');
            $minus = Transaction::join('user_details', 'user_details.user_id', 'transactions.user_id')
                ->whereDate('transactions.created_at', $time)
                ->where('payment_id', null)
                ->sum('pay_amount');
            return view('kasir.laporan.rekap_harian', [
                'data' => $data, 
                'human_time' => $humanTime,
                'revenue' => number_format($revenue, 0, ",", ","),
                'earningCash' => number_format($earningCash, 0, ",", ","),
                'earningQris' => number_format($earningQris, 0, ",", ","),
                'earningBank' => number_format($earningBank, 0, ",", ","),
                'minus' => number_format($minus, 0, ",", ",")
            ]);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}