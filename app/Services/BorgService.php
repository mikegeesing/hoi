<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class BorgService
{
    private string $apiUrl = 'http://127.0.0.1:9876';

    /**
     * Execute a borg command via HTTP API proxy
     */
    private function executeCommand(string $command, array $args = [], int $timeout = 60): array
    {
        $response = Http::timeout($timeout + 5)->post($this->apiUrl, [
            'command' => $command,
            'args' => $args,
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
     * ============================
     * LIST ARCHIVES
     * ============================
     */
    public function listArchives(): array
    {
        $result = $this->executeCommand('list', [], 60);

        $json = json_decode($result['stdout'], true);

        if (! is_array($json) || ! isset($json['archives'])) {
            throw new \RuntimeException('Invalid Borg list JSON output');
        }

        return $json;
    }

    /**
     * ============================
     * LIST FILES IN ARCHIVE
     * ============================
     */
    public function listFiles(string $archive, string $path = ''): array
    {
        $args = [$archive];

        if ($path !== '') {
            $args[] = $path;
        }

        $result = $this->executeCommand('list-files', $args, 120);

        $raw = trim($result['stdout']);

        Log::debug('BorgService listFiles raw output', [
            'archive' => $archive,
            'path' => $path,
            'raw_sample' => substr($raw, 0, 500),
        ]);

        $files = [];
        if ($raw === '') {
            return ['files' => []];
        }

        foreach (explode("\n", $raw) as $line) {
            $line = trim($line);
            if ($line === '') continue;

            // If line contains explicit tabs, prefer tab-splitting
            if (strpos($line, "\t") !== false) {
                [$type, $size, $pathToken] = array_pad(explode("\t", $line, 3), 3, null);
            } else {
                // Fallback: whitespace-separated, take last token as path
                $parts = preg_split('/\s+/', $line);
                $pathToken = array_pop($parts);

                // Attempt to infer size and type from the remaining tokens
                $type = null;
                $size = 0;
                if (isset($parts[0])) {
                    // permissions string like drwx... -> type = 'd' or '-'
                    $perm = $parts[0];
                    $type = (strpos($perm, 'd') === 0) ? 'd' : '-';
                }
            }

            if (! isset($pathToken) || $pathToken === '') continue;

            // Determine if this is a directory
            $isDirectory = false;
            $basename = basename(rtrim($pathToken, '/'));

            // Priority 1: Check for file extensions first (most reliable for files)
            $hasFileExtension = preg_match('/\.(txt|log|php|js|css|html|htm|json|xml|yml|yaml|conf|ini|sh|sql|md|pdf|zip|tar|gz|jpg|jpeg|png|gif|svg|webp|ico|woff|woff2|ttf|eot|mp3|mp4|avi|mov|doc|docx|xls|xlsx|ppt|pptx|csv|bak|old|tmp|lock|htaccess|gitignore|env|moved|htmls)$/i', $basename);

            if ($hasFileExtension) {
                $isDirectory = false;
            } elseif (isset($type) && $type === 'd') {
                $isDirectory = true;
            } elseif (str_ends_with($pathToken, '/')) {
                $isDirectory = true;
            } elseif (isset($type) && $type === '-') {
                $isDirectory = false;
            } else {
                $isDirectory = true;
            }

            $file = [
                'type' => $isDirectory ? 'dir' : 'file',
                'size' => (int) ($size ?? 0),
                'name' => basename(rtrim($pathToken, '/')),
                'path' => $pathToken,
            ];

            $files[] = $file;

            // Log first 5 files for debugging
            if (count($files) <= 5) {
                Log::debug('BorgService parsed file', [
                    'raw_line' => $line,
                    'type_detected' => $type ?? 'null',
                    'hasFileExtension' => $hasFileExtension ?? false,
                    'isDirectory' => $isDirectory,
                    'parsed' => $file,
                ]);
            }
        }

        return ['files' => $files];
    }

    /**
     * Extract specific files/paths from an archive to an optional destination.
     * Returns combined stdout/stderr on success, throws on failure.
     */
    public function extractFiles(string $archive, array $files, string $destination = ''): string
    {
        // Delegate to BorgWrapperService
        $wrapper = app(\App\Services\BorgWrapperService::class);

        Log::debug('BorgService delegating extract to BorgWrapperService', [
            'archive' => $archive,
            'destination' => $destination,
            'files' => $files,
        ]);

        return $wrapper->extractFiles($archive, $files, $destination);
    }
}
