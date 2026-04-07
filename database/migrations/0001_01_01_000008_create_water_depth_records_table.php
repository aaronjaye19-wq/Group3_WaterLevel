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
        Schema::create('water_depth_records', function (Blueprint $table) {
            $table->id();
            $table->integer('water_level');
            $table->float('temperature')->nullable();
            $table->date('date');
            $table->integer('change_24h')->default(0)->nullable();
            $table->integer('maximum_24h')->default(0)->nullable();
            $table->timestamps();
            
            // Index for faster queries
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_depth_records');
    }
};
