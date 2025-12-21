<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('sqlite:import {path?} {--tables=*} {--truncate}', function () {
    $path = $this->argument('path') ?: database_path('database.sqlite');
    $tablesOpt = (array) $this->option('tables');
    $truncate = (bool) $this->option('truncate');

    if (!file_exists($path)) {
        $this->error("SQLite file not found: {$path}");
        return 1;
    }

    // Configure a temporary SQLite connection pointing to the provided file
    Config::set('database.connections.sqlite_import', [
        'driver' => 'sqlite',
        'database' => $path,
        'prefix' => '',
        'foreign_key_constraints' => false,
    ]);

    $sqlite = DB::connection('sqlite_import');
    $mysql = DB::connection('mysql');

    // Discover tables in SQLite
    $sqliteTables = collect($sqlite->select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'"))
        ->pluck('name')
        ->all();

    // Default whitelist to avoid importing ephemeral tables
    $defaultTables = [
        'users',
        'restore_tokens',
        'restore_jobs',
        'personal_access_tokens',
        'webauthn_credentials', // Passkeys (Laragear WebAuthn)
    ];

    $tables = !empty($tablesOpt) ? $tablesOpt : $defaultTables;

    // Filter to those that exist in the SQLite file
    $tables = array_values(array_intersect($tables, $sqliteTables));

    if (empty($tables)) {
        $this->warn('No matching tables found to import.');
        return 0;
    }

    $this->info('Starting import from SQLite into MySQL...');

    // Disable FK checks during import
    $mysql->statement('SET FOREIGN_KEY_CHECKS=0');

    foreach ($tables as $table) {
        // Ensure target table exists in MySQL
        if (!Schema::connection('mysql')->hasTable($table)) {
            $this->warn("Skipping {$table}: does not exist in MySQL.");
            continue;
        }

        $count = (int) $sqlite->table($table)->count();
        $this->info("Importing {$table} ({$count} rows)...");

        if ($truncate && $count > 0) {
            $this->warn("Truncating MySQL table {$table} before import...");
            $mysql->table($table)->truncate();
        }

        $chunkSize = 500;
        $inserted = 0;

        // Try to order by id if present for stable chunking
        $columns = collect($sqlite->select("PRAGMA table_info('{$table}')"))
            ->pluck('name')
            ->all();

        $query = $sqlite->table($table);
        if (in_array('id', $columns)) {
            $query = $query->orderBy('id');
        }

        $query->chunk($chunkSize, function ($rows) use ($mysql, $table, &$inserted) {
            // Cast rows to plain arrays
            $payload = [];
            foreach ($rows as $row) {
                $payload[] = (array) $row;
            }

            // Use insertOrIgnore to avoid duplicate conflicts on unique keys
            if (!empty($payload)) {
                $mysql->table($table)->insertOrIgnore($payload);
                $inserted += count($payload);
            }
        });

        // Adjust AUTO_INCREMENT if the table has an id column
        if (in_array('id', $columns)) {
            $maxId = (int) $mysql->table($table)->max('id');
            if ($maxId > 0) {
                $mysql->statement("ALTER TABLE `{$table}` AUTO_INCREMENT = ".($maxId + 1));
            }
        }

        // Special backfill: ensure token_hash is populated (on MySQL side)
        if ($table === 'restore_tokens') {
            $mysql->table('restore_tokens')
                ->whereNull('token_hash')
                ->update(['token_hash' => DB::raw('token')]);
        }

        $this->info("Imported {$inserted} rows into {$table}.");
    }

    // Re-enable FK checks
    $mysql->statement('SET FOREIGN_KEY_CHECKS=1');

    $this->info('SQLite import completed.');
    return 0;
})->purpose('Import data from a SQLite file into the current MySQL database');
