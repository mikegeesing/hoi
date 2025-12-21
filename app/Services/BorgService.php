<?php

namespace App\Services;

use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;

class BorgService
{
    private string $runner = '/usr/local/bin/borg-runner.sh';

    /**
     * ============================
     * LIST ARCHIVES
     * ============================
     */
    public function listArchives(): array
    {
        $process = new Process([
            'sudo',
            $this->runner,
            'list'
        ]);

        $process->setTimeout(60);
        $process->run();

        if (! $process->isSuccessful()) {
            throw new \RuntimeException(
                trim($process->getErrorOutput()) ?: 'Borg list failed'
            );
        }

        $json = json_decode($process->getOutput(), true);

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
        $args = [
            'sudo',
            $this->runner,
            'list-files',
            $archive,
        ];

        if ($path !== '') {
            $args[] = $path;
        }

        $process = new Process($args);
        $process->setTimeout(120);
        $process->run();

        if (! $process->isSuccessful()) {
            throw new \RuntimeException(
                trim($process->getErrorOutput()) ?: 'Borg list-files failed'
            );
        }

        // Attempt to parse multiple possible output formats from the runner.
        // Some runner variants output tab-separated values like: d\t0\thome
        // Others (when using plain borg or different env) may emit ls-style lines
        // like: drwx--x--x onlineho onlineho 0 Wed, 2025-12-03 14:16:44 home/onlineho
        $raw = trim($process->getOutput());

        \Illuminate\Support\Facades\Log::debug('BorgService listFiles raw output', [
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
            // Common file extensions (not domain extensions like .nl, .com, etc.)
            $hasFileExtension = preg_match('/\.(txt|log|php|js|css|html|htm|json|xml|yml|yaml|conf|ini|sh|sql|md|pdf|zip|tar|gz|jpg|jpeg|png|gif|svg|webp|ico|woff|woff2|ttf|eot|mp3|mp4|avi|mov|doc|docx|xls|xlsx|ppt|pptx|csv|bak|old|tmp|lock|htaccess|gitignore|env|moved|htmls)$/i', $basename);
            
            if ($hasFileExtension) {
                $isDirectory = false;
            } elseif (isset($type) && $type === 'd') {
                // Priority 2: Type explicitly set to 'd' from borg output
                $isDirectory = true;
            } elseif (str_ends_with($pathToken, '/')) {
                // Priority 3: Path ends with /
                $isDirectory = true;
            } elseif (isset($type) && $type === '-') {
                // Priority 4: Type explicitly set to '-' (file)
                $isDirectory = false;
            } else {
                // Default: assume it's a directory (for things like domain names without extensions)
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
                \Illuminate\Support\Facades\Log::debug('BorgService parsed file', [
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
        // Delegate to BorgWrapperService to avoid runner script execution issues
        $wrapper = app(\App\Services\BorgWrapperService::class);

        Log::debug('BorgService delegating extract to BorgWrapperService', [
            'archive' => $archive,
            'destination' => $destination,
            'files' => $files,
        ]);

        return $wrapper->extractFiles($archive, $files, $destination);
    }
}

