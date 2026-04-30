<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Kategori::withCount('products')->get();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Kategori::class);
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();
        
        try {
            Kategori::create($validated);
            return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambah.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan kategori.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        $products = $kategori->products()->get();
        return view('category.show', compact('kategori', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        Gate::authorize('update', $kategori);
        return view('category.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        Gate::authorize('update', $kategori);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:kategoris,name,' . $kategori->id,
        ]);

        try {
            $kategori->update($validated);
            return redirect()->route('category.index')->with('success', 'Kategori berhasil diupdate.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal mengupdate kategori.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        Gate::authorize('delete', $kategori);
        
        try {
            $kategori->delete();
            return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus kategori.');
        }
    }
}
