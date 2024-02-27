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
        Schema::create('callouts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->timestamps();
        });
        Schema::table('callouts', function (Blueprint $table) {
            $table->unsignedBigInteger('area_id')->after('id');
            $table->foreign('area_id')->references('id')->on('areas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('callouts', function (Blueprint $table) {
            $table->dropForeign('callouts_area_id_foreign');
            $table->dropColumn('area_id');
        });
        Schema::dropIfExists('callouts');
    }
};
