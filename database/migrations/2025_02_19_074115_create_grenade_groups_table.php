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
        Schema::create('grenade_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('map_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('visibility');
            $table->timestamps();
        });

        Schema::create('grenade_group_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grenade_group_id')->constrained('grenade_groups')->onDelete('cascade');
            $table->foreignId('grenade_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grenade_group_items');
        Schema::dropIfExists('grenade_groups');
    }
};
