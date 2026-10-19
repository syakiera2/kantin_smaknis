<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah sudah ada user dengan role penjual / user biasa, 
        // jika belum, buatkan 1 user dummy sebagai pemilik menu
        $user = User::first() ?? User::factory()->create([
            'name'  => 'Penjual Kantin',
            'email' => 'penjual@kantin.com',
        ]);

        // Buat 15 data dummy menu yang terhubung ke user tersebut
        Menu::factory()->count(15)->create([
            'user_id' => $user->id,
        ]);
    }
}