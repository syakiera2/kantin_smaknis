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
    Schema::create('stock_movements', function (Blueprint $table) {
        $table->id();
        $table->foreignId('menu_id')->constrained()->cascadeOnDelete();
        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
        $table->string('type', 20);          // in, out, set, sale
        $table->integer('quantity');         // bertanda: + masuk, - keluar
        $table->unsignedInteger('stock_before');
        $table->unsignedInteger('stock_after');
        $table->string('note')->nullable();
        $table->timestamps();

        $table->index(['menu_id', 'created_at']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
