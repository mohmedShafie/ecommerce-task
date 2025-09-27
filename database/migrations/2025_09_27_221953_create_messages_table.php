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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id')->nullable()->constrained('chats');
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->foreignId('shop_id')->nullable()->constrained('shops');
            $table->foreignId('delivery_man_id')->nullable()->constrained('delivery_men');
            $table->foreignId('order_id')->nullable()->constrained('orders');
            $table->text('message')->nullable();
            $table->string('type')->nullable()->comment('send, receive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
