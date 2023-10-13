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
            $table->string('ident')->nullable();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('latitude_deg')->nullable();
            $table->string('longitude_deg')->nullable();
            $table->string('elevation_ft')->nullable();
            $table->string('continent')->nullable();
            $table->string('iso_country')->nullable();
            $table->string('iso_region')->nullable();
            $table->string('municipality')->nullable();
            $table->string('scheduled_service')->nullable();
            $table->string('gps_code')->nullable();
            $table->string('iata_code')->nullable();
            $table->string('local_code')->nullable();
            $table->longText('home_link')->nullable();
            $table->longText('wikipedia_link')->nullable();
            $table->longText('keywords')->nullable();
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
