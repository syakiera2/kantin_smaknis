<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Mengubah kolom role menjadi string biasa agar tidak dibatasi enum rigid
            $table->string('role', 20)->default('siswa')->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'siswa', 'guru', 'penjual'])->change();
        });
    }
};