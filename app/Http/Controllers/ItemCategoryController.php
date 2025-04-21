<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ItemCategory::all();
        return view('admin.item_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('item_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('item_categories', 'public');
        }

        ItemCategory::create($data);

        return redirect()->route('item-categories.index')->with('success', 'Kategori berhasil ditambahkan');
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
        $itemCategory = ItemCategory::where('id',$id)->first();
        return view('item_categories.edit', compact('itemCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $itemCategory = ItemCategory::where('id',$id)->first();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($itemCategory->image) {
                Storage::disk('public')->delete($itemCategory->image);
            }
            $data['image'] = $request->file('image')->store('item_categories', 'public');
        }

        $itemCategory->update($data);

        return redirect()->route('item-categories.index')->with('success', 'Kategori berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $itemCategory = ItemCategory::where('id',$id)->first();

        if ($itemCategory->image) {
            Storage::disk('public')->delete($itemCategory->image);
        }

        $itemCategory->delete();
        return redirect()->route('item-categories.index')->with('success', 'Kategori berhasil dihapus');
    }
}
