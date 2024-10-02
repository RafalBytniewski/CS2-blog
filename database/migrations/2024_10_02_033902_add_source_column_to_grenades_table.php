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
            $table->enum('source_type',['images', 'youtube_path', 'twitch_path'])->after('visibility');
            $table->string('youtube_path', 255)->nullable()->after('source_type');
            $table->string('twitch_path', 255)->nullable()->after('youtube_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grenades', function (Blueprint $table) {
            $table->dropColumn('source_type');
            $table->dropColumn('youtube_path');
            $table->dropColumn('twitch_clip');
        });
    }
};
