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
        Schema::create('grenade_votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('grenade_id');
            $table->foreign('grenade_id')->references('id')->on('grenades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grenade_votes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['grenade_id']);
        });
        Schema::dropIfExists('grenade_votes');
    }
};