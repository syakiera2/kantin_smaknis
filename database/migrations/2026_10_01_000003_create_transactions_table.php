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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->string('invoice_code')->unique();
        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // pembeli
        $table->string('buyer_name')->default('Pembeli');
        $table->unsignedInteger('total');
        $table->enum('payment_method', ['cash', 'digital']);
        $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
        $table->timestamp('paid_at')->nullable();
        $table->timestamps();

        $table->index('created_at');
        $table->index('status');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
