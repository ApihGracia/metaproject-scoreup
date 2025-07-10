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
        Schema::create('scoreboards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('sport_id');
            $table->integer('gold')->default(0);
            $table->integer('silver')->default(0);
            $table->integer('bronze')->default(0);
            $table->integer('total')->default(0); // Can also be calculated dynamically
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('sport_id')->references('id')->on('sports')->onDelete('cascade');
            
            // $table->id();
            // $table->foreignId('team_id')->constrained('teams')->onDelete('cascade'); 
            // $table->foreignId('sport_id')->constrained('sports')->onDelete('cascade'); 
            // $table->unsignedInteger('gold')->default(0); 
            // $table->unsignedInteger('silver')->default(0); 
            // $table->unsignedInteger('bronze')->default(0); 
            // $table->unsignedInteger('total')->default(0); // Can also be calculated dynamically 
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scoreboards');
    }
};
