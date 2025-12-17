<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('restore_tokens', function (Blueprint $table) {
            if (!Schema::hasColumn('restore_tokens', 'token_encrypted')) {
                $table->text('token_encrypted')->nullable()->after('token');
            }
        });
    }

    public function down(): void
    {
        Schema::table('restore_tokens', function (Blueprint $table) {
            if (Schema::hasColumn('restore_tokens', 'token_encrypted')) {
                $table->dropColumn('token_encrypted');
            }
        });
    }
};
