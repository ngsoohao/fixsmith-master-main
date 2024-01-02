<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bankaccount', function (Blueprint $table) {
            $table->id('bankAccountID');
            $table->string('bankName');
            $table->string('accountHolderName');
            $table->string('accountNumber');
            $table->timestamps();
            $table->foreignId('id')->constrained('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('bankaccount')->delete();
        Schema::dropIfExists('bankaccount');
    }
};
