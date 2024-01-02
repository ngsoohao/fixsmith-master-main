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
        Schema::create('favourite_list_contents', function (Blueprint $table) {
            $table->id('favouriteListContentID');
            $table->unsignedBigInteger('favouriteListID');
            $table->unsignedBigInteger('serviceProviderID');

            $table->timestamps();
            $table->foreign('favouriteListID')->references('favouriteListID')->on('favourite_lists')->onDelete('cascade');
            $table->foreign('serviceProviderID')->references('serviceProviderID')->on('service_providers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favourite_list_contents');
    }
};
