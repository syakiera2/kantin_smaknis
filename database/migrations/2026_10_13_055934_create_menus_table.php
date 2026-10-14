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
    Schema::create('menus', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->enum('category', ['makanan', 'minuman', 'snack'])->default('makanan');
        $table->unsignedInteger('price');
        $table->unsignedInteger('stock')->default(0);
        $table->unsignedInteger('min_stock')->default(5); // batas "menipis"
        $table->boolean('is_available')->default(true);
        $table->timestamps();
        $table->softDeletes();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
