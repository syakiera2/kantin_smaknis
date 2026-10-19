<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 25; $i++) {
            $user = User::create([
                'name' => "Guru $i, S.Pd.",
                'email' => "guru$i@school.com",
                'password' => Hash::make('password'),
                'role' => 'guru',
                'saldo' => 500000,
            ]);

            DB::table('guru')->insert([
                'user_id' => $user->id,
                'kode_pegawai' => 'KG' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nip_nik' => '19800101' . rand(100000, 999999) . '00' . $i,
                'jabatan' => ['Guru Mata Pelajaran', 'Wali Kelas', 'Pembina OSIS'][rand(0, 2)],
                'nomor_telepon' => '0812' . rand(10000000, 99999999),
                'jenis_kelamin' => $i % 2 == 0 ? 'Perempuan' : 'Laki-laki',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}