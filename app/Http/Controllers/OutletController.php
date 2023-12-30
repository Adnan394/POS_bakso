<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\Location;
use Illuminate\Support\Facades\Hash;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();
        $data = Outlet::all();
        return view('superadmin.data-master.outlets.index', ['data' => $data , 'locations' => $locations]);
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
        Outlet::create([
            'name' => $request->name,
            'location_id' => $request->location_id,
        ]);

        return redirect()->route('outlets.index')->with('success', 'Outlet berhasil ditambahkan.');
        
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
        $data = Outlet::where('id', $id)->first();
        return view('superadmin.data-master.outlets.index',['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'name' => $request->name,
            'location_id' => $request->location_id,
        ];

        Outlet::where('id', $id)->update($data);

        return redirect()->route('outlet.index')->with('success', 'Outlet berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Outlet::where('id', $id)->delete();
        return redirect()->route('outlets.index')->with('success', 'Outlet berhasil dihapus.');
    }
}
