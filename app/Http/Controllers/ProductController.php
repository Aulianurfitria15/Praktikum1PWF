<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use App\Http\Requests\UpdateProductRequest; // Import UpdateProductRequest
use App\Http\Requests\StoreProductRequest; // Import StoreProductRequest

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('product.index', compact('products'));
    }

    public function store(StoreProductRequest $request) // Ganti Request jadi StoreProductRequest
    {
        // Validasi otomatis berjalan di sini. 
        // Jika gagal, Laravel langsung balik ke halaman sebelumnya dengan error.
        $validated = $request->validated();
        $validated['user_id'] = $request->user_id; // Mengambil user_id dari dropdown form

        try {
            Product::create($validated);
            return redirect()->route('product.index')->with('success', 'Produk berhasil ditambah.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan data.');
        }
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validasi otomatis dari UpdateProductRequest
        $validated = $request->validated();

        try {
            $product->update($validated);

            return redirect()->route('product.index')
                ->with('success', 'Produk berhasil diupdate.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal mengupdate data.');
        }
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        $categories = Kategori::orderBy('name')->get();

        return view('product.create', compact('users', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product.view', compact('product'));
    }


    public function edit(Product $product)
    {
        $users = User::orderBy('name')->get();
        $categories = Kategori::orderBy('name')->get();

        return view('product.edit', compact('product', 'users', 'categories'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        
        // Cek izin via Policy
        Gate::authorize('delete', $product);

        $product->delete();
        return redirect()->route('product.index')->with('success', 'Berhasil dihapus');
    }
}