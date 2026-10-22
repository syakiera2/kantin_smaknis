<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menupromos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id');
            $table->decimal('harga_promo');
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai');
            $table->foreignId('dibuat_oleh');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menupromos');
    }
};
