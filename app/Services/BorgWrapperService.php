<?php

namespace App\Services;

use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;

class BorgWrapperService
{
    protected string $repositoryPath;
    protected string $passphrase;
    protected string $tmpDir;
    protected string $homeDir;
    protected string $runner = '/usr/local/bin/borg-runner.sh';

    public function __construct(string $repositoryPath, string $passphrase)
    {
        $this->repositoryPath = $repositoryPath;
        $this->passphrase = $passphrase;

        // vaste, gecontroleerde env
        $this->tmpDir  = env('TMPDIR', '/home/onlineh/tmp');
        $this->homeDir = env('HOME', '/home/onlineh');
    }

    /**
     * Basis runner voor Borg-commando’s
     */
    protected function run(array $args): string
    {
        $command = array_merge(['sudo', '-n', '/usr/bin/borg'], $args);

        $env = [
            'BORG_PASSPHRASE' => $this->passphrase,
            'TMPDIR'          => $this->tmpDir,
            'HOME'            => $this->homeDir,
        ];

        Log::debug('Borg command', [
            'cmd' => implode(' ', $command),
            'env' => $env,
        ]);

        $process = new Process($command, null, $env, null, 120);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException(
                $process->getErrorOutput() ?: $process->getOutput()
            );
        }

        return $process->getOutput();
    }

    /**
     * Lijst van archieven
     */
    public function getArchives(): array
    {
        $output = $this->run([
            'list',
            '--json',
            $this->repositoryPath,
        ]);

        $data = json_decode($output, true);
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
        $output = $this->run([
            'list',
            $this->repositoryPath . '::' . $archive,
        ]);

        $files = [];
        foreach (explode("\n", trim($output)) as $line) {
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
        // Use borg-runner.sh for secure, validated extraction
        $args = [
            'sudo',
            '-n',
            $this->runner,
            'extract-multi',
            $archive,
        ];
        $args = array_merge($args, $files);

        $env = [
            'BORG_PASSPHRASE' => $this->passphrase,
            'TMPDIR' => $this->tmpDir,
            'HOME' => $this->homeDir,
        ];

        // Use destination as cwd if provided
        $cwd = $destination !== '' ? $destination : null;

        Log::debug('BorgWrapper extract starting (via runner)', [
            'archive' => $archive,
            'destination' => $destination,
            'files' => $files,
            'command' => implode(' ', $args),
            'cwd' => $cwd,
            'runner' => $this->runner,
        ]);

        $process = new Process($args, $cwd, $env);
        $process->setTimeout(7200);
        $process->run();

        $output = $process->getOutput() . "\n" . $process->getErrorOutput();

        if ($process->isSuccessful()) {
            Log::info('BorgWrapper extract succeeded', [
                'archive' => $archive,
                'destination' => $destination,
                'files' => $files,
                'exit_code' => $process->getExitCode(),
                'stdout_snippet' => substr($process->getOutput(), 0, 300),
                'stderr_snippet' => substr($process->getErrorOutput(), 0, 300),
            ]);
            return $output;
        }

        Log::error('BorgWrapper extract failed', [
            'archive' => $archive,
            'destination' => $destination,
            'files' => $files,
            'exit_code' => $process->getExitCode(),
            'stdout' => $process->getOutput(),
            'stderr' => $process->getErrorOutput(),
        ]);

        throw new \RuntimeException(trim($output) ?: 'Borg extract failed');
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
