<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'quantity' => 'sometimes|required|integer|min:0',
            'price' => 'sometimes|required|numeric|min:0',
            'user_id' => 'sometimes|required|exists:users,id',
            'category_id' => 'sometimes|required|exists:kategoris,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama product wajib diisi',
            'name.string' => 'Nama product harus berupa teks',
            'name.max' => 'Nama product maksimal 255 karakter',
            'quantity.required' => 'Jumlah product wajib diisi',
            'quantity.integer' => 'Jumlah product harus angka bulat',
            'quantity.min' => 'Jumlah product minimal 0',
            'price.required' => 'Harga product wajib diisi',
            'price.numeric' => 'Harga product harus berupa angka',
            'price.min' => 'Harga product minimal 0',
            'user_id.required' => 'Owner wajib dipilih',
            'user_id.exists' => 'Owner tidak ditemukan',
            'category_id.required' => 'Kategori wajib dipilih',
            'category_id.exists' => 'Kategori tidak ditemukan',
        ];
    }
}
