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
        Schema::table('grenades', function (Blueprint $table) {
            $table->unsignedBigInteger('area_from_id')->after('map_id');
            $table->unsignedBigInteger('area_to_id')->after('area_from_id');

            $table->foreign('area_from_id')->references('id')->on('areas');
            $table->foreign('area_to_id')->references('id')->on('areas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grenades', function (Blueprint $table) {
            //
        });
    }
};