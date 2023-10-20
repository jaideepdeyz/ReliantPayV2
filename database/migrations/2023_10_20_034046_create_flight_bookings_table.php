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
        Schema::create('flight_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('app_id')->constrained('sale_bookings');
            $table->string('airline_name')->nullable();
            $table->string('confirmation_number')->nullable();
            $table->string('departure_location')->nullable();
            $table->date('departure_date')->nullable();
            $table->string('destination_location')->nullable();
            $table->string('oneway_or_roundtrip')->nullable();
            $table->date('return_date')->nullable();
            $table->string('no_days_hotel_car')->nullable();
            $table->longText('comments')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_bookings');
    }
};
