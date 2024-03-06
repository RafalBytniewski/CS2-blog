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
        Schema::create('grenade_images', function (Blueprint $table) {
            $table->id();
            $table->string('path', 155);
            $table->timestamps();
        });
        Schema::table('grenade_images', function (Blueprint $table) {
            $table->unsignedBigInteger('grenade_id')->after('id');
            $table->foreign('grenade_id')->references('id')->on('grenades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grenade_images', function (Blueprint $table) {
            $table->dropForeign('grenade_images_grenade_id_foreign');
            $table->dropColumn('grenade_id');
        });
        Schema::dropIfExists('grenade_images');
    }
};
