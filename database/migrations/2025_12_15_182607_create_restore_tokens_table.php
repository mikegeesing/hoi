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
        Schema::create('restore_tokens', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
*/

 public function up(): void
{
    Schema::create('restore_tokens', function (Blueprint $table) {
        $table->id();
        $table->string('token_hash', 64)->unique(); // SHA-256 hash van de token
        $table->string('borg_user', 32); // De onlineh gebruiker
        $table->unsignedSmallInteger('total_uses')->default(1);
        $table->unsignedSmallInteger('uses_left');
        $table->timestamp('expires_at')->nullable();
        $table->timestamps(); // created_at en updated_at
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restore_tokens');
    }
};
