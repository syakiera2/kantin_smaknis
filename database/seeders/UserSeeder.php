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
        // 1. Akun Admin (Pengelola Sistem Kantin)
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Ibu Budi (Admin)',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // 2. Akun Penjual / Tenant (Pemilik Stand Kantin)
        User::updateOrCreate(
            ['email' => 'penjual@gmail.com'],
            [
                'name' => 'Pak Jono (Penjual)',
                'password' => Hash::make('password123'),
                'role' => 'penjual',
                'email_verified_at' => now(),
            ]
        );

        // 3. Akun Pembeli / Siswa (Konsumen Kantin)
        User::updateOrCreate(
            ['email' => 'pembeli@gmail.com'],
            [
                'name' => 'Andi (Siswa)',
                'password' => Hash::make('password123'),
                'role' => 'pembeli',
                'email_verified_at' => now(),
            ]
        );
    }
}