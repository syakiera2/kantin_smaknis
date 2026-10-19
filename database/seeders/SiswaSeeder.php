<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            $user = User::create([
                'name' => "Siswa ke-$i",
                'email' => "siswa$i@school.com",
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'saldo' => rand(10000, 100000),
            ]);

            DB::table('siswa')->insert([
                'user_id' => $user->id,
                'kode_siswa' => 'KS' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nisn' => '00' . rand(10000000, 99999999),
                'nis' => '1234' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'kelas' => rand(10, 12) . ' ' . ['IPA', 'IPS', 'TKJ'][rand(0, 2)],
                'jurusan' => ['MIPA', 'IPS', 'Teknik Komputer & Jaringan'][rand(0, 2)],
                'jenis_kelamin' => $i % 2 == 0 ? 'Perempuan' : 'Laki-laki',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}