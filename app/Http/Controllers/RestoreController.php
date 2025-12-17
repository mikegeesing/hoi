<?php

namespace App\Http\Controllers;

use App\Models\RestoreToken;
use App\Models\RestoreJob;
use App\Jobs\BorgRestoreJob;
use App\Services\BorgService;
use Illuminate\Support\Facades\DB;
use App\Services\BorgWrapperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Bus;

class RestoreController extends Controller
{
    /**
     * ARCHIVE OVERZICHT
     */
    public function showArchives(Request $request, BorgService $borg)
    {
        $rawToken = $request->query('token');

        if (! $rawToken) {
            return view('landing', ['error' => 'Geen token']);
        }

        $token = $this->validateTokenOnly($rawToken);
        if (! $token) {
            return view('landing', ['error' => 'Token ongeldig']);
        }

        $data = $borg->listArchives();
        $archives = $data['archives'] ?? [];

        foreach ($archives as &$a) {
            try {
                // Let op: De Blade-view archive.blade.php verwacht 'detected_type', niet 'type'
                $a['detected_type'] = $borg->detectArchiveType($a['name']);
            } catch (\Throwable $e) {
                $a['detected_type'] = 'unknown';
            }
        }

        return view('restore.archives', [
            'archives' => $archives,
            'token' => $rawToken,
        ]);
    }

    /**
     * FILEBROWSER
     */
    public function showFiles(Request $request, string $archive, BorgService $borg)
    {
        $rawToken = $request->query('token');
        $path = $request->query('path', '');

        if (! $rawToken) {
            return view('landing', ['error' => 'Geen token']);
        }

        $token = $this->validateTokenOnly($rawToken);
        if (! $token) {
            return view('landing', ['error' => 'Token ongeldig']);
        }

        // 👉 FIX: Stel het initiële pad in op de gewenste home directory
        if ($path === '') {
            $path = '/home/onlineho'; // De gewenste startdirectory
        }

        try {
            $files = $borg->listFiles($archive, $path);
            // Normalise different service return shapes:
            // - BorgService::listFiles returns ['files' => [ ...structured items...]]
            // - Some wrappers may return a plain array of file path strings
            if (is_array($files) && isset($files['files']) && is_array($files['files'])) {
                $files = $files['files'];
            } elseif (is_array($files) && count($files) > 0 && is_string($files[0] ?? null)) {
                // array of string paths -> convert to view-friendly structure
                $converted = [];
                foreach ($files as $p) {
                    $converted[] = [
                        'type' => is_dir($p) ? 'dir' : 'file',
                        'size' => 0,
                        'name' => basename($p),
                        'path' => $p,
                    ];
                }
                $files = $converted;
            } elseif (! is_array($files)) {
                $files = [];
            }
        } catch (\Throwable $e) {
            Log::error('Filebrowser fout', [
                'archive' => $archive,
                'path' => $path,
                'error' => $e->getMessage(),
            ]);

            return view('landing', ['error' => 'Kan bestanden niet laden']);
        }

        return view('restore.files', [
            'archive' => $archive,
            'path' => $path,
            'files' => $files,
            'token' => $rawToken,
        ]);
    }

    /**
     * CALENDAR VIEW
     * If `path` and `archive` query params are present, only show events where the path exists.
     */
    public function showCalendar(Request $request, BorgService $borg, BorgWrapperService $wrapper)
    {
        $rawToken = $request->query('token');

        if (! $rawToken) {
            return view('landing', ['error' => 'Geen token']);
        }

        $token = $this->validateTokenOnly($rawToken);
        if (! $token) {
            return view('landing', ['error' => 'Token ongeldig']);
        }

        $archiveFilter = $request->query('archive');
        $pathFilter = $request->query('path');
        $filesFilterRaw = $request->query('files');

        $filesFilter = null;
        if ($filesFilterRaw) {
            // accept JSON array or comma separated
            $decoded = json_decode($filesFilterRaw, true);
            if (is_array($decoded)) {
                $filesFilter = $decoded;
            } else {
                // comma separated
                $filesFilter = array_filter(array_map('trim', explode(',', $filesFilterRaw)));
            }
        }

        $data = $borg->listArchives();
        $archives = $data['archives'] ?? [];

        $events = [];
        foreach ($archives as $a) {
            $name = $a['name'];
            $time = $a['time'] ?? null;

            // If a single path filter was given, require it to exist in the archive
            if ($pathFilter) {
                try {
                    $files = $borg->listFiles($name, $pathFilter);
                    if (empty($files['files'])) continue;
                } catch (\Throwable $e) {
                    continue;
                }
            }

            // If multiple files/paths were supplied, ensure each exists in this archive
            if (!empty($filesFilter) && is_array($filesFilter)) {
                $allExist = true;
                foreach ($filesFilter as $fp) {
                    try {
                        $check = $borg->listFiles($name, $fp);
                        if (empty($check['files'])) {
                            $allExist = false;
                            break;
                        }
                    } catch (\Throwable $e) {
                        $allExist = false;
                        break;
                    }
                }
                if (! $allExist) continue;
            }

            $day = null;
            if ($time) {
                // Borg returns ISO time like 2025-12-17T02:00:00
                $day = substr($time, 0, 10);
            }

            $events[] = [
                'title' => $name,
                'start' => $day,
                'day' => $day,
                'archive' => $name,
            ];
        }

        return view('restore.calendar', [
            'events' => $events,
            'token' => $rawToken,
            'archive' => $archiveFilter,
            'path' => $pathFilter,
            'files' => $filesFilter,
        ]);
    }

    /**
     * API: list snapshot archives that contain a given path
     * GET /restore/api/snapshots?token=...&path=/some/path
     */
    public function apiSnapshots(Request $request, BorgWrapperService $wrapper)
    {
        $rawToken = $request->query('token');
        $path = $request->query('path');

        if (! $rawToken || ! $path) {
            return response()->json(['error' => 'token en path vereist'], 400);
        }

        $token = $this->validateTokenOnly($rawToken);
        if (! $token) return response()->json(['error' => 'ongeldig token'], 403);

        try {
            $matches = $wrapper->archivesContainingPath($path);
            return response()->json(['archives' => $matches]);
        } catch (\Throwable $e) {
            Log::error('apiSnapshots failed: ' . $e->getMessage());
            return response()->json(['error' => 'Kon snapshots niet ophalen'], 500);
        }
    }

    /**
     * Start a restore job for a specific archive + path(s).
     * Expects JSON POST: { token, archive, files: ["/path/to/file"] }
     */
    public function startRestore(Request $request, BorgService $borg)
    {
        $rawToken = $request->input('token');
        $archive = $request->input('archive');
        $files = $request->input('files', []);

        if (! $rawToken) {
            return response()->json(['error' => 'Geen token'], 400);
        }

        $token = $this->validateTokenOnly($rawToken);
        if (! $token) {
            return response()->json(['error' => 'Token ongeldig'], 403);
        }

        if (! $archive || empty($files)) {
            return response()->json(['error' => 'Archive en files verplicht'], 400);
        }

        // Validate archive exists
        try {
            $archiveList = $borg->listArchives();
            $names = array_map(fn($a) => $a['name'] ?? null, $archiveList['archives'] ?? []);
            if (! in_array($archive, $names, true)) {
                return response()->json(['error' => 'Archive bestaat niet'], 400);
            }
        } catch (\Throwable $e) {
            Log::warning('Kon archieven niet ophalen voor validatie: ' . $e->getMessage());
        }

        // Validate files array
        if (! is_array($files)) {
            return response()->json(['error' => 'Files moet een array zijn'], 400);
        }

        $cleanFiles = [];
        foreach ($files as $f) {
            if (! is_string($f) || trim($f) === '') continue;
            $cleanFiles[] = $f;
        }

        if (empty($cleanFiles)) {
            return response()->json(['error' => 'Geen geldige bestanden opgegeven'], 400);
        }

        $files = $cleanFiles;

        // Create job and increment token usage inside a DB transaction with row lock to avoid races
        try {
            $result = DB::transaction(function () use ($token, $archive, $files) {
                // re-fetch token with FOR UPDATE
                $t = RestoreToken::where('id', $token->id)->lockForUpdate()->first();
                if (! $t) throw new \RuntimeException('Token niet gevonden tijdens transactie');
                if ($t->used >= $t->max_uses) throw new \RuntimeException('Token heeft geen resterende gebruiken');

                $t->used = ($t->used ?? 0) + 1;
                $t->save();

                $job = RestoreJob::create([
                    'token_id' => $t->id,
                    'status' => 'pending',
                    'files_to_restore' => $files,
                    'archive_name' => $archive,
                ]);

                return $job;
            });

            $job = $result;
        } catch (\Throwable $e) {
            Log::error('Failed creating restore job: ' . $e->getMessage());
            return response()->json(['error' => 'Kon job niet aanmaken: ' . $e->getMessage()], 500);
        }

        // Dispatch background job (separate from DB transaction)
        try {
            $repositoryPath = config('services.borg.repository') ?? env('BORG_REPOSITORY', 'REPO');
            $password = config('services.borg.passphrase') ?? env('BORG_PASSPHRASE', '');

            BorgRestoreJob::dispatch($job, $repositoryPath, $password);
        } catch (\Throwable $e) {
            Log::error('Failed dispatching restore job: ' . $e->getMessage());
            $job->status = 'failed';
            $job->log_output = $e->getMessage();
            $job->save();
            return response()->json(['error' => 'Kon job niet starten'], 500);
        }

        return response()->json(['job_id' => $job->id]);
    }

    /**
     * Return job status for a given job id (only accessible with same token)
     */
    public function getJobStatus(Request $request, RestoreJob $job)
    {
        $rawToken = $request->query('token');
        if (! $rawToken) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['error' => 'Geen token'], 403);
            }

            return view('landing', ['error' => 'Geen token']);
        }

        $token = $this->validateTokenOnly($rawToken);
        if (! $token) {
            return response()->json(['error' => 'Token ongeldig'], 403);
        }

        if ($job->token_id !== $token->id) {
            return response()->json(['error' => 'Niet toegestaan'], 403);
        }

        // If the request expects JSON, return JSON (API). Otherwise render a simple status page.
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => $job->status,
                'restore_path' => $job->restore_path,
                'log' => $job->log_output,
            ]);
        }

        return view('restore.status', [
            'job' => $job,
            'token' => $rawToken,
        ]);
    }

    private function validateTokenOnly(?string $plainToken): ?RestoreToken
    {
        if (! $plainToken) return null;

        $token = RestoreToken::where(
            'token',
            hash('sha256', $plainToken)
        )->first();

        if (! $token) return null;
        if ($token->expires_at->isPast()) return null;
        if ($token->used >= $token->max_uses) return null;

        return $token;
    }
}
