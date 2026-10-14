<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('top_ups', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();              // contoh: TU-20261013-AB12CD
            $table->foreignId('wallet_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();       // pembeli
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete(); // admin/kasir
            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('balance_before')->default(0);
            $table->unsignedBigInteger('balance_after')->default(0);
            $table->enum('method', ['cash', 'digital'])->default('cash');
            $table->enum('status', ['pending', 'success', 'failed'])->default('success');
            $table->string('note')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'created_at']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('top_ups');
    }
};