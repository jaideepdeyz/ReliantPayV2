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
        Schema::create('authorization_forms', function (Blueprint $table) {
            $table->id();
            $table->string('app_id')->nullable();
            $table->string('unsigned_document')->nullable();
            $table->string('signed_document')->nullable();
            $table->string('envelope_id')->nullable();
            $table->string('account_id')->nullable();
            $table->string('document_id')->nullable();
            $table->longText('ds_access_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authorization_forms');
    }
};
