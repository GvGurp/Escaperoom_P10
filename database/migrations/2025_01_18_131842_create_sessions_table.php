<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        
        Schema::create('sessions', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key
            $table->string('payload');
            $table->integer('last_activity');
            $table->unsignedBigInteger('user_id');
            $table->ipAddress('ip_address');
            $table->text('user_agent'); // Add this column to store the user agent
            $table->timestamps();
        
            // Assuming you have a users table, you can create a foreign key
            $table->foreign('user_id')->references('id')->on('users');
        });
        
        
        
        
    }
    
  
    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
