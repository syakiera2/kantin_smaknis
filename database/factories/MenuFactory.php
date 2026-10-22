<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    protected $model = Menu::class;

    public function definition(): array
    {
        $kategori = fake()->randomElement(['makanan', 'minuman', 'snack']);

        $nama = match ($kategori) {
            'makanan' => fake()->randomElement(['Nasi Goreng Spesial', 'Mie Ayam Baso', 'Nasi Uduk Komplit', 'Ketoprak Betawi', 'Soto Ayam Kampung']),
            'minuman' => fake()->randomElement(['Es Teh Manis', 'Es Jeruk Peras', 'Es Milo Kepal', 'Jus Alpukat', 'Air Mineral Botol']),
            'snack'   => fake()->randomElement(['Pisang Goreng Keju', 'Roti Bakar Coklat', 'Tahu Crispy', 'Cireng Bumbu Rujak', 'Dimsum Mentai']),
        };

        $harga = match ($kategori) {
            'makanan' => fake()->numberBetween(10000, 25000),
            'minuman' => fake()->numberBetween(3000, 8000),
            'snack'   => fake()->numberBetween(5000, 15000),
        };

        return [
            'user_id'     => User::factory(),
            // cari kategori berdasarkan slug, buat kalau belum ada
            'category_id' => Category::firstOrCreate(
                ['slug' => $kategori],
                ['name' => ucfirst($kategori)]
            )->id,
            'nama'        => $nama . ' ' . fake()->unique()->numerify('##'),
            'deskripsi'   => fake()->sentence(10),
            'harga'       => $harga,
            'stok'        => fake()->numberBetween(5, 50),
            'min_stock'   => 5,
            'gambar'      => null,
            'is_tersedia' => true,
        ];
    }
}