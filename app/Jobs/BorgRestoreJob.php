<?php

namespace App\Jobs;

use App\Models\RestoreJob;
use App\Services\BorgService;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


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
    public function handle(BorgService $borg): void
    {
        // 1. Markeer de taak als "running"
        $this->restoreJob->status = 'running';
        $this->restoreJob->save();

        try {
            // 2. Gebruik BorgService om bestanden te extraheren
            // BorgService.extractFiles() handelt alles af: error handling, retry logic, etc.
            Log::info('Starting borg extract via BorgService', [
                'job_id' => $this->restoreJob->id,
                'archive' => $this->restoreJob->archive_name,
                'files_count' => count($this->restoreJob->files_to_restore),
                'files' => $this->restoreJob->files_to_restore,
            ]);

            $output = $borg->extractFiles(
                $this->restoreJob->archive_name,
                $this->restoreJob->files_to_restore,
                '/'  // Extract naar root dus originele locatie
            );

            Log::info('BorgService extractFiles succeeded', [
                'job_id' => $this->restoreJob->id,
                'output_length' => strlen($output),
            ]);

            // 5. Check wat er daadwerkelijk werd hersteld
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

            // 6. Update log output.
            $this->restoreJob->restore_path = 'Bestanden hersteld naar originele locatie';
            $this->restoreJob->status = 'success';
            $this->restoreJob->log_output = $logOutput;
            $this->restoreJob->save();

            Log::info('Borg extract completed successfully', [
                'job_id' => $this->restoreJob->id,
                'restored_files' => count($restoredFiles),
            ]);

        } catch (\Exception $e) {
            // 5. Fout! Markeer de taak als failed.
            $this->restoreJob->status = 'failed';
            $this->restoreJob->log_output = 'Fout bij Borg-extractie: ' . $e->getMessage();
            $this->restoreJob->save();

            // Log de fout ook in Laravel's logs
            Log::error('Borg Restore Failed: ' . $e->getMessage(), [
                'job_id' => $this->restoreJob->id,
                'archive' => $this->restoreJob->archive_name,
                'files' => $this->restoreJob->files_to_restore,
            ]);

            // Gooi de uitzondering opnieuw zodat de Job Queue het kan afhandelen (bijv. retries)
            throw $e;
        }
    }
}
