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
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::table('areas', function (Blueprint $table) {
            $table->unsignedBigInteger('map_id')->after('id');
            $table->foreign('map_id')->references('id')->on('maps');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('areas', function (Blueprint $table) {
            $table->dropForeign('areas_map_id_foreign');
            $table->dropColumn('map_id');
        });
        Schema::dropIfExists('areas');
    }
};
