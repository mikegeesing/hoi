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
        Schema::table('restore_jobs', function (Blueprint $table) {
            // Drop the old foreign key
            $table->dropForeign(['token_id']);
        });

        Schema::table('restore_jobs', function (Blueprint $table) {
            // Re-add with cascade delete
            $table->foreignId('token_id')
                ->constrained('restore_tokens')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restore_jobs', function (Blueprint $table) {
            $table->dropForeign(['token_id']);
        });

        Schema::table('restore_jobs', function (Blueprint $table) {
            $table->foreignId('token_id')->constrained('restore_tokens');
        });
    }
};
