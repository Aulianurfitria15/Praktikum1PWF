<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Kategori::all();

            return response()->json([
                'message' => 'Kategori berhasil diambil',
                'data' => $categories
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data kategori', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Gagal mengambil data kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_kategori' => 'required|string|max:255',
            ]);

            $category = Kategori::create($validated);

            Log::info('Menambah data kategori', [
                'list' => $category
            ]);

            return response()->json([
                'message' => 'Kategori berhasil ditambahkan',
                'data' => $category,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Error saat menambah kategori', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Error saat menambah kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $category = Kategori::find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Kategori tidak ditemukan',
                ], 404);
            }

            return response()->json([
                'message' => 'Kategori retrieved successfully',
                'data' => $category
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data kategori', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Gagal mengambil data kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try {
            $category = Kategori::find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Kategori tidak ditemukan',
                ], 404);
            }

            $validated = $request->validate([
                'nama_kategori' => 'required|string|max:255',
            ]);

            $category->update($validated);

            Log::info('Update data kategori', [
                'list' => $category
            ]);

            return response()->json([
                'message' => 'Kategori berhasil diupdate',
                'data' => $category,
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat update kategori', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Error saat update kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $category = Kategori::find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Kategori tidak ditemukan',
                ], 404);
            }

            $category->delete();

            Log::info('Delete data kategori', [
                'list' => $category
            ]);

            return response()->json([
                'message' => 'Kategori berhasil dihapus',
                'data' => $category,
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat delete kategori', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Error saat delete kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
