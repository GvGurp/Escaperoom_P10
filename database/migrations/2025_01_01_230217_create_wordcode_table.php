<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// (Gaby) Migration for the wordcode table

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wordcode', function (Blueprint $table) {
            $table->id();
            $table->string('word');       // The word to guess
            $table->string('hint1');      // First hint (free)
            $table->string('hint2');      // Second hint (costs points)
            $table->timestamps();         // Laravel's created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wordcode');
    }
};


