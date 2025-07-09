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
        Schema::table('schedules', function (Blueprint $table) {
            $table->string('round')->nullable(); // e.g. "Quarterfinal", "Semifinal", "Final"
            $table->integer('score_a')->nullable();
            $table->integer('score_b')->nullable();
            $table->boolean('is_done')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn(['round', 'score_a', 'score_b', 'is_done']);
        });
    }
};
