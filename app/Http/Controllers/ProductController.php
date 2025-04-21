<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $itemcategories = ItemCategory::all();
        return view('products.create', compact('itemcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:item_categories,id',
            'description' => 'required|string',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'required|image|max:2048'
        ]);

        $data['image'] = $request->file('image')->store('products', 'public');

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('itemCategory')->where('id', $id)->first();
        $itemcategory = $product->itemCategory;

        return view('products.show', compact('product', 'itemcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::where('id', $id)->first();

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:item_categories,id',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $product = Product::where('id', $id)->first();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::where('id', $id)->first();

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }



    // ADMIN
    public function getProducts(Request $request){
        $query = Product::query();

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->get();
        return view('admin.products.index', compact('products'));
    }
}
