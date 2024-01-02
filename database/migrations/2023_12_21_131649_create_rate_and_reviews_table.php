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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('reviewID');
            $table->text('reviewText');
            $table->float('rating');
            $table->foreignId('id')->constrained('users')->cascadeOnDelete();
            $table->unsignedBigInteger('serviceProviderID');
            $table->unsignedBigInteger('orderID');
            

            $table->timestamps();

            $table->foreign('serviceProviderID')->references('serviceProviderID')->on('service_providers');
            $table->foreign('orderID')->references('orderID')->on('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
