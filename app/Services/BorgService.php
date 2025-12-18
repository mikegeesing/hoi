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

            $files[] = [
                'type' => (isset($type) && $type === 'd') ? 'dir' : 'file',
                'size' => (int) ($size ?? 0),
                'name' => basename($pathToken),
                'path' => $pathToken,
            ];
        }

        return ['files' => $files];
    }

    /**
     * Extract specific files/paths from an archive to an optional destination.
     * Returns combined stdout/stderr on success, throws on failure.
     */
    public function extractFiles(string $archive, array $files, string $destination = ''): string
    {
        $env = [
            'TMPDIR' => env('TMPDIR', sys_get_temp_dir()),
            'HOME' => env('HOME', getenv('HOME') ?: '/home/onlineh'),
        ];

        $attemptErrors = [];

        $attempt = function (bool $useDestination, ?string $cwd) use ($archive, $files, $destination, $env, &$attemptErrors): string {
            $args = [
                'sudo',
                $this->runner,
                'extract',
                $archive,
            ];

            $label = $useDestination ? 'with-destination' : 'cwd-only';

            if ($useDestination && $destination !== '') {
                $args[] = '--destination';
                $args[] = $destination;
            }

            $args[] = '--';
            $args = array_merge($args, $files);

            Log::debug('Borg extract starting', [
                'archive' => $archive,
                'destination' => $useDestination ? $destination : null,
                'files' => $files,
                'command' => implode(' ', $args),
                'cwd' => $cwd,
                'label' => $label,
                'env' => $env,
            ]);

            $process = new Process($args, $cwd, $env);
            $process->setTimeout(7200);
            $process->run();

            $output = $process->getOutput() . "\n" . $process->getErrorOutput();

            if ($process->isSuccessful()) {
                Log::info('Borg extract succeeded', [
                    'archive' => $archive,
                    'destination' => $useDestination ? $destination : null,
                    'files' => $files,
                    'exit_code' => $process->getExitCode(),
                    'stdout_snippet' => substr($process->getOutput(), 0, 300),
                    'stderr_snippet' => substr($process->getErrorOutput(), 0, 300),
                    'label' => $label,
                ]);
                return $output;
            }

            $attemptErrors[] = [
                'label' => $label,
                'exit_code' => $process->getExitCode(),
                'stdout' => $process->getOutput(),
                'stderr' => $process->getErrorOutput(),
                'message' => trim($output) ?: 'Borg extract failed',
            ];

            Log::warning('Borg extract attempt failed', [
                'label' => $label,
                'archive' => $archive,
                'destination' => $useDestination ? $destination : null,
                'files' => $files,
                'exit_code' => $process->getExitCode(),
                'stdout' => $process->getOutput(),
                'stderr' => $process->getErrorOutput(),
            ]);

            throw new \RuntimeException($attemptErrors[array_key_last($attemptErrors)]['message']);
        };

        // First try with destination flag if provided
        try {
            return $attempt(true, null);
        } catch (\Throwable $e) {
            // If destination was provided, retry without destination but set CWD
            if ($destination !== '') {
                try {
                    return $attempt(false, $destination);
                } catch (\Throwable $e2) {
                    // Fall through to combined error handling below
                }
            }
        }

        // If we reach here, all attempts failed
        Log::error('Borg extract failed after retries', [
            'archive' => $archive,
            'destination' => $destination,
            'files' => $files,
            'attempt_errors' => $attemptErrors,
        ]);

        $messages = array_map(fn($err) => "[{$err['label']}] exit {$err['exit_code']}: {$err['message']}", $attemptErrors);
        $message = implode(' | ', $messages) ?: 'Borg extract failed';

        throw new \RuntimeException($message);
    }
}

