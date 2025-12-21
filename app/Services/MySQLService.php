<?php

namespace App\Services;

use Symfony\Component\Process\Process;

class MySQLService
{
    private string $runner = '/usr/local/bin/borg-runner.sh';

    /**
     * Extract SQL files from an archive, optionally filtered by username
     * Returns array of full paths from /home/sql_dumps/
     */
    public function listSqlFiles(string $archive, ?string $filterByUsername = null): array
    {
        // Check if runner script exists
        if (!file_exists($this->runner)) {
            throw new \RuntimeException("Borg runner script not found at: {$this->runner}");
        }
        
        $args = [
            'sudo',
            $this->runner,
            'list-files',
            $archive,
            'home/sql_dumps',
        ];

        $process = new Process($args);
        $process->setTimeout(120);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException('Failed to list SQL files: ' . trim($process->getErrorOutput()));
        }

        $output = trim($process->getOutput());
        if (empty($output)) {
            return [];
        }

        // Log the raw output for debugging
        \Illuminate\Support\Facades\Log::debug('Borg list-files raw output', [
            'archive' => $archive,
            'output_lines' => count(explode("\n", $output)),
            'first_lines' => implode(" | ", array_slice(explode("\n", $output), 0, 3)),
        ]);

        $files = [];
        $seen = []; // Track seen files to avoid duplicates
        
        foreach (explode("\n", $output) as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            // Extract path - it's the part that starts with 'home/'
            // Format is: "size day, date time path"
            if (preg_match('/\bhome\/\S+\.sql\b/', $line, $matches)) {
                $fullPath = $matches[0];
                $filename = basename($fullPath);
                
                \Illuminate\Support\Facades\Log::debug('Extracted SQL file from borg list', [
                    'raw_line' => $line,
                    'extracted_path' => $fullPath,
                    'filename' => $filename,
                ]);
                
                // Skip duplicates
                if (isset($seen[$fullPath])) {
                    continue;
                }
                $seen[$fullPath] = true;
                
                // Filter by username if provided
                if ($filterByUsername && !$this->isFileForUser($filename, $filterByUsername)) {
                    continue;
                }
                // Return the full path
                $files[] = $fullPath;
            }
        }

        return $files;
    }

    /**
     * Check if a SQL file is for a specific username
     * Files can match by: username in filename or default pattern
     */
    private function isFileForUser(string $filename, string $username): bool
    {
        // Remove .sql extension
        $nameWithoutExt = preg_replace('/\.sql$/', '', $filename);
        
        // Check if filename contains the username (e.g., "onlineh_wp461.sql" contains "onlineh")
        if (str_contains($nameWithoutExt, $username)) {
            return true;
        }

        // Also check if username prefix matches (e.g., "onlineh_" prefix)
        if (str_starts_with($nameWithoutExt, $username . '_')) {
            return true;
        }

        return false;
    }

    /**
     * Extract content of a specific SQL file from archive
     * $filename should be the full path from listSqlFiles
     */
    public function extractSqlFile(string $archive, string $filename): string
    {
        // Sanitize to prevent path traversal, but preserve the full path
        $filename = str_replace(['../', '..\\'], '', $filename);
        
        // Ensure .sql extension
        if (!str_ends_with($filename, '.sql')) {
            $filename .= '.sql';
        }
        
        // Create temp directory in user home for extraction (ensures proper ownership)
        $userTmpDir = getenv('HOME') ?: '/home/onlineh';
        $tempDir = $userTmpDir . '/tmp/borg_extract_' . uniqid();
        
        // Create with restrictive permissions first, then relax as needed
        if (!file_exists($userTmpDir . '/tmp')) {
            mkdir($userTmpDir . '/tmp', 0755, true);
        }
        
        mkdir($tempDir, 0755, true);
        
        try {
            // Try different path formats
            $pathsToTry = [
                $filename,                    // e.g., home/sql_dumps/file.sql
                '/' . ltrim($filename, '/'),  // e.g., /home/sql_dumps/file.sql
                ltrim($filename, '/'),        // ensure no leading slash
            ];
            
            $pathsToTry = array_unique($pathsToTry); // Remove duplicates
            
            $extractSuccess = false;
            $lastError = '';
            
            foreach ($pathsToTry as $pathVariant) {
                // Strategy A: Use new extract-for-user mode from runner script (sets proper permissions)
                try {
                    \Illuminate\Support\Facades\Log::debug('Attempting SQL extraction via extract-for-user', [
                        'archive' => $archive,
                        'path_variant' => $pathVariant,
                        'temp_dir' => $tempDir,
                    ]);

                    $args = [
                        'sudo',
                        '-n',
                        $this->runner,
                        'extract-for-user',
                        $archive,
                        'onlineh',
                        $pathVariant,
                    ];

                    $process = new Process($args, $tempDir);
                    $process->setTimeout(300);
                    $process->run();

                    if ($process->isSuccessful()) {
                        $extractSuccess = true;
                        \Illuminate\Support\Facades\Log::info('SQL extraction succeeded via extract-for-user', [
                            'archive' => $archive,
                            'working_path' => $pathVariant,
                        ]);
                        break;
                    }

                    $lastError = trim($process->getOutput() . "\n" . $process->getErrorOutput()) ?: ('No output (exit code ' . $process->getExitCode() . ')');
                    \Illuminate\Support\Facades\Log::debug('Path variant failed (extract-for-user)', [
                        'path' => $pathVariant,
                        'exit_code' => $process->getExitCode(),
                        'stdout' => $process->getOutput(),
                        'stderr' => $process->getErrorOutput(),
                    ]);
                } catch (\Exception $e) {
                    $lastError = $e->getMessage();
                    \Illuminate\Support\Facades\Log::debug('Path variant failed (extract-for-user exception)', [
                        'path' => $pathVariant,
                        'error' => $lastError,
                    ]);
                }

                if ($extractSuccess) {
                    break;
                }

                // Fallback: Use BorgService for extraction since it has working extractFiles method
                $borgService = app(\App\Services\BorgService::class);
                // Strategy B: use BorgService with temp dir as working directory
                try {
                    \Illuminate\Support\Facades\Log::debug('Attempting SQL extraction via BorgService (cwd)', [
                        'archive' => $archive,
                        'path_variant' => $pathVariant,
                        'temp_dir' => $tempDir,
                    ]);

                    $borgService->extractFiles($archive, [$pathVariant], $tempDir);
                    
                    $extractSuccess = true;
                    \Illuminate\Support\Facades\Log::info('SQL extraction succeeded via BorgService (cwd)', [
                        'archive' => $archive,
                        'working_path' => $pathVariant,
                    ]);
                    break;
                } catch (\Exception $e) {
                    $lastError = $e->getMessage();
                    \Illuminate\Support\Facades\Log::debug('Path variant failed (BorgService cwd)', [
                        'path' => $pathVariant,
                        'error' => $lastError,
                    ]);
                }

                // Strategy B: without destination flag, but set working directory
                try {
                    $args = [
                        'sudo',
                        '-n',
                        '/usr/local/bin/borg-runner.sh',
                        'extract-multi',
                        $archive,
                        $pathVariant,
                    ];

                    \Illuminate\Support\Facades\Log::debug('Attempting SQL extraction (extract-multi strategy)', [
                        'archive' => $archive,
                        'path_variant' => $pathVariant,
                        'cwd' => $tempDir,
                        'command' => implode(' ', $args),
                    ]);

                    $process = new Process($args, $tempDir);
                    $process->setTimeout(300);
                    $process->run();

                    if ($process->isSuccessful()) {
                        $extractSuccess = true;
                        \Illuminate\Support\Facades\Log::info('SQL extraction succeeded (extract-multi strategy)', [
                            'archive' => $archive,
                            'working_path' => $pathVariant,
                        ]);
                        break;
                    }

                    $lastError = trim($process->getOutput() . "\n" . $process->getErrorOutput()) ?: ('No output (exit code ' . $process->getExitCode() . ')');
                    \Illuminate\Support\Facades\Log::debug('Path variant failed (extract-multi strategy)', [
                        'path' => $pathVariant,
                        'exit_code' => $process->getExitCode(),
                        'stdout' => $process->getOutput(),
                        'stderr' => $process->getErrorOutput(),
                    ]);
                } catch (\Exception $e) {
                    $lastError = $e->getMessage();
                    \Illuminate\Support\Facades\Log::debug('Path variant failed (extract-multi strategy exception)', [
                        'path' => $pathVariant,
                        'error' => $lastError,
                    ]);
                }

                // Strategy C: try BorgWrapperService using direct borg
                try {
                    $wrapper = app(\App\Services\BorgWrapperService::class);

                    \Illuminate\Support\Facades\Log::debug('Attempting SQL extraction via BorgWrapperService', [
                        'archive' => $archive,
                        'path_variant' => $pathVariant,
                        'temp_dir' => $tempDir,
                    ]);

                    $wrapper->extractFiles($archive, [$pathVariant], $tempDir);

                    $extractSuccess = true;
                    \Illuminate\Support\Facades\Log::info('SQL extraction succeeded via BorgWrapperService', [
                        'archive' => $archive,
                        'working_path' => $pathVariant,
                    ]);
                    break;
                } catch (\Exception $e) {
                    $lastError = $e->getMessage();
                    \Illuminate\Support\Facades\Log::debug('Path variant failed via BorgWrapperService', [
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

            // Borg extracts files maintaining their path structure
            // So if we extract "home/sql_dumps/file.sql", it creates $tempDir/home/sql_dumps/file.sql
            $extractedPath = $tempDir . '/' . ltrim($filename, '/');
            
            if (!file_exists($extractedPath)) {
                // Try to find the file by searching recursively
                $iterator = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($tempDir, \RecursiveDirectoryIterator::SKIP_DOTS)
                );
                
                foreach ($iterator as $file) {
                    if ($file->isFile() && str_ends_with($file->getPathname(), '.sql')) {
                        $extractedPath = $file->getPathname();
                        \Illuminate\Support\Facades\Log::info('Found SQL file in temp dir', [
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

            \Illuminate\Support\Facades\Log::info('SQL file extracted successfully', [
                'archive' => $archive,
                'filename' => $filename,
                'size' => strlen($content),
            ]);

            return $content;
            
        } finally {
            // Clean up temp directory using PHP's recursive removal
            if (file_exists($tempDir)) {
                $this->removeDirectory($tempDir);
            }
        }
    }

    /**
     * Recursively remove a directory
     */
    private function removeDirectory(string $dir): void
    {
        if (!is_dir($dir)) {
            return;
        }

        $items = @scandir($dir);
        if ($items === false) {
            // If scandir fails, skip deletion (temp dir will be cleaned up eventually)
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

    /**
     * Parse SQL dump to extract table names
     */
    public function extractTableNames(string $sqlContent): array
    {
        $tables = [];
        
        // Match CREATE TABLE statements
        if (preg_match_all('/CREATE\s+TABLE\s+(?:IF\s+NOT\s+EXISTS\s+)?`?(\w+)`?/i', $sqlContent, $matches)) {
            $tables = array_unique($matches[1]);
        }

        return $tables;
    }

    /**
     * Filter SQL dump to include only specific tables
     */
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
            // Check if this is a CREATE TABLE for one of our target tables
            if (preg_match('/CREATE\s+TABLE\s+(?:IF\s+NOT\s+EXISTS\s+)?`?(' . $tablePattern . ')`?/i', $line, $m)) {
                $inTable = true;
                $currentTable = $m[1];
                $filtered[] = $line;
            }
            // Check if we're ending a table (next CREATE or DROP)
            elseif ($inTable && (str_starts_with(trim($line), 'CREATE') || str_starts_with(trim($line), 'DROP'))) {
                $inTable = false;
                if (str_starts_with(trim($line), 'DROP')) {
                    continue; // Skip DROP if not our table
                }
                // Check if this is CREATE for our table
                if (preg_match('/CREATE\s+TABLE\s+(?:IF\s+NOT\s+EXISTS\s+)?`?(' . $tablePattern . ')`?/i', $line, $m)) {
                    $inTable = true;
                    $currentTable = $m[1];
                    $filtered[] = $line;
                }
            }
            // Include locks and pragmas
            elseif (preg_match('/^(LOCK|UNLOCK|SET|\/\*|--|#)/', trim($line))) {
                $filtered[] = $line;
            }
            // Include content if we're in a target table
            elseif ($inTable) {
                $filtered[] = $line;
            }
        }

        return implode("\n", $filtered);
    }

    /**
     * Restore SQL dump to database
     */
    public function restoreDatabase(string $database, string $sqlContent): bool
    {
        // Write SQL to temp file
        $tmpFile = tempnam(sys_get_temp_dir(), 'restore_');
        file_put_contents($tmpFile, $sqlContent);

        try {
            // Try common DirectAdmin/MySQL paths
            $mysqlPaths = [
                '/usr/local/bin/mysql',
                '/usr/local/mysql/bin/mysql',
                '/usr/local/mariadb/bin/mysql',
                '/usr/bin/mariadb',
                '/usr/bin/mysql',
                'mysql', // fallback to PATH
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
            
            // Priority 1: Check for restore-specific credentials in .env
            $username = env('MYSQL_RESTORE_USER') ?: false;
            $password = env('MYSQL_RESTORE_PASSWORD') ?: false;
            $socket = env('MYSQL_RESTORE_SOCKET') ?: false;
            $host = env('MYSQL_RESTORE_HOST') ?: false;
            
            \Illuminate\Support\Facades\Log::debug('MySQL restore credentials priority check', [
                'has_restore_user' => !empty($username),
                'restore_user' => $username ? substr($username, 0, 5) . '***' : 'not-set',
            ]);
            
            // Priority 2: Try to read DirectAdmin MySQL config if not in .env
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
            
            // Priority 3: Fallback to Laravel database config
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

            // Ensure clean restore: drop & recreate database before import
            $prepSql = sprintf('DROP DATABASE IF EXISTS `%s`; CREATE DATABASE `%s`;', $database, $database);
            $prepArgs = array_merge($baseArgs, ['-e', $prepSql]);
            $prep = new Process($prepArgs);
            $prep->setTimeout(120);
            $prep->run();
            if (!$prep->isSuccessful()) {
                $error = trim($prep->getErrorOutput() ?: $prep->getOutput());
                throw new \RuntimeException('MySQL prepare (drop/create) failed: ' . $error);
            }

            // Restore dump into fresh database
            $restoreArgs = array_merge($baseArgs, [$database]);
            $process = new Process($restoreArgs);
            $process->setInput($sqlContent);
            $process->setTimeout(3600);
            $process->run();

            if (!$process->isSuccessful()) {
                $error = trim($process->getErrorOutput() ?: $process->getOutput());
                throw new \RuntimeException('MySQL restore failed: ' . $error);
            }

            return true;
        } finally {
            @unlink($tmpFile);
        }
    }
}
