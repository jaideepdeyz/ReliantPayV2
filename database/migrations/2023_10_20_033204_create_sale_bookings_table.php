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
        Schema::create('sale_bookings', function (Blueprint $table) {
            $table->id()->startingValue(1000000001);
            $table->foreignId('agent_id')->constrained('users');
            $table->string('organization_id');
            $table->foreignId('service_id')->constrained('service_masters');
            $table->string('sale_type')->nullable();
            $table->string('confirmation_number')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_gender')->nullable();
            $table->date('customer_dob')->nullable();
            $table->string('app_status')->nullable();
            $table->string('order_id')->nullable();
            $table->string('amount_charged')->nullable();
            $table->string('relationship_to_card_holder')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_bookings');
    }
};
