<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $baseCategories = [
            'Makanan Berat', 'Minuman', 'Snack', 'Jajanan Pasar', 'Buah Segar', 
            'Kue Basah', 'Kue Kering', 'Roti & Pastry', 'Minuman Dingin', 'Kopi & Teh', 
            'Gorengan', 'Menu Sehat', 'Makanan Instan', 'Cokelat & Permen', 'Sup & Soto'
        ];

        // Looping untuk menghasilkan 100 data kategori unik
        for ($i = 1; $i <= 100; $i++) {
            // Ambil nama dasar secara acak lalu tambahkan nomor urut agar unik
            $randomBase = $baseCategories[array_rand($baseCategories)];
            $name = $randomBase . ' ' . $i;

            Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'description' => 'Kategori pilihan terbaik untuk ' . strtolower($name) . ' di kantin sekolah.',
                ]
            );
        }
    }
}