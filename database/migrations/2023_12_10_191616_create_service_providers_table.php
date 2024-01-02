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
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id('serviceProviderID');
            $table->foreignId('id')->constrained('users')->cascadeOnDelete();
            $table->unsignedBigInteger('serviceTypeID');
            $table->float('averageRating')->nullable();
            $table->foreign('serviceTypeID')->references('serviceTypeID')->on('serviceType');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    Schema::dropIfExists('service_providers');
    }
};
