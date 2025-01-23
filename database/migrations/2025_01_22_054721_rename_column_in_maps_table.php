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
        Schema::table('maps', function (Blueprint $table) {
            $table->string('description')->nullable(); // Dodaj nową kolumnę
        });
    
        // Przepisz dane ze starej kolumny na nową
        DB::statement('UPDATE maps SET description = describtion');
    
        Schema::table('maps', function (Blueprint $table) {
            $table->dropColumn('describtion'); // Usuń starą kolumnę
        });
    }
    
    public function down(): void
    {
        Schema::table('maps', function (Blueprint $table) {
            $table->string('describtion')->nullable(); // Przywróć starą kolumnę
        });
    
        // Przywróć dane z nowej kolumny na starą
        DB::statement('UPDATE maps SET describtion = description');
    
        Schema::table('maps', function (Blueprint $table) {
            $table->dropColumn('description'); // Usuń nową kolumnę
        });
    }
    
};
