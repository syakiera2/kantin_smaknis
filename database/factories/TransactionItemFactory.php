<?php

namespace Database\Factories;

use App\Models\TransactionItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionItemFactory extends Factory
{
    protected $model = TransactionItem::class;

    public function definition(): array
    {
        $harga = fake()->numberBetween(5000, 20000);
        $quantity = fake()->numberBetween(1, 3);

        return [
            'menu_name' => fake()->randomElement([
                'Nasi Goreng Spesial', 'Mie Ayam Baso', 'Nasi Uduk Komplit', 
                'Es Teh Manis', 'Es Jeruk Peras', 'Pisang Goreng Keju', 'Roti Bakar Coklat'
            ]),
            'quantity'  => $quantity,
            'price'     => $harga,
            'subtotal'  => $harga * $quantity,
        ];
    }
}