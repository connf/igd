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
        Schema::create('member_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId("game_id");
            $table->integer('member_1_score')->nullable();
            $table->integer('member_2_score')->nullable();
            $table->integer('member_3_score')->nullable();
            $table->integer('member_4_score')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_scores');
    }
};
