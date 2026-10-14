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
            'nama'        => ['required', 'string', 'max:100'],
            'kategori'    => ['required', Rule::in(array_keys(Menu::KATEGORI))],
            'deskripsi'   => ['nullable', 'string', 'max:500'],
            'harga'       => ['required', 'integer', 'min:0'],
            'stok'        => ['required', 'integer', 'min:0'],
            'gambar'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
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