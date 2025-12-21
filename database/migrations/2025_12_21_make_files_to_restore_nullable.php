<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restore_jobs', function (Blueprint $table) {
            // Make files_to_restore nullable since database restores don't use it
            $table->text('files_to_restore')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('restore_jobs', function (Blueprint $table) {
            $table->text('files_to_restore')->nullable(false)->change();
        });
    }
};
