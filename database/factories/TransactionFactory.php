<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'invoice_code'   => 'INV-' . now()->format('Ymd') . '-' . fake()->unique()->numerify('###'),
            'buyer_name'     => fake()->name(),
            'total'          => 0,
            'payment_method' => fake()->randomElement(['cash', 'digital']),
            'status'         => fake()->randomElement(['paid', 'paid', 'paid', 'pending']),
            'created_at'     => fake()->dateTimeBetween('today', 'now'),
            'updated_at'     => now(),
        ];
    }
}