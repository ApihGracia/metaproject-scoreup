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
        Schema::create('sport_technicians', function (Blueprint $table) {
            $table->id('tech_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('sport_id')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Inactive');
            $table->string('phone_number')->nullable();
            $table->string('profile_picture')->nullable();
            $table->text('bio')->nullable();
            $table->date('joined_date')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('sport_id')->references('id')->on('sports')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_technicians');
    }
};
