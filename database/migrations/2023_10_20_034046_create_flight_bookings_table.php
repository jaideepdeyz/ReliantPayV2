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
            $table->string('departure_country')->nullable();
            $table->string('departure_location')->nullable();
            $table->datetime('departure_date')->nullable();
            $table->string('destination_country')->nullable();
            $table->string('destination_location')->nullable();
            $table->string('oneway_or_roundtrip')->nullable();
            $table->datetime('return_date')->nullable();
            $table->datetime('departure_eta_date')->nullable();
            $table->datetime('return_eta_date')->nullable();
            $table->string('no_days_hotel_car')->nullable();
            $table->string('transport_number')->nullable();
            $table->string('travel_class')->nullable();
            $table->longText('comments')->nullable();
            $table->timestamps();
            $table->softDeletes();
             // $table->string('departure_hour')->nullable();
            // $table->string('departure_minute')->nullable();
            // $table->string('return_hour')->nullable();
            // $table->string('return_minute')->nullable();
            // $table->string('departure_eta_hour')->nullable();
            // $table->string('departure_eta_minute')->nullable();
            // $table->string('return_eta_hour')->nullable();
            // $table->string('return_eta_minute')->nullable();
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
