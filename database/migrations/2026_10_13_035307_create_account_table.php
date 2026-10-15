<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambahkan kolom pendukung ke tabel users yang SUDAH ADA
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'siswa', 'guru', 'penjual'])->default('siswa')->after('email');
            }
            if (!Schema::hasColumn('users', 'saldo')) {
                $table->decimal('saldo', 12, 2)->default(0)->after('role');
            }
            if (!Schema::hasColumn('users', 'foto_profil')) {
                $table->string('foto_profil')->nullable()->after('saldo');
            }
        });

        // 2. Buat Tabel Detail Siswa jika belum ada
        if (!Schema::hasTable('siswa')) {
            Schema::create('siswa', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->string('kode_siswa')->unique();
                $table->string('nisn', 10)->unique();
                $table->string('nis', 20)->unique();
                $table->string('kelas');
                $table->string('jurusan');
                $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
                $table->timestamps();
            });
        }

        // 3. Buat Tabel Detail Guru jika belum ada
        if (!Schema::hasTable('guru')) {
            Schema::create('guru', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->string('kode_pegawai')->unique();
                $table->string('nip_nik', 30)->unique();
                $table->string('jabatan');
                $table->string('nomor_telepon', 20);
                $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
                $table->timestamps();
            });
        }

        // 4. Buat Tabel Detail Penjual jika belum ada
        if (!Schema::hasTable('penjual')) {
            Schema::create('penjual', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->string('kode_penjual')->unique();
                $table->string('nama_stand');
                $table->string('nomor_stand');
                $table->string('kategori_penjualan');
                $table->string('nomor_telepon', 20);
                $table->string('nama_bank')->nullable();
                $table->string('nomor_rekening')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('penjual');
        Schema::dropIfExists('guru');
        Schema::dropIfExists('siswa');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'saldo', 'foto_profil']);
        });
    }
};