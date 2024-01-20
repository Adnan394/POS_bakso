<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Transaction_detail;
use App\Models\User;
use App\Events\OutletNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananOutletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $transaksi = Transaction::where('payment_id', null)->get();
        $user = User::join('user_details', 'users.id', '=', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', '=', 'outlet_details.id')
            ->where('users.id', Auth::user()->id)
            ->select('outlet_details.id')
            ->first();
        $transaksi = Transaction::join('users', 'transactions.user_id', 'users.id')
            ->join('user_details', 'users.id', 'user_details.user_id')
            ->join('outlet_details', 'user_details.outlet_detail_id', 'outlet_details.id')
            ->where('outlet_details.id', $user->id)
            ->select(['transactions.*'])
            ->get();
        return view('outlet.pesanan.index', ['transaksi' => $transaksi]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function testnotif()
    {
        event(new OutletNotification('Latihan Pusher'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        // return $request;

        foreach ($request->produk as $produk) {
            Transaction_detail::where('transaction_id', $id)->where('product_id', $produk)->update(['status' => 'Jadi']);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}