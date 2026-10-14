<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $menus = collect([
            ['Nasi Goreng', 'makanan', 12000, 20],
            ['Mie Ayam', 'makanan', 10000, 15],
            ['Es Teh', 'minuman', 3000, 4],
            ['Jus Jeruk', 'minuman', 6000, 0],
            ['Gorengan', 'makanan', 2000, 30],
        ])->map(fn ($m) => Menu::create([
            'name' => $m[0], 'category' => $m[1], 'price' => $m[2], 'stock' => $m[3],
        ]));

        foreach (range(1, 10) as $i) {
            $trx = Transaction::create([
                'invoice_code'   => Transaction::generateInvoiceCode(),
                'buyer_name'     => 'Siswa ' . $i,
                'total'          => 0,
                'payment_method' => fake()->randomElement(['cash', 'digital']),
                'status'         => fake()->randomElement(['paid', 'paid', 'paid', 'pending']),
            ]);

            $total = 0;
            foreach ($menus->random(rand(1, 3)) as $menu) {
                $qty = rand(1, 3);
                $subtotal = $menu->price * $qty;
                $total += $subtotal;

                $trx->items()->create([
                    'menu_id'   => $menu->id,
                    'menu_name' => $menu->name,
                    'price'     => $menu->price,
                    'quantity'  => $qty,
                    'subtotal'  => $subtotal,
                ]);
            }

            $trx->update([
                'total'   => $total,
                'paid_at' => $trx->status === 'paid' ? now() : null,
            ]);
        }
    }
}