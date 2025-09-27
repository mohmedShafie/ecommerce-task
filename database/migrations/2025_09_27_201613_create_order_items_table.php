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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained('orders');
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->foreignId('company_id')->nullable()->constrained('companies');
            $table->foreignId('section_id')->nullable()->constrained('sections');
            $table->foreignId('category_id')->nullable()->constrained('categories');
            $table->foreignId('brand_id')->nullable()->constrained('brands');
            $table->foreignId('offer_id')->nullable()->constrained('offers');
            $table->string('quantity');
            $table->string('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
