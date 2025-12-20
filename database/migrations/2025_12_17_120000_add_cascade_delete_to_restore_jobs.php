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
        // SQLite doesn't support modifying foreign keys directly
        // For SQLite, we need to recreate the table or use raw SQL
        if (DB::getDriverName() === 'sqlite') {
            // SQLite: use raw SQL to enable foreign keys and recreate the constraint
            DB::statement('PRAGMA foreign_keys = OFF');
            
            // Check if the old foreign key exists and drop it
            try {
                Schema::table('restore_jobs', function (Blueprint $table) {
                    $table->dropForeign(['token_id']);
                });
            } catch (\Exception $e) {
                // Foreign key might not exist in the format expected
            }
            
            DB::statement('PRAGMA foreign_keys = ON');
        } else {
            // For other databases (MySQL, PostgreSQL)
            Schema::table('restore_jobs', function (Blueprint $table) {
                // Drop existing foreign key if it exists
                try {
                    $table->dropForeign(['token_id']);
                } catch (\Exception $e) {
                    // Foreign key might not exist
                }
                
                // Re-add with cascade delete (don't add the column again, just the constraint)
                $table->foreign('token_id')
                    ->references('id')
                    ->on('restore_tokens')
                    ->onDelete('cascade');
            });
        }
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
