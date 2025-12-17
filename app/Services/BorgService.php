<?php

namespace App\Services;

use Symfony\Component\Process\Process;

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

        /**
         * Verwacht formaat:
         * d\t0\thome
         * -\t123\thome/file.txt
         */
        $files = [];

        foreach (explode("\n", trim($process->getOutput())) as $line) {
            if ($line === '') continue;

            [$type, $size, $path] = array_pad(explode("\t", $line, 3), 3, null);

            if (! $path) continue;

            $files[] = [
                'type' => $type === 'd' ? 'dir' : 'file',
                'size' => (int) $size,
                'name' => basename($path),
                'path' => $path,
            ];
        }

        return [
            'files' => $files
        ];
    }
}

