<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $items = [
        ['Nasi Goreng',  'makanan', 12000, 20],
        ['Mie Ayam',     'makanan', 10000, 15],
        ['Batagor',      'snack',    8000, 10],
        ['Es Teh Manis', 'minuman',  4000, 30],
        ['Jus Alpukat',  'minuman', 10000,  4],
        ['Risol Mayo',   'snack',    3000,  0],
    ];

    foreach ($items as [$name, $cat, $price, $stock]) {
        \App\Models\Menu::create([
            'name' => $name, 'category' => $cat, 'price' => $price,
            'stock' => $stock, 'min_stock' => 5, 'is_available' => $stock > 0,
        ]);
    }
}
}
