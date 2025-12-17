<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create onlineho user if it doesn't exist
        User::firstOrCreate(
            ['name' => 'onlineho'],
            [
                'email' => 'onlineho@localhost',
                'password' => Hash::make(bin2hex(random_bytes(32))), // Random password they won't use
                'role' => 'user',
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::where('name', 'onlineho')->delete();
    }
};
