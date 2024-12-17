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
        Schema::create('tour_days', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('day_name');
            $table->foreignId('tour_id')->constrained('tours');
            $table->text('description');
            $table->foreignId('tenant_id');
            $table->string('image')->nullable();
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_days');
    }
};
