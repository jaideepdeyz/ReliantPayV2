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
        Schema::create('affiliate_merchant_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('affiliate_id')->constrained('users');
            $table->string('merchant_name');
            $table->string('merchant_email');
            $table->longText('merchant_code');
            $table->string('user_id')->nullable(); // to check if the merchant has signed up or not
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_merchant_codes');
    }
};
