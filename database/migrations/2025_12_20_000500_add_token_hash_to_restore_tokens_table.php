<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restore_tokens', function (Blueprint $table) {
            if (!Schema::hasColumn('restore_tokens', 'token_hash')) {
                $table->string('token_hash', 64)->nullable()->after('token');
                $table->unique('token_hash', 'restore_tokens_token_hash_unique');
            }
        });

        // Backfill token_hash with existing token values where missing
        if (Schema::hasColumn('restore_tokens', 'token_hash') && Schema::hasColumn('restore_tokens', 'token')) {
            DB::table('restore_tokens')
                ->whereNull('token_hash')
                ->update(['token_hash' => DB::raw('token')]);
        }
    }

    public function down(): void
    {
        Schema::table('restore_tokens', function (Blueprint $table) {
            if (Schema::hasColumn('restore_tokens', 'token_hash')) {
                $table->dropUnique('restore_tokens_token_hash_unique');
                $table->dropColumn('token_hash');
            }
        });
    }
};
