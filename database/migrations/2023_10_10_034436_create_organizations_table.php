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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('business_name')->nullable();
            $table->longText('business_address')->nullable();
            $table->string('business_website')->nullable();
            $table->string('business_email')->unique();
            $table->string('business_phone')->nullable();
            $table->string('business_PCI_DSS_compliance_status')->nullable();
            $table->string('business_HTTPS_compliance_status')->nullable();
            $table->longText('business_bank_account_name')->nullable();
            $table->longText('business_bank_account_address')->nullable();
            $table->string('business_bank_name')->nullable();
            $table->longText('business_bank_address')->nullable();
            $table->longText('business_bank_IBAN')->nullable();
            $table->string('business_bank_IFSC')->nullable();
            $table->string('business_bank_SWIFT_code')->nullable();
            $table->string('business_bank_routing_code')->nullable();
            $table->string('authorized_persons_name')->nullable();
            $table->string('authorized_persons_email')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
