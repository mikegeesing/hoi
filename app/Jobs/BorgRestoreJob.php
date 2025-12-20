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

        // 2. Bepaal de tijdelijke herstelmap
        $tempPath = '/tmp/borg-restore-' . Str::random(10);

        // Maak de directory aan
        if (!file_exists($tempPath)) {
            mkdir($tempPath, 0755, true);
        }

        // Zorg ervoor dat de restore-path wordt opgeslagen voor later
        $this->restoreJob->restore_path = $tempPath;
        $this->restoreJob->save();

        // 3. Bouw het Borg-commando (Extractie)
        // We moeten de bestandenlijst uit het Job-model halen (opgeslagen als JSON array)
        $filesToRestore = implode(' ', $this->restoreJob->files_to_restore);

        // Run borg extract directly (assumes the queue worker runs as the correct user)
        $archiveFullPath = $this->repositoryPath . '::' . $this->restoreJob->archive_name;
        
        $command = [
            '/usr/bin/borg',
            'extract',
            $archiveFullPath,
            ...$this->restoreJob->files_to_restore,
        ];

        // 4. Stel de omgevingsvariabele BORG_PASSPHRASE in
        // Dit is de veilige manier om het wachtwoord door te geven aan Borg.
        $env = array_merge(
            [
                'BORG_PASSPHRASE' => $this->restorePassword,
                'BORG_RELOCATED_REPO_ACCESS_IS_OK' => 'yes',
                'TMPDIR' => config('filesystems.borg_temp_path', '/tmp'),
            ],
            $_ENV
        );

        try {
            // 5. Voer het commando uit met behulp van Symfony Process
            // Set working directory to temp path so files are extracted there
            Log::info('Starting borg extract', [
                'job_id' => $this->restoreJob->id,
                'command' => implode(' ', $command),
                'cwd' => $tempPath,
                'archive' => $this->restoreJob->archive_name,
                'files' => $this->restoreJob->files_to_restore,
            ]);
            
            $process = new Process($command, $tempPath, $env, null, 7200); // 2 uur timeout
            $process->run();

            $output = $process->getOutput() . "\n" . $process->getErrorOutput();

            // 6. Controleer het resultaat van de uitvoering
            if (!$process->isSuccessful()) {
                throw new \RuntimeException($output);
            }

            // Check what files were actually extracted
            $extractedFiles = [];
            if (is_dir($tempPath)) {
                $iterator = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($tempPath, \RecursiveDirectoryIterator::SKIP_DOTS),
                    \RecursiveIteratorIterator::SELF_FIRST
                );
                foreach ($iterator as $file) {
                    $extractedFiles[] = $file->getPathname();
                }
            }

            $logOutput = "Borg extractie succesvol voltooid.\n\n";
            $logOutput .= "Archief: " . $this->restoreJob->archive_name . "\n";
            $logOutput .= "Gevraagde bestanden: " . count($this->restoreJob->files_to_restore) . "\n";
            $logOutput .= "Geëxtraheerde bestanden: " . count($extractedFiles) . "\n\n";
            
            if (!empty($extractedFiles)) {
                $logOutput .= "Geëxtraheerde bestanden:\n";
                foreach (array_slice($extractedFiles, 0, 50) as $file) {
                    $logOutput .= "  - " . str_replace($tempPath, '', $file) . "\n";
                }
                if (count($extractedFiles) > 50) {
                    $logOutput .= "  ... en " . (count($extractedFiles) - 50) . " meer\n";
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
                'extracted_files' => count($extractedFiles),
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
