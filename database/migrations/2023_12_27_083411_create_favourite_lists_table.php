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
        Schema::create('favourite_lists', function (Blueprint $table) {
            $table->id('favouriteListID');
            $table->string('favouriteListName');
            $table->foreignId('id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**\
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favourite_lists');
    }
};
