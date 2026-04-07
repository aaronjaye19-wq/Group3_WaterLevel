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
        Schema::create('water_records', function (Blueprint $table) {
            $table->id();
            $table->float('depth'); // Water depth in millimeters
            $table->float('temperature')->nullable(); // Temperature in celsius
            $table->float('humidity')->nullable(); // Humidity percentage
            $table->float('pressure')->nullable(); // Barometric pressure
            $table->float('battery')->nullable(); // Battery voltage
            $table->timestamp('recorded_at')->useCurrent(); // When the reading was taken
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_records');
    }
};
