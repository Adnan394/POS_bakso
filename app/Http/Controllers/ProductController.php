<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Produk::all();
        return view('superadmin.data-master.products.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superadmin.data-master.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $path = 'gambar_stock'; // Nama folder di dalam direktori public_html

        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();

        // Upload the file to the public_html/uploads directory
        $file->move($path, $fileName);

        Produk::create([
            'name' => $request->name,
            'price' => $request->price,
            'status_stock' => $request->status_stock,
            'image' => $path . '/' . $fileName,
        ]);

        return redirect()->route('products.index')->with('success', 'Data Product berhasil ditambahkan.');
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
        $data = Produk::where('id', $id)->first();
        return view('superadmin.data-master.products.index',['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $path = 'gambar_stock'; // Nama folder di dalam direktori public_html

        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();

        // Upload the file to the public_html/uploads directory
        $file->move($path, $fileName);

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'status_stock' => $request->status_stock,
            'image' => $path . '/' . $fileName,
        ];

        Produk::where('id', $id)->update($data);

        return redirect()->route('products.index')->with('success', 'Data Product berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Produk::where('id', $id)->delete();
        return redirect()->route('products.index');

    }
}
