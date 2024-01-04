<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Table;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Transaction_detail;
use GuzzleHttp\Handler\Proxy;
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

    public function berjalan()
    {
        $transaksi = Transaction::where('payment_id', null)->get();
        return view('kasir.transaksi.berjalan', ['transaksi' => $transaksi]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = Table::all();
        $products = Produk::all();
        return view('kasir.transaksi.baru', ['products' => $products, 'tables' => $tables]);
    }
    


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        // $price_amount = collect($request->products)->sum(function($item) {
        //     return $item['price'] * $item['qty'];
        // });
        // $pay_amount = $price_amount - $request->discount;

            $transaction = Transaction::create([
                'payment_id' => ($request->payment_id) ? $request->payment_id : null,
                'table_id' => $request->table_id,
                'price_amount' => $request->price_amount,
                'payment_image' => ($request->payment_image) ? $request->payment_image : null,
                'discount' => ($request->discount) ? $request->discount : null,
                'pay_amount' => 100,
                'user_id' => Auth::user()->id,
                'name_customer' => $request->name_customer
            ]);

            foreach($request->produk as $index => $product) {
                $qty = $request->qty[$index];
            
                Transaction_detail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product,
                    'price' => Produk::where('id', $product)->first()->price,
                    'qty' => $qty,
                    'status' => "Diproses"
                ]);
            }
            
            return redirect()->route('transaksi.berjalan')->with('success', 'Data Transaksi berhasil ditambahkan.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $data = Transaction::where('transactions.id', $id)
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->select(['transactions.*', 'transaction_details.*'])
            ->get();

        return view('kasir.transaksi.detail', ['products' => $data, 'data' => Transaction::where('id', $id)->first()]);
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tables = Table::all();
        $products = Produk::all();
        return view('kasir.transaksi.edit', ['data' => Transaction::where('id', $id)->first(), 'products' => $products, 'tables' => $tables]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}