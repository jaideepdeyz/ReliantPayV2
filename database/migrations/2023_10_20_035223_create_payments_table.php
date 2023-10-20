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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('app_id')->constrained('sale_bookings');
            $table->string('cc_name')->nullable();
            $table->string('cc_phone')->nullable();
            $table->string('cc_email')->nullable();
            $table->string('cc_dob')->nullable();
            $table->string('cc_number')->nullable();
            $table->string('cc_type')->nullable();
            $table->string('cc_expiration_date')->nullable();
            $table->string('cc_cvc')->nullable();
            $table->longText('cc_billing_address')->nullable();
            $table->string('amount_charged')->nullable();
            $table->longText('comments')->nullable();
            $table->string('primary_passenger_id_doc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
