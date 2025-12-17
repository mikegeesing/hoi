<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     
    public function up(): void
    {
        Schema::create('restore_jobs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
*/

public function up(): void
{
    Schema::create('restore_jobs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('token_id')->constrained('restore_tokens'); // Link naar de gebruikte token
        $table->string('status')->default('pending'); // pending, running, success, failed
        $table->text('files_to_restore'); // JSON array van de geselecteerde bestanden
        $table->string('archive_name'); // De geselecteerde backup (bv. 2025-12-17T02:00:00)
        $table->string('restore_path')->nullable(); // Waar het herstel is geplaatst (bijv. /tmp/restore_...)
        $table->text('log_output')->nullable(); // Output van het borg commando
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restore_jobs');
    }
};
