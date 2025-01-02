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
        Schema::create('player_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // References users table
            $table->foreignId('level_id')->constrained()->onDelete('cascade'); // References levels table
            $table->integer('score')->default(0); // Player's score
            $table->boolean('completed')->default(false); // If the game is completed
            $table->integer('time_taken')->nullable(); // Time taken to complete the level
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_progress');
    }
};
