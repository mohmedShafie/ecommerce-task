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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('cascade');
            $table->string('payment_method')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_type')->nullable()->comment('cash, bank, card');
            $table->string('payment_status')->nullable()->comment('pending, paid, failed, refunded');
            $table->string('payment_amount')->nullable();
            $table->string('payment_currency')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
