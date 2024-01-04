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
        Schema::create('insurances', function (Blueprint $table) {
            $table->id('insuranceID');
            $table->enum('status', ['pending','active', 'expired','claimed']);
            $table->unsignedBigInteger('orderID');
            $table->float('paidAmount');
            $table->date('startDate');
            $table->date('expiredDate');
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('serviceProviderID');

            $table->timestamps();
    
            // Cascade on delete
            $table->foreign('orderID')->references('orderID')->on('order')->cascadeOnDelete();
            $table->foreign('id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('serviceProviderID')->references('serviceProviderID')->on('service_providers')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};
