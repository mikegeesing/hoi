<?php

namespace App\Jobs;

use App\Models\RestoreJob;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class BorgRestoreJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected RestoreJob $restoreJob;
    protected string $repositoryPath;
    protected string $restorePassword;

    /**
     * Maak een nieuw Job-exemplaar.
     *
     * @param RestoreJob $restoreJob Het Job Model dat we gaan updaten
     * @param string $repositoryPath Het pad naar de Borg repository
     * @param string $restorePassword Het Borg wachtwoord voor de repository
     */
    public function __construct(RestoreJob $restoreJob, string $repositoryPath, string $restorePassword)
    {
        $this->restoreJob = $restoreJob;
        $this->repositoryPath = $repositoryPath;
        $this->restorePassword = $restorePassword;
    }

    /**
     * Voer de taak uit. Dit is waar de Borg-extractie plaatsvindt.
     */
    public function handle(): void
    {
        // 1. Markeer de taak als "running"
        $this->restoreJob->status = 'running';
        $this->restoreJob->save();

        // 2. Extract naar root zodat bestanden op hun originele locatie komen
        $extractPath = '/';

        // Zorg ervoor dat de restore-path wordt opgeslagen voor later
        $this->restoreJob->restore_path = 'Bestanden hersteld naar originele locatie';
        $this->restoreJob->save();

        // 3. Bouw het Borg-commando (Extractie)
        // We moeten de bestandenlijst uit het Job-model halen (opgeslagen als JSON array)
        // Zorg ervoor dat de restore-path wordt opgeslagen voor later
        $this->restoreJob->restore_path = 'Bestanden hersteld naar originele locatie';
        $this->restoreJob->save();

        // Run borg extract directly (assumes the queue worker runs as the correct user)
        // Bouw het commando met alle bestanden als aparte argumenten
        // Zelfde format als BorgService: 'extract archive -- file1 file2 file3'
        $command = [
            'sudo',
            '/usr/local/bin/borg-runner.sh',
            'extract',
            $this->restoreJob->archive_name,
            '--',  // Scheidingsteken tussen archive naam en bestanden
        ];
        
        // Voeg alle bestanden toe als aparte argumenten
        foreach ($this->restoreJob->files_to_restore as $file) {
            $command[] = $file;
        }

        // 4. Stel de omgevingsvariabele BORG_PASSPHRASE in
        // Dit is de veilige manier om het wachtwoord door te geven aan Borg.
        $env = array_merge(
            [
                'BORG_PASSPHRASE' => $this->restorePassword,
                'BORG_RELOCATED_REPO_ACCESS_IS_OK' => 'yes',
                'TMPDIR' => config('filesystems.borg_temp_path', '/tmp'),
                'HOME' => env('HOME', getenv('HOME') ?: '/home/onlineh'),
            ],
            $_ENV
        );

        try {
            // 5. Voer het commando uit met behulp van Symfony Process
            // Set working directory to root so files are extracted to their original location
            Log::info('Starting borg extract', [
                'job_id' => $this->restoreJob->id,
                'command' => implode(' ', $command),
                'cwd' => $extractPath,
                'archive' => $this->restoreJob->archive_name,
                'files' => $this->restoreJob->files_to_restore,
            ]);
            
            $process = new Process($command, $extractPath, $env, null, 7200); // 2 uur timeout
            $process->run();

            $stdout = $process->getOutput();
            $stderr = $process->getErrorOutput();
            $exitCode = $process->getExitCode();
            $output = trim($stdout . "\n" . $stderr);

            Log::info('Borg extract process completed', [
                'job_id' => $this->restoreJob->id,
                'exit_code' => $exitCode,
                'stdout_length' => strlen($stdout),
                'stderr_length' => strlen($stderr),
                'stdout_preview' => substr($stdout, 0, 500),
                'stderr_preview' => substr($stderr, 0, 500),
            ]);

            // 6. Controleer het resultaat van de uitvoering
            if (!$process->isSuccessful()) {
                $errorMsg = "Exit code: $exitCode\n";
                $errorMsg .= "STDOUT:\n$stdout\n";
                $errorMsg .= "STDERR:\n$stderr\n";
                
                // Log full output for debugging
                Log::error('Borg extract failed - full output', [
                    'job_id' => $this->restoreJob->id,
                    'exit_code' => $exitCode,
                    'stdout' => $stdout,
                    'stderr' => $stderr,
                    'command' => implode(' ', $command),
                ]);
                
                throw new \RuntimeException($errorMsg);
            }

            // Check what files were actually extracted/restored
            $restoredFiles = [];
            foreach ($this->restoreJob->files_to_restore as $filePath) {
                // Files are restored to their absolute paths
                $absolutePath = '/' . ltrim($filePath, '/');
                if (file_exists($absolutePath)) {
                    $restoredFiles[] = $absolutePath;
                    // Also check if it's a directory and list its contents
                    if (is_dir($absolutePath)) {
                        $iterator = new \RecursiveIteratorIterator(
                            new \RecursiveDirectoryIterator($absolutePath, \RecursiveDirectoryIterator::SKIP_DOTS),
                            \RecursiveIteratorIterator::SELF_FIRST
                        );
                        foreach ($iterator as $file) {
                            $restoredFiles[] = $file->getPathname();
                        }
                    }
                }
            }

            $logOutput = "Borg extractie succesvol voltooid.\n\n";
            $logOutput .= "Archief: " . $this->restoreJob->archive_name . "\n";
            $logOutput .= "Gevraagde bestanden: " . count($this->restoreJob->files_to_restore) . "\n";
            $logOutput .= "Herstelde bestanden: " . count($restoredFiles) . "\n\n";
            
            if (!empty($restoredFiles)) {
                $logOutput .= "Herstelde bestanden naar originele locatie:\n";
                foreach (array_slice($restoredFiles, 0, 50) as $file) {
                    $logOutput .= "  - " . $file . "\n";
                }
                if (count($restoredFiles) > 50) {
                    $logOutput .= "  ... en " . (count($restoredFiles) - 50) . " meer\n";
                }
            }
            
            if (!empty($output)) {
                $logOutput .= "\nBorg output:\n" . $output;
            }

            // 7. Succes! Markeer de taak en log de output.
            $this->restoreJob->status = 'success';
            $this->restoreJob->log_output = $logOutput;
            $this->restoreJob->save();

            Log::info('Borg extract completed', [
                'job_id' => $this->restoreJob->id,
                'restored_files' => count($restoredFiles),
            ]);

        } catch (\Exception $e) {
            // 8. Fout! Markeer de taak als failed.
            $this->restoreJob->status = 'failed';
            $this->restoreJob->log_output = 'Fout bij Borg-extractie: ' . $e->getMessage();
            $this->restoreJob->save();

            // Log de fout ook in Laravel's logs
            Log::error('Borg Restore Failed: ' . $e->getMessage(), ['job_id' => $this->restoreJob->id]);

            // Gooi de uitzondering opnieuw zodat de Job Queue het kan afhandelen (bijv. retries)
            throw $e;
        }
    }
}
