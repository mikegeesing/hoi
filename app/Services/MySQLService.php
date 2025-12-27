<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class MySQLService
{
    private string $runner = '/usr/local/bin/borg-runner.sh';
    private string $apiUrl = 'http://127.0.0.1:9876';

    /**
     * Execute a command via HTTP API proxy
     */
    private function executeCommand(string $command, array $args = [], array $options = []): array
    {
        $timeout = $options['timeout'] ?? 120;
        $cwd = $options['cwd'] ?? null;
        $input = $options['input'] ?? null;
        $env = $options['env'] ?? [];

        $response = Http::timeout($timeout + 5)->post($this->apiUrl, [
            'command' => $command,
            'args' => $args,
            'timeout' => $timeout,
            'cwd' => $cwd,
            'input' => $input,
            'env' => $env,
        ]);

        if (!$response->successful()) {
            throw new \RuntimeException('API proxy request failed: ' . $response->body());
        }

        $result = $response->json();

        if (!$result['success']) {
            $error = trim($result['stderr'] ?? $result['stdout'] ?? 'Unknown error');
            throw new \RuntimeException($error ?: 'Command failed');
        }

        return $result;
    }

    /**
     * List SQL files from an archive, optionally filtered by username
     */
    public function listSqlFiles(string $archive, ?string $filterByUsername = null): array
    {
        if (!file_exists($this->runner)) {
            throw new \RuntimeException("Borg runner script not found at: {$this->runner}");
        }

        $args = [$archive, 'home/sql_dumps'];
        $result = $this->executeCommand('list-files', $args, ['timeout' => 120]);

        $output = trim($result['stdout']);

        Log::debug('Borg list-files raw output', [
            'archive' => $archive,
            'output_lines' => count(explode("\n", $output)),
            'first_lines' => implode(" | ", array_slice(explode("\n", $output), 0, 3)),
        ]);

        $files = [];
        $seen = [];

        if (empty($output)) {
            return [];
        }

        foreach (explode("\n", $output) as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            if (preg_match('/\bhome\/\S+\.sql\b/', $line, $matches)) {
                $fullPath = $matches[0];
                $filename = basename($fullPath);

                Log::debug('Extracted SQL file from borg list', [
                    'raw_line' => $line,
                    'extracted_path' => $fullPath,
                    'filename' => $filename,
                ]);

                if (isset($seen[$fullPath])) {
                    continue;
                }
                $seen[$fullPath] = true;

                if ($filterByUsername && !$this->isFileForUser($filename, $filterByUsername)) {
                    continue;
                }

                $files[] = $fullPath;
            }
        }

        return $files;
    }

    private function isFileForUser(string $filename, string $username): bool
    {
        $nameWithoutExt = preg_replace('/\.sql$/', '', $filename);

        if (str_contains($nameWithoutExt, $username)) {
            return true;
        }

        if (str_starts_with($nameWithoutExt, $username . '_')) {
            return true;
        }

        return false;
    }

    /**
     * Extract content of a specific SQL file from archive
     */
    public function extractSqlFile(string $archive, string $filename): string
    {
        $filename = str_replace(['../', '..\\'], '', $filename);

        if (!str_ends_with($filename, '.sql')) {
            $filename .= '.sql';
        }

        $userTmpDir = getenv('HOME') ?: '/home/onlineh';
        $tempDir = $userTmpDir . '/tmp/borg_extract_' . uniqid();

        if (!file_exists($userTmpDir . '/tmp')) {
            mkdir($userTmpDir . '/tmp', 0755, true);
        }

        mkdir($tempDir, 0755, true);

        try {
            $pathsToTry = [
                $filename,
                '/' . ltrim($filename, '/'),
                ltrim($filename, '/'),
            ];

            $pathsToTry = array_unique($pathsToTry);

            $extractSuccess = false;
            $lastError = '';

            foreach ($pathsToTry as $pathVariant) {
                // Try extract-for-user
                try {
                    Log::debug('Attempting SQL extraction via extract-for-user', [
                        'archive' => $archive,
                        'path_variant' => $pathVariant,
                        'temp_dir' => $tempDir,
                    ]);

                    $args = [$archive, 'onlineh', $pathVariant];
                    $this->executeCommand('extract-for-user', $args, [
                        'timeout' => 300,
                        'cwd' => $tempDir,
                    ]);

                    $extractSuccess = true;
                    Log::info('SQL extraction succeeded via extract-for-user', [
                        'archive' => $archive,
                        'working_path' => $pathVariant,
                    ]);
                    break;
                } catch (\Exception $e) {
                    $lastError = $e->getMessage();
                    Log::debug('Path variant failed (extract-for-user)', [
                        'path' => $pathVariant,
                        'error' => $lastError,
                    ]);
                }

                if ($extractSuccess) {
                    break;
                }

                // Try BorgService
                try {
                    $borgService = app(\App\Services\BorgService::class);
                    Log::debug('Attempting SQL extraction via BorgService', [
                        'archive' => $archive,
                        'path_variant' => $pathVariant,
                        'temp_dir' => $tempDir,
                    ]);

                    $borgService->extractFiles($archive, [$pathVariant], $tempDir);

                    $extractSuccess = true;
                    Log::info('SQL extraction succeeded via BorgService', [
                        'archive' => $archive,
                        'working_path' => $pathVariant,
                    ]);
                    break;
                } catch (\Exception $e) {
                    $lastError = $e->getMessage();
                    Log::debug('Path variant failed (BorgService)', [
                        'path' => $pathVariant,
                        'error' => $lastError,
                    ]);
                }

                // Try extract-multi
                try {
                    $args = [$archive, $pathVariant];
                    Log::debug('Attempting SQL extraction (extract-multi)', [
                        'archive' => $archive,
                        'path_variant' => $pathVariant,
                        'cwd' => $tempDir,
                    ]);

                    $this->executeCommand('extract-multi', $args, [
                        'timeout' => 300,
                        'cwd' => $tempDir,
                    ]);

                    $extractSuccess = true;
                    Log::info('SQL extraction succeeded (extract-multi)', [
                        'archive' => $archive,
                        'working_path' => $pathVariant,
                    ]);
                    break;
                } catch (\Exception $e) {
                    $lastError = $e->getMessage();
                    Log::debug('Path variant failed (extract-multi)', [
                        'path' => $pathVariant,
                        'error' => $lastError,
                    ]);
                }

                // Try BorgWrapperService
                try {
                    $wrapper = app(\App\Services\BorgWrapperService::class);
                    Log::debug('Attempting SQL extraction via BorgWrapperService', [
                        'archive' => $archive,
                        'path_variant' => $pathVariant,
                        'temp_dir' => $tempDir,
                    ]);

                    $wrapper->extractFiles($archive, [$pathVariant], $tempDir);

                    $extractSuccess = true;
                    Log::info('SQL extraction succeeded via BorgWrapperService', [
                        'archive' => $archive,
                        'working_path' => $pathVariant,
                    ]);
                    break;
                } catch (\Exception $e) {
                    $lastError = $e->getMessage();
                    Log::debug('Path variant failed via BorgWrapperService', [
                        'path' => $pathVariant,
                        'error' => $lastError,
                    ]);
                }
            }

            if (!$extractSuccess) {
                $errorMessage = "Failed to extract SQL file: $filename from archive: $archive";
                $errorMessage .= " - Tried paths: " . implode(', ', $pathsToTry);
                $errorMessage .= " - Last error: $lastError";
                throw new \RuntimeException($errorMessage);
            }

            $extractedPath = $tempDir . '/' . ltrim($filename, '/');

            if (!file_exists($extractedPath)) {
                $iterator = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($tempDir, \RecursiveDirectoryIterator::SKIP_DOTS)
                );

                foreach ($iterator as $file) {
                    if ($file->isFile() && str_ends_with($file->getPathname(), '.sql')) {
                        $extractedPath = $file->getPathname();
                        Log::info('Found SQL file in temp dir', [
                            'expected_path' => $tempDir . '/' . ltrim($filename, '/'),
                            'actual_path' => $extractedPath,
                        ]);
                        break;
                    }
                }

                if (!file_exists($extractedPath)) {
                    throw new \RuntimeException("Extracted file not found. Expected: $extractedPath, Temp dir: $tempDir");
                }
            }

            $content = file_get_contents($extractedPath);

            if ($content === false) {
                throw new \RuntimeException("Failed to read extracted file: $extractedPath");
            }

            Log::info('SQL file extracted successfully', [
                'archive' => $archive,
                'filename' => $filename,
                'size' => strlen($content),
            ]);

            return $content;

        } finally {
            if (file_exists($tempDir)) {
                $this->removeDirectory($tempDir);
            }
        }
    }

    private function removeDirectory(string $dir): void
    {
        if (!is_dir($dir)) {
            return;
        }

        $items = @scandir($dir);
        if ($items === false) {
            return;
        }

        foreach ($items as $item) {
            if ($item === '.' || $item === '..') continue;

            $path = $dir . '/' . $item;

            if (is_dir($path) && !is_link($path)) {
                $this->removeDirectory($path);
            } else {
                @unlink($path);
            }
        }

        @rmdir($dir);
    }

    public function extractTableNames(string $sqlContent): array
    {
        $tables = [];

        if (preg_match_all('/CREATE\s+TABLE\s+(?:IF\s+NOT\s+EXISTS\s+)?`?(\w+)`?/i', $sqlContent, $matches)) {
            $tables = array_unique($matches[1]);
        }

        return $tables;
    }

    public function filterSqlByTables(string $sqlContent, array $tables): string
    {
        if (empty($tables)) {
            return $sqlContent;
        }

        $tablePattern = implode('|', array_map('preg_quote', $tables));

        $lines = explode("\n", $sqlContent);
        $filtered = [];
        $inTable = false;
        $currentTable = null;

        foreach ($lines as $line) {
            if (preg_match('/CREATE\s+TABLE\s+(?:IF\s+NOT\s+EXISTS\s+)?`?(' . $tablePattern . ')`?/i', $line, $m)) {
                $inTable = true;
                $currentTable = $m[1];
                $filtered[] = $line;
            }
            elseif ($inTable && (str_starts_with(trim($line), 'CREATE') || str_starts_with(trim($line), 'DROP'))) {
                $inTable = false;
                if (str_starts_with(trim($line), 'DROP')) {
                    continue;
                }
                if (preg_match('/CREATE\s+TABLE\s+(?:IF\s+NOT\s+EXISTS\s+)?`?(' . $tablePattern . ')`?/i', $line, $m)) {
                    $inTable = true;
                    $currentTable = $m[1];
                    $filtered[] = $line;
                }
            }
            elseif (preg_match('/^(LOCK|UNLOCK|SET|\/\*|--|#)/', trim($line))) {
                $filtered[] = $line;
            }
            elseif ($inTable) {
                $filtered[] = $line;
            }
        }

        return implode("\n", $filtered);
    }

    public function restoreDatabase(string $database, string $sqlContent): bool
    {
        $tmpFile = tempnam(sys_get_temp_dir(), 'restore_');
        file_put_contents($tmpFile, $sqlContent);

        try {
            $mysqlPaths = [
                '/usr/local/bin/mysql',
                '/usr/local/mysql/bin/mysql',
                '/usr/local/mariadb/bin/mysql',
                '/usr/bin/mariadb',
                '/usr/bin/mysql',
                'mysql',
            ];

            $mysqlBinary = null;
            foreach ($mysqlPaths as $path) {
                if ($path === 'mysql' || file_exists($path)) {
                    $mysqlBinary = $path;
                    break;
                }
            }

            if (!$mysqlBinary) {
                throw new \RuntimeException('MySQL binary not found in common locations');
            }

            $baseArgs = [$mysqlBinary];

            $username = env('MYSQL_RESTORE_USER') ?: false;
            $password = env('MYSQL_RESTORE_PASSWORD') ?: false;
            $socket = env('MYSQL_RESTORE_SOCKET') ?: false;
            $host = env('MYSQL_RESTORE_HOST') ?: false;

            Log::debug('MySQL restore credentials priority check', [
                'has_restore_user' => !empty($username),
                'restore_user' => $username ? substr($username, 0, 5) . '***' : 'not-set',
            ]);

            if (!$username) {
                $daConfigFile = '/usr/local/directadmin/conf/mysql.conf';
                if (file_exists($daConfigFile) && is_readable($daConfigFile)) {
                    $daConfig = parse_ini_file($daConfigFile);
                    $username = $daConfig['user'] ?? null;
                    $password = $daConfig['passwd'] ?? null;
                    $host = $daConfig['host'] ?? null;
                    $socket = $daConfig['socket'] ?? null;
                }
            }

            if (!$username) {
                $username = config('database.connections.mysql.username');
                $password = config('database.connections.mysql.password');
                $host = config('database.connections.mysql.host', 'localhost');
            }

            if ($username) {
                $baseArgs[] = '-u' . $username;
            }

            if ($password) {
                $baseArgs[] = '-p' . $password;
            }

            if ($socket) {
                $baseArgs[] = '--socket=' . $socket;
            } elseif ($host && $host !== '' && $host !== 'localhost') {
                $baseArgs[] = '-h' . $host;
            }

            // Drop & recreate database
            $prepSql = sprintf('DROP DATABASE IF EXISTS `%s`; CREATE DATABASE `%s`;', $database, $database);
            $prepArgs = array_merge($baseArgs, ['-e', $prepSql]);
            
            $result = $this->executeCommand('mysql', $prepArgs, ['timeout' => 120]);
            
            if (!$result['success']) {
                $error = trim($result['stderr'] ?? $result['stdout'] ?? 'Unknown error');
                throw new \RuntimeException('MySQL prepare (drop/create) failed: ' . $error);
            }

            // Restore dump
            $restoreArgs = array_merge($baseArgs, [$database]);
            
            $result = $this->executeCommand('mysql', $restoreArgs, [
                'timeout' => 3600,
                'input' => $sqlContent,
            ]);

            if (!$result['success']) {
                $error = trim($result['stderr'] ?? $result['stdout'] ?? 'Unknown error');
                throw new \RuntimeException('MySQL restore failed: ' . $error);
            }

            return true;
        } finally {
            @unlink($tmpFile);
        }
    }

    public function extractDatabaseNameFromSQL(string $sqlContent): ?string
    {
        if (preg_match('/CREATE DATABASE\s+`?([^`\s;]+)`?/i', $sqlContent, $matches)) {
            return $matches[1];
        }

        if (preg_match('/USE\s+`?([^`\s;]+)`?/i', $sqlContent, $matches)) {
            return $matches[1];
        }

        return null;
    }

    public function extractDatabaseNameFromFilename(string $filename): ?string
    {
        $baseName = basename($filename);
        $dbName = preg_replace('/\.sql$/', '', $baseName);

        if (!empty($dbName) && $dbName !== $filename) {
            return $dbName;
        }

        return null;
    }
}
