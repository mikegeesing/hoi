<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('restore_tokens', function (Blueprint $table) {
            // oude kolommen verwijderen
            if (Schema::hasColumn('restore_tokens', 'token_hash')) {
                $table->dropColumn('token_hash');
            }
            if (Schema::hasColumn('restore_tokens', 'total_uses')) {
                $table->dropColumn('total_uses');
            }
            if (Schema::hasColumn('restore_tokens', 'uses_left')) {
                $table->dropColumn('uses_left');
            }
        });
    }

    public function down(): void
    {
        Schema::table('restore_tokens', function (Blueprint $table) {
            // rollback = oude structuur terug (optioneel)
            $table->string('token_hash')->nullable();
            $table->unsignedInteger('total_uses')->nullable();
            $table->unsignedInteger('uses_left')->nullable();
        });
    }
};
