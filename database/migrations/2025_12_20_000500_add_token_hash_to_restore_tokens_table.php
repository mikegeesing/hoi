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
            }
        });

        // Voeg unieke index toe als die nog niet bestaat (SQLite tolerant)
        if (! $this->indexExists('restore_tokens', 'restore_tokens_token_hash_unique')) {
            Schema::table('restore_tokens', function (Blueprint $table) {
                $table->unique('token_hash', 'restore_tokens_token_hash_unique');
            });
        }

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
                if ($this->indexExists('restore_tokens', 'restore_tokens_token_hash_unique')) {
                    $table->dropUnique('restore_tokens_token_hash_unique');
                }
                $table->dropColumn('token_hash');
            }
        });
    }

    private function indexExists(string $table, string $index): bool
    {
        $connection = Schema::getConnection();

        // SQLite: use PRAGMA index_list
        if ($connection->getDriverName() === 'sqlite') {
            $pdo = $connection->getPdo();
            $stmt = $pdo->query("PRAGMA index_list('".$table."')");
            if (!$stmt) return false;
            $indexes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($indexes as $idx) {
                if (isset($idx['name']) && $idx['name'] === $index) {
                    return true;
                }
            }
            return false;
        }

        // Fallback for other drivers using Doctrine if available
        if (method_exists($connection, 'getDoctrineSchemaManager')) {
            $schema = $connection->getDoctrineSchemaManager();
            $indexes = $schema->listTableIndexes($table);
            return array_key_exists($index, $indexes);
        }

        return false;
    }
};
