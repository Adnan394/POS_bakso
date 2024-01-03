<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Transaction_detail;
use Illuminate\Http\Request;
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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Produk::all();
        return view('kasir.transaksi.baru', ['products' => $products]);
    }
    
    public function selesai()
    {
        return view('kasir.transaksi.selesai');

    }
    public function detail()
    {
        return view('kasir.transaksi.detail');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $price_amount = collect($request->products)->sum(function($item) {
        //     return $item['price'] * $item['qty'];
        // });
        // $pay_amount = $price_amount - $request->discount;

        try {
            $file = $request->file('payment_image');
            $path = 'transactions/';
            $filename = $path . $file->getClientOriginalName();
            $file->move($path, $filename);

            $transaction = Transaction::create([
                'payment_id' => ($request->payment_id) ? $request->payment_id : null,
                'table_id' => $request->table_id,
                'price_amount' => $request->price_amount,
                'payment_image' => ($request->payment_image) ? $request->payment_image : null,
                'discount' => ($request->discount) ? $request->discount : null,
                'pay_amount' => $request->pay_amount,
                'user_id' => Auth::user()->id,
                'name_customer' => $request->name_customer
            ]);

            foreach($request->products as $product) {
                Transaction_detail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product['id'],
                    'price' => $product['price'],
                    'qty' => $product['qty'],
                    'status' => "Diproses"
                ]);
            }
        }catch(\Throwable $th) {
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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