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
        Schema::create('sporttech', function (Blueprint $table) {
            $table->id('TechID');
            $table->string('SportID')->unique();
            $table->string('Name');
            $table->string('Email');
            $table->string('Password');
            $table->string('Phone Number');
            $table->string('Profile Picture');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sporttech');
    }
};
