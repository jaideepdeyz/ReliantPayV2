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
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('name')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('woeid')->nullable();
            $table->string('tz')->nullable();
            $table->string('phone')->nullable();
            $table->string('type')->nullable();
            $table->string('email')->nullable();
            $table->string('url')->nullable();
            $table->string('runway_length')->nullable();
            $table->string('elev')->nullable();
            $table->string('icao')->nullable();
            $table->string('direct_flights')->nullable();
            $table->string('carriers')->nullable();
            $table->string('ident')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};
