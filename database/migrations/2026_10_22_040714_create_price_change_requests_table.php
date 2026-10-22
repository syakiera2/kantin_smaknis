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
        Schema::create('price_change_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id');
            $table->required('harga_lama');
            $table->dataTime('harga_diajukan');
            $table->foreignId('diajukan_oleh');
            $table->enum('status',['menunggu','disetujui','ditolak']);
            $table->foreignId('disetujui_oleh');
            $table->required('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_change_requests');
    }
};
