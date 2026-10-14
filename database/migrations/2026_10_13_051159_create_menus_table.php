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
            // Relasi ke user/penjual (opsional)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            
            // Kolom data menu (diselaraskan dengan Model)
            $table->string('nama');
            $table->enum('kategori', ['makanan', 'minuman', 'snack'])->default('makanan');
            $table->text('deskripsi')->nullable();
            $table->unsignedInteger('harga');
            $table->unsignedInteger('stok')->default(0);
            $table->unsignedInteger('min_stock')->default(5); // Batas stok menipis
            $table->string('gambar')->nullable();             // Path gambar di storage
            
            $table->boolean('is_tersedia')->default(true); // <-- Diubah menjadi is_tersedia
            
            $table->timestamps();
            $table->softDeletes(); // Untuk riwayat transaksi aman saat menu dihapus
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};