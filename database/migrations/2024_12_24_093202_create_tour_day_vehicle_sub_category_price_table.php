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
        Schema::create('tour_day_vehicle_sub_category_price', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('tour_day_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_sub_category_price_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_day_vehicle_sub_category_price');
    }
};
