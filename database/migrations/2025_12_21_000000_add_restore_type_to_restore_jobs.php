<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restore_jobs', function (Blueprint $table) {
            // Add restore type column (file, mysql)
            $table->enum('restore_type', ['file', 'mysql'])->default('file')->after('status');
            
            // Add optional database name for mysql restores
            $table->string('database_name')->nullable()->after('restore_path');
        });
    }

    public function down(): void
    {
        Schema::table('restore_jobs', function (Blueprint $table) {
            $table->dropColumn('restore_type');
            $table->dropColumn('database_name');
        });
    }
};
