<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id('orderID');
            $table->decimal('price', 10, 2)->nullable(); 
            $table->date('orderDate'); 
            $table->time('orderTime'); 
            $table->decimal('quoteMin',10,2)->nulllable();
            $table->decimal('quoteMax',10,2)->nulllable();
            $table->enum('status',['pending','quoted','scheduled','price updated','paid','delivered','completed','cancelled','declined']);
            $table->text('serviceDescription');
            $table->string('sessionID');
            $table->unsignedBigInteger('locationID');
            $table->unsignedBigInteger('serviceProviderID');
            $table->foreignId('id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->foreign('locationID')->references('locationID')->on('locations');
            $table->foreign('serviceProviderID')->references('serviceProviderID')->on('service_providers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
