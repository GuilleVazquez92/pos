<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $lastBarcode = Product::selectRaw('MAX(CAST(barcode AS UNSIGNED)) as max_barcode')->value('max_barcode');
        $barcode = $lastBarcode ? $lastBarcode + 1 : 100000;


        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'barcode' => $barcode,
        ]);

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente');
    }


    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Producto actualizado');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado');
    }
}
