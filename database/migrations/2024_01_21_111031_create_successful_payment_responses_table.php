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
        Schema::create('successful_payment_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_booking_id')->constrained('sale_bookings');
            $table->string('order-id')->nullable();
            $table->string('result')->nullable();
            $table->string('result-code')->nullable();
            $table->string('result-text')->nullable();
            $table->string('authorization-code')->nullable();
            $table->string('transaction-id')->nullable();
            $table->string('amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('successful_payment_responses');
    }
};
