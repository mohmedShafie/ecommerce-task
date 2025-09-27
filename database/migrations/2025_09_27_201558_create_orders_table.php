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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->foreignId('company_id')->nullable()->constrained('companies');
            $table->foreignId('offer_id')->nullable()->constrained('offers');
            $table->string('payment_status')->nullable();
            $table->string('delivery_status')->nullable();
            $table->string('status')->nullable();
            $table->string('delivery_type')->nullable();
            $table->foreignId('delivery_man_id')->nullable()->constrained('delivery_men');
            $table->string('delivery_address')->nullable();
            $table->string('delivery_phone')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamp('processing_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
