<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class BorgWrapperService
{
    protected string $repositoryPath;
    protected string $passphrase;
    protected string $tmpDir;
    protected string $homeDir;
    private string $apiUrl = 'http://127.0.0.1:9876';

    public function __construct(string $repositoryPath, string $passphrase)
    {
        $this->repositoryPath = $repositoryPath;
        $this->passphrase = $passphrase;

        // vaste, gecontroleerde env
        $this->tmpDir  = env('TMPDIR', '/home/onlineh/tmp');
        $this->homeDir = env('HOME', '/home/onlineh');
    }

    /**
     * Execute a borg command via HTTP API proxy
     */
    private function executeCommand(string $command, array $args = [], array $options = []): array
    {
        $timeout = $options['timeout'] ?? 120;
        $cwd = $options['cwd'] ?? null;
        
        $response = Http::timeout($timeout + 5)->post($this->apiUrl, [
            'command' => $command,
            'args' => $args,
            'env' => [
                'BORG_PASSPHRASE' => $this->passphrase,
                'TMPDIR' => $this->tmpDir,
                'HOME' => $this->homeDir,
            ],
            'timeout' => $timeout,
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
     * Lijst van archieven
     */
    public function getArchives(): array
    {
        // Note: This uses direct borg commands, not borg-runner.sh
        // If you need to use borg-runner.sh, adjust the command
        $args = ['list', '--json', $this->repositoryPath];
        $result = $this->executeCommand('list', $args, ['timeout' => 120]);

        $data = json_decode($result['stdout'], true);
        if (!isset($data['archives'])) {
            return [];
        }

        $archives = [];
        foreach ($data['archives'] as $archive) {
            $archives[] = [
                'name' => $archive['name'],
                'time' => $archive['time'],
                'size' => $this->formatSize($archive['stats']['compressed_size'] ?? 0),
            ];
        }

        return $archives;
    }

    /**
     * Bestanden in een archief
     */
    public function getFiles(string $archive): array
    {
        $args = ['list', $this->repositoryPath . '::' . $archive];
        $result = $this->executeCommand('list', $args, ['timeout' => 120]);

        $files = [];
        foreach (explode("\n", trim($result['stdout'])) as $line) {
            if (preg_match('/^\s*[d\-]/', $line)) {
                $parts = preg_split('/\s+/', $line, 7);
                if (isset($parts[6])) {
                    $files[] = $parts[6];
                }
            }
        }

        return $files;
    }

    /**
     * Return list of archives where the given path exists.
     * Each item: ['name' => ..., 'time' => ...]
     */
    public function archivesContainingPath(string $path): array
    {
        $archives = $this->getArchives();
        $matches = [];

        foreach ($archives as $archive) {
            $name = $archive['name'];
            try {
                $fileList = $this->getFiles($name);
                // $fileList is an array of file paths
                foreach ($fileList as $fp) {
                    if ($fp === $path || str_starts_with($fp, rtrim($path, '/') . '/')) {
                        $matches[] = [
                            'name' => $name,
                            'time' => $archive['time'] ?? null,
                        ];
                        break;
                    }
                }
            } catch (\Throwable $e) {
                // ignore this archive on error
                continue;
            }
        }

        return $matches;
    }

    /**
     * Extract specific files/paths from an archive to an optional destination.
     * Returns combined stdout/stderr on success, throws on failure.
     */
    public function extractFiles(string $archive, array $files, string $destination = ''): string
    {
        // Normalize file paths to start with 'home/'
        $normalizedFiles = [];
        foreach ($files as $file) {
            // Ensure paths start with 'home/'
            $normalized = ltrim($file, '/');
            if (!str_starts_with($normalized, 'home/')) {
                // Try to prepend 'home/' if it doesn't exist
                if (str_starts_with($normalized, 'domains/') || str_starts_with($normalized, 'public_html/')) {
                    $normalized = 'home/onlineh/' . $normalized;
                } else {
                    // For other paths, assume they're under /home/onlineh/
                    $normalized = 'home/onlineh/' . $normalized;
                }
            }
            
            // Check if this is a directory path (likely no file extension or ends with /)
            if (str_ends_with($normalized, '/') || (strpos(basename($normalized), '.') === false && !str_ends_with($normalized, '/cgi-bin'))) {
                // This looks like a directory, get all files recursively from the archive
                try {
                    $listResult = $this->executeCommand('list-files', [$archive, $normalized], ['timeout' => 120]);
                    $archiveFiles = explode("\n", trim($listResult['stdout']));
                    
                    foreach ($archiveFiles as $archiveFile) {
                        if (preg_match('/^\s*[d\-]/', $archiveFile)) {
                            // Parse: drwxr-xr-x user group size date time path
                            // We need to extract everything after the timestamp
                            // Format: permissions user group size day, YYYY-MM-DD HH:MM:SS path
                            if (preg_match('/^[d\-][rwx\-]+\s+\S+\s+\S+\s+\d+\s+\w+,\s+\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}:\d{2}\s+(.+)$/', $archiveFile, $matches)) {
                                $filePath = $matches[1];
                                // Only add actual files, not directories
                                if (!preg_match('/^d/', $archiveFile)) {
                                    $normalizedFiles[] = $filePath;
                                }
                            }
                        }
                    }
                    
                    Log::info('Expanded directory to files', [
                        'directory' => $normalized,
                        'file_count' => count($normalizedFiles)
                    ]);
                } catch (\Exception $e) {
                    // If we can't list the directory, just add it as-is
                    Log::warning('Could not list directory contents, adding as-is', [
                        'path' => $normalized,
                        'error' => $e->getMessage()
                    ]);
                    $normalizedFiles[] = $normalized;
                }
            } else {
                // Regular file path
                $normalizedFiles[] = $normalized;
            }
        }

        $args = [$archive];
        $args = array_merge($args, $normalizedFiles);

        Log::debug('BorgWrapper extract starting (via API proxy)', [
            'archive' => $archive,
            'destination' => $destination,
            'files' => $files,
            'args' => $args,
        ]);

        // Extract to root, files will be placed at correct paths
        $cwd = '/';
        
        $result = $this->executeCommand('extract-multi', $args, ['timeout' => 7200, 'cwd' => $cwd]);

        $output = $result['stdout'] . "\n" . $result['stderr'];

        Log::info('BorgWrapper extract succeeded', [
            'archive' => $archive,
            'destination' => $destination,
            'files' => $files,
            'exit_code' => $result['exitCode'],
            'stdout_snippet' => substr($result['stdout'], 0, 300),
            'stderr_snippet' => substr($result['stderr'], 0, 300),
        ]);

        return $output;
    }

    /**
     * Helper voor leesbare groottes
     */
    protected function formatSize(int $bytes): string
    {
        if ($bytes <= 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $i = floor(log($bytes, 1024));

        return round($bytes / (1024 ** $i), 2) . ' ' . $units[$i];
    }
}
