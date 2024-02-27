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
        Schema::create('grenades', function (Blueprint $table) {
            $table->id();
            $table->string('describtion', 255);
            $table->string('image_path', 1000);
            $table->enum('type',['smoke', 'flash', 'hegrenade', 'molotov']);
            $table->enum('team',['t', 'ct']);
            $table->timestamps(); 
        });

        Schema::table('grenades', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('map_id')->after('user_id');
            $table->foreign('map_id')->references('id')->on('maps');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grenades', function (Blueprint $table) {
            $table->dropForeign('grenades_user_id_foreign');
            $table->dropColumn('user_id');
        });
        Schema::table('grenades', function (Blueprint $table) {
            $table->dropForeign('grenades_map_id_foreign');
            $table->dropColumn('map_id'); 
        });
        Schema::dropIfExists('grenades');
    }
};
