<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\jurnal_harian;
use Illuminate\Support\Facades\Redirect;


class JurnalHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->date) {
            $time = $request->date;
            $carbonDate = Carbon::parse($time);
            $humanTime = $carbonDate->format('d F Y');
            $data = jurnal_harian::whereDate('created_at', $request->date)->get();
            $jurnal_harian = jurnal_harian::whereDate('created_at', $request->date)->sum('amount');
            echo json_encode([
                'data' => $data,
                'human_time' => $humanTime,
                'jurnal_harian' => number_format($jurnal_harian, 0, ",", ",")
            ]);
        }else {
            $time = now()->format('Y-m-d');
            $carbonDate = Carbon::parse($time);
            $humanTime = $carbonDate->format('d F Y');
            return view('kasir.laporan.jurnal', [
                'active' => 'jurnal_harian',
                'human_time' => $humanTime,
                'data' => jurnal_harian::whereDate('created_at', $time)->get()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
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
