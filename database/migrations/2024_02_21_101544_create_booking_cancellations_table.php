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
        Schema::create('booking_cancellations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('app_id')->constrained('sale_bookings');
            $table->string('agent_id')->nullable();
            $table->string('organization_id')->nullable();
            $table->string('remarks')->nullable();
            $table->string('cancellation_charges')->nullable();
            $table->string('refund_amount')->nullable();
            $table->string('cancellation_receipt')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_cancellations');
    }
};
