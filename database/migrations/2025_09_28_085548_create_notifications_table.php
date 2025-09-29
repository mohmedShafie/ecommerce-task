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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('notification_type');
            $table->string('title');
            $table->string('message');
            $table->string('recipient_type');
            $table->foreignId('recipient_id')->constrained('admins')->onDelete('cascade');
            $table->json('data');
            $table->string('channel');
            $table->boolean('is_sent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
