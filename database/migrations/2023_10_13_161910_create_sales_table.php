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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('agent_id')->nullable();
            $table->string('travel_category')->nullable();
            $table->string('primary_passenger_phone')->nullable();
            $table->string('primary_passenger_email')->nullable();
            $table->string('transport_name')->nullable();
            $table->string('confirmation_number')->nullable();
            $table->string('departure_location')->nullable();
            $table->date('departure_date')->nullable();
            $table->string('destination_location')->nullable();
            $table->string('oneway_or_roundtrip')->nullable();
            $table->date('return_date')->nullable();
            $table->string('no_days_hotel_car')->nullable();
            $table->string('signed_authorization_doc')->nullable();
            $table->string('primary_passenger_id_doc')->nullable();
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
            $table->longText('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
