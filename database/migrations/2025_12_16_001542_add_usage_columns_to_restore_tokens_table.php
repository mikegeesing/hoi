<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('restore_tokens', function (Blueprint $table) {
            $table->unsignedInteger('max_uses')->after('expires_at');
            $table->unsignedInteger('used')->default(0)->after('max_uses');
        });
    }

    public function down(): void
    {
        Schema::table('restore_tokens', function (Blueprint $table) {
            $table->dropColumn(['max_uses', 'used']);
        });
    }
};
