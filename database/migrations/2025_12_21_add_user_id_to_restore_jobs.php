<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restore_jobs', function (Blueprint $table) {
            // Add user_id to track who executed the restore
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->after('token_id');
        });
    }

    public function down(): void
    {
        Schema::table('restore_jobs', function (Blueprint $table) {
            $table->dropForeignKeyIfExists(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
