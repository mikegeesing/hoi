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

        $files = [];
        $seen = []; // Track seen files to avoid duplicates
        
        foreach (explode("\n", $output) as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            // Parse output - could be tab-separated or space-separated
            // Format is typically: "mode size mtime path"
            $parts = preg_split('/\s+/', $line, 4); // Split into at most 4 parts
            if (count($parts) >= 4) {
                $fullPath = $parts[3]; // Full path is the last part
                
                // Extract filename from path for filtering
                $filename = basename($fullPath);
                
                if (str_ends_with($filename, '.sql')) {
                    // Skip duplicates
                    if (isset($seen[$fullPath])) {
                        continue;
                    }
                    $seen[$fullPath] = true;
                    
                    // Filter by username if provided
                    if ($filterByUsername && !$this->isFileForUser($filename, $filterByUsername)) {
                        continue;
                    }
                    // Return the full path, not just filename
                    $files[] = $fullPath;
                }
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
        
        $args = [
            'sudo',
            $this->runner,
            'extract',
            $archive,
            '--',
            $filename,
        ];

        $process = new Process($args);
        $process->setTimeout(300);
        $process->run();

        if (!$process->isSuccessful()) {
            $errorOutput = trim($process->getErrorOutput());
            $standardOutput = trim($process->getOutput());
            $exitCode = $process->getExitCode();
            
            $errorMessage = "Failed to extract SQL file: $filename from archive: $archive";
            $errorMessage .= " (exit code: $exitCode)";
            
            // Check if runner doesn't exist
            if ($exitCode === 127) {
                $errorMessage .= " - Runner script not found at {$this->runner}";
            }
            // Exit code 21 typically means item not found in Borg
            elseif ($exitCode === 21) {
                $errorMessage .= " - File not found in archive at path: $filename";
            }
            
            if ($errorOutput) {
                $errorMessage .= " - Error: $errorOutput";
            }
            if ($standardOutput) {
                $errorMessage .= " - Output: $standardOutput";
            }
            
            // Log detailed debug information
            \Illuminate\Support\Facades\Log::debug('MySQL extract failure details', [
                'filename' => $filename,
                'archive' => $archive,
                'exit_code' => $exitCode,
                'error_output' => $errorOutput,
                'standard_output' => $standardOutput,
                'command_args' => $args,
            ]);
            
            throw new \RuntimeException($errorMessage);
        }

        return $process->getOutput();
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
            // Use shell_exec or Process to pipe SQL to mysql
            $cmd = sprintf(
                'sudo mysql %s < %s 2>&1',
                escapeshellarg($database),
                escapeshellarg($tmpFile)
            );

            $output = shell_exec($cmd);
            
            // Check if there were any errors (non-zero exit code)
            $lastLine = shell_exec($cmd . '; echo $?');
            if (trim($lastLine) !== '0') {
                throw new \RuntimeException('MySQL restore failed: ' . trim($output ?? ''));
            }

            return true;
        } finally {
            @unlink($tmpFile);
        }
    }
}
