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
        Schema::create('amtrak_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('app_id')->constrained('sale_bookings');
            $table->string('confirmation_number')->nullable();
            $table->string('departure_location')->nullable();
            $table->date('departure_date')->nullable();
            $table->string('departure_hour')->nullable();
            $table->string('departure_minute')->nullable();
            $table->string('destination_location')->nullable();
            $table->string('oneway_or_roundtrip')->nullable();
            $table->date('return_date')->nullable();
            $table->string('return_hour')->nullable();
            $table->string('return_minute')->nullable();
            $table->date('departure_eta_date')->nullable();
            $table->string('departure_eta_hour')->nullable();
            $table->string('departure_eta_minute')->nullable();
            $table->date('return_eta_date')->nullable();
            $table->string('return_eta_Hour')->nullable();
            $table->string('return_eta_Minute')->nullable();
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
        Schema::dropIfExists('amtrak_bookings');
    }
};
