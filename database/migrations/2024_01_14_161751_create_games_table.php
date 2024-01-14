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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('member_1_id')->default(0);
            // $table->foreign('member_1_id')->references('id')->on('members');
            $table->integer('member_2_id')->default(0);
            // $table->foreign('member_2_id')->references('id')->on('members');
            $table->integer('member_3_id')->nullable();
            // $table->foreign('member_3_id')->references('id')->on('members');
            $table->integer('member_4_id')->nullable();
            // $table->foreign('member_4_id')->references('id')->on('members');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
