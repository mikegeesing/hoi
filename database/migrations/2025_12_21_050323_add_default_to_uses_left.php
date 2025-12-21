<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, set any existing NULL values to 1
        DB::statement('UPDATE restore_tokens SET uses_left = 1 WHERE uses_left IS NULL');
        
        // Then alter the column to have a default value
        Schema::table('restore_tokens', function (Blueprint $table) {
            $table->unsignedSmallInteger('uses_left')->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restore_tokens', function (Blueprint $table) {
            $table->unsignedSmallInteger('uses_left')->default(null)->change();
        });
    }
};
