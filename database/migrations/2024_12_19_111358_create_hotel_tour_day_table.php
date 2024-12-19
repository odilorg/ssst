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
        Schema::create('hotel_tour_day', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
            $table->foreignId('tour_day_id')->constrained()->onDelete('cascade');
            $table->integer('amount_paid')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('payment_status')->nullable();
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_tour_day');
    }
};
