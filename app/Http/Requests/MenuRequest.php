<?php

namespace App\Http\Requests;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // sesuaikan dengan role (admin/penjual) bila sudah ada
    }

    protected function prepareForValidation(): void
    {
        // Checkbox yang tidak dicentang tidak dikirim browser
        $this->merge(['is_tersedia' => $this->boolean('is_tersedia')]);
    }

public function rules(): array
{
    return [
        'category_id' => ['required', 'exists:categories,id'],
        'nama'        => ['required', 'string', 'max:255'],
        'deskripsi'   => ['nullable', 'string'],
        'harga'       => ['required', 'integer', 'min:0'],
        'stok'        => ['required', 'integer', 'min:0'],
        'min_stock'   => ['nullable', 'integer', 'min:0'],
        'gambar'      => ['nullable', 'image', 'max:2048'],
        'is_tersedia' => ['boolean'],
    ];
}   

    public function attributes(): array
    {
        return [
            'nama' => 'nama menu',
            'deskripsi' => 'deskripsi',
            'harga' => 'harga',
            'stok' => 'stok harian',
            'gambar' => 'gambar',
        ];
    }
}