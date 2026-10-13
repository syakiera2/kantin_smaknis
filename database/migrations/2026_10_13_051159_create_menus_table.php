<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            // Penjual/mitra pemilik menu (opsional, diisi otomatis dari user yang login)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('nama', 100);
            $table->string('kategori', 20)->index();      // makanan | minuman | snack
            $table->text('deskripsi')->nullable();
            $table->unsignedInteger('harga');             // simpan dalam rupiah (tanpa desimal)
            $table->unsignedInteger('stok')->default(0);  // stok harian
            $table->string('gambar')->nullable();         // path di storage/app/public
            $table->boolean('is_tersedia')->default(true);
            $table->timestamps();
            $table->softDeletes();                        // riwayat transaksi tetap aman saat menu dihapus
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};