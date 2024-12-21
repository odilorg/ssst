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
        Schema::create('air_rail_tour_day', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_day_id')->constrained()->onDelete('cascade');
            $table->foreignId('air_rail_id')->constrained()->onDelete('cascade');
            $table->string('ticket_number')->nullable();
            $table->timestamp('departure_time_override')->nullable();
            $table->timestamp('arrival_time_override')->nullable();
            $table->string('seat_number')->nullable();
            $table->enum('reservation_status', ['reserved', 'pending', 'canceled'])->default('pending');
            $table->text('special_requests')->nullable();
            $table->integer('cost')->nullable();
            $table->integer('discount')->nullable();
           
            $table->integer('total_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('air_rail_tour_day');
    }
};
