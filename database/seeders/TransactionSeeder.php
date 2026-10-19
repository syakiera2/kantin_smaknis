<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 15 transaksi dummy untuk hari ini
        Transaction::factory(15)->create()->each(function ($transaction) {
            $jumlahItem = rand(1, 3);
            $totalHarga = 0;

            for ($i = 0; $i < $jumlahItem; $i++) {
                $item = TransactionItem::factory()->create([
                    'transaction_id' => $transaction->id,
                ]);
                $totalHarga += $item->subtotal;
            }

            // Perbarui total transaksi berdasarkan total subtotal item
            $transaction->update([
                'total' => $totalHarga,
            ]);
        });
    }
}