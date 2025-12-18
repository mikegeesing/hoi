<?php

namespace App\Services;

use Symfony\Component\Process\Process;

class MySQLService
{
    private string $runner = '/usr/local/bin/borg-runner.sh';

    /**
     * Extract SQL files from an archive
     * Returns array of filenames from /home/sql_dumps/
     */
    public function listSqlFiles(string $archive): array
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
        foreach (explode("\n", $output) as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            // Parse output - could be tab-separated or space-separated
            $parts = preg_split('/\s+/', $line);
            if (count($parts) >= 3) {
                $filename = array_pop($parts); // last part is filename
                if (str_ends_with($filename, '.sql')) {
                    $files[] = $filename;
                }
            }
        }

        return $files;
    }

    /**
     * Extract content of a specific SQL file from archive
     */
    public function extractSqlFile(string $archive, string $filename): string
    {
        // Sanitize filename to prevent path traversal
        $filename = basename($filename);
        
        $args = [
            'sudo',
            $this->runner,
            'extract',
            $archive,
            'home/sql_dumps/' . $filename,
        ];

        $process = new Process($args);
        $process->setTimeout(300);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException('Failed to extract SQL file: ' . trim($process->getErrorOutput()));
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
