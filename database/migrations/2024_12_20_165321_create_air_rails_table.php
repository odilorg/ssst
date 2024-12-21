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
        Schema::create('air_rails', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['plane', 'train']);
            $table->string('name');
            $table->string('departure_location');
            $table->string('arrival_location');
            $table->timestamp('departure_time');
            $table->timestamp('arrival_time')->nullable();
            $table->integer('price');
            $table->string('seat_class')->nullable();
           
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('air_rails');
    }
};
