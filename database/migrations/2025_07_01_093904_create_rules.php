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
        Schema::create('rules', function (Blueprint $table) {
            $table->id('RuleID');
            $table->unsignedBigInteger('sport_id'); // Add this line
            $table->string('title')->unique();
            $table->text('description')->nullable();
            $table->string('profile_picture')->nullable(); // stores logo file path
            $table->string('file_path')->nullable(); // stores PDF file path
            $table->timestamps();

            $table->foreign('sport_id')->references('id')->on('sports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};
