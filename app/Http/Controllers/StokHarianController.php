<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Outlet;
use App\Models\Stok_harian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StokHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.stok_harian', [
            'data' => Stok_harian::where('location_id', Auth::user()->location_id)->get(),
            'locations' => Location::all()
        ]);
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
        Stok_harian::create([
            'bakso_polos' => $request->bakso_polos,
            'bakso_urat' => $request->bakso_urat,
            'bakso_daging' => $request->bakso_daging,
            'location_id' => $request->location_id
        ]);

        return redirect()->back()->with('success', 'Data Stok Berhasil Di Tambah');
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
        Stok_harian::where('id', $id)->delete();
        return redirect()->back();
    }
}