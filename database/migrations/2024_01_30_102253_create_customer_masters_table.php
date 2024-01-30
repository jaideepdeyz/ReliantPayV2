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
        Schema::create('customer_masters', function (Blueprint $table) {
            $table->id();
            $table->string('customer_email')->unique();
            $table->string('customer_name');
            $table->string('customer_gender')->nullable();
            $table->date('customer_dob')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_masters');
    }
};
