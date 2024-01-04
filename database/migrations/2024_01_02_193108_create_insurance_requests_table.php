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
        Schema::create('insurance_requests', function (Blueprint $table) {
            $table->id('insuranceRequestID');
            $table->string('title');
            $table->text('description');
            $table->date('serviceDate')->nullable(); 
            $table->time('serviceTime')->nullable(); 
            $table->enum('status',['requested','accepted','declined','pending reschedule','completed']);
            $table->text('declineReason')->nullable();
            $table->unsignedBigInteger('insuranceID');
            $table->string('serviceProof')->nullable();
            $table->timestamps();

            $table->foreign('insuranceID')->references('insuranceID')->on('insurances')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_requests');
    }
};
