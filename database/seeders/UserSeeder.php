<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menggunakan updateOrCreate agar aman dari duplikat
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Kunci pencarian unik
            [
                'name' => 'Ibu Budi',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Jika ingin menambah data penjual atau pembeli dummy lainnya:
        User::updateOrCreate(
            ['email' => 'penjual@gmail.com'],
            [
                'name' => 'Pak Jono',
                'password' => Hash::make('password123'),
                'role' => 'penjual',
                'email_verified_at' => now(),
            ]
        );
    }
}