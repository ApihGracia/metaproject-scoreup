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
            $table->id('RulesID');
            $table->string('SportID');
            $table->string('Rules_title');
            $table->string('Category');
            $table->string('Gender');
            $table->string('PDF');
            $table->text('Description');
            $table->string('Profile_picture');

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
