<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restore_tokens', function (Blueprint $table) {
            $table->timestamp('last_used_at')->nullable()->after('used');
        });
    }

    public function down(): void
    {
        Schema::table('restore_tokens', function (Blueprint $table) {
            $table->dropColumn('last_used_at');
        });
    }
};
