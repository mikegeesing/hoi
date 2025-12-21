<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restore_jobs', function (Blueprint $table) {
            // Add optional selected tables for selective MySQL restores
            $table->text('selected_tables')->nullable()->after('database_name');
        });
    }

    public function down(): void
    {
        Schema::table('restore_jobs', function (Blueprint $table) {
            $table->dropColumn('selected_tables');
        });
    }
};
