<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataProducts'] = Products::all();
        return view('products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
		    'name'  => 'required|max:10',
		]);

        // dd($request->all());
        $data['name'] = $request->name;
        $data['price']  = $request->price;
        $data['description']   = $request->description;

        Products::create($data);

        return redirect()->route('products.index')->with('success', 'Penambahan Data Berhasil!');

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
        $data['dataProducts'] = Products::findOrFail($id);
        return view('products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = $id;
        $products = Products::findOrFail($id);

        $products->name = $request->name;
        $products->price  = $request->price;
        $products->description   = $request->description;

        $products->save();
        return redirect()->route('products.index')->with('berhasil', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $products = Products::findOrFail($id);
        $products->delete();
        return redirect()->route('products.index')->with('hapus', 'Hapus Data Berhasil!');
    }
}
