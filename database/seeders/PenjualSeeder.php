<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PenjualSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 25; $i++) {
            $user = User::create([
                'name' => "Pemilik Stand $i",
                'email' => "penjual$i@school.com",
                'password' => Hash::make('password'),
                'role' => 'penjual',
                'saldo' => 250000,
            ]);

            DB::table('penjual')->insert([
                'user_id' => $user->id,
                'kode_penjual' => 'KP' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama_stand' => 'Kantin Sehat ' . $i,
                'nomor_stand' => 'A-' . $i,
                'kategori_penjualan' => ['Makanan Berat', 'Minuman & Jus', 'Snack & Jajanan'][rand(0, 2)],
                'nomor_telepon' => '0821' . rand(10000000, 99999999),
                'nama_bank' => ['BCA', 'BRI', 'Mandiri', 'BNI'][rand(0, 3)],
                'nomor_rekening' => rand(1000000000, 9999999999),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}