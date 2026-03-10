<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('inventory.index', compact('products'));
    }

    public function create()
    {
        return view('inventory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string'
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // --- TAMBAHAN: Method Edit ---
    public function edit(Product $product)
    {
        return view('inventory.edit', compact('product'));
    }

    // --- TAMBAHAN: Method Update ---
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Perhatikan: Abaikan unique rule untuk ID produk yang sedang diedit
            'sku' => 'required|string|unique:products,sku,' . $product->id, 
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string'
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Data produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}