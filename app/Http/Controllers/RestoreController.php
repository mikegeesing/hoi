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
     * LOGIN PAGINA
     */
    public function showLogin()
    {
        return view('restore.login');
    }

    /**
     * ARCHIVE OVERZICHT
     */
    public function showArchives(Request $request, BorgService $borg)
    {
        $rawToken = $request->query('token');

        if (! $rawToken) {
            return redirect()->route('restore.login')->with('error', 'Token vereist');
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
        $search = $request->query('search');
        $depth = (int) $request->query('depth', 0);

        // Prevent infinite recursion
        $MAX_DEPTH = 100;
        if ($depth > $MAX_DEPTH) {
            return view('landing', ['error' => 'Maximale mapdiepte bereikt']);
        }

        if (! $rawToken) {
            return redirect()->route('restore.login')->with('error', 'Token vereist');
        }

        $token = $this->validateTokenOnly($rawToken);
        if (! $token) {
            return view('landing', ['error' => 'Token ongeldig']);
        }

        // 👉 FIX: Stel het initiële pad in op de gewenste home directory
        if ($path === '') {
            $path = 'home/onlineho'; // De gewenste startdirectory (zonder leading slash)
        }

        // Security: Ensure user stays within home/onlineho
        $basePath = 'home/onlineho';
        $normalizedPath = $path;
        
        // Normalize path: remove leading/trailing slashes for comparison
        $normalizedPath = trim($normalizedPath, '/');
        $normalizedBasePath = trim($basePath, '/');
        
        // Check if path starts with basePath or is exactly basePath
        if ($normalizedPath !== $normalizedBasePath && !str_starts_with($normalizedPath . '/', $normalizedBasePath . '/')) {
            Log::warning('restore.showFiles: unauthorized path access attempt', [
                'requested_path' => $path,
                'base_path' => $basePath,
                'token_id' => $token->id ?? 'unknown'
            ]);
            return view('landing', ['error' => 'Toegang geweigerd: u mag alleen in uw home directory navigeren']);
        }

        try {
            // Als er gezocht wordt, bouwen we een pattern
            $borgPath = $path;
            if ($search) {
                // Zorg dat we zoeken binnen de huidige path context
                // Borg patterns zijn sh-style. 
                // We strippen leading slash voor borg match (borg paths zijn vaak relatief in list)
                $cleanPath = ltrim($path, '/');
                $borgPath = $cleanPath 
                    ? "sh:$cleanPath/*$search*" 
                    : "sh:*$search*";
            }

            Log::info('restore.showFiles: listFiles call', ['archive' => $archive, 'path' => $path, 'borgPath' => $borgPath]);
            $files = $borg->listFiles($archive, $borgPath);
            Log::info('restore.showFiles: listFiles raw response', [
                'files_count' => count($files['files'] ?? []),
                'files_preview' => array_slice($files['files'] ?? [], 0, 50)
            ]);

            // Normalise different service return shapes into an array of
            // ['type','size','name','path'] entries for the view.
            $normalized = [];

            // If wrapper returns an envelope
            if (is_array($files) && isset($files['files']) && is_array($files['files'])) {
                $files = $files['files'];
            }

            // If a single object was returned, make it an array
            if ($files && ! is_array($files)) {
                $files = [$files];
            }

            if (is_array($files)) {
                foreach ($files as $item) {
                    // Allow stdClass / objects
                    if (is_object($item)) {
                        $item = (array) $item;
                    }

                    // If it's a plain string path
                    if (is_string($item)) {
                        $p = $item;
                        $normalized[] = [
                            'type' => 'file',
                            'size' => 0,
                            'name' => basename($p),
                            'path' => $p,
                        ];
                        continue;
                    }

                    if (is_array($item)) {
                        // try common keys
                        $p = $item['path'] ?? $item['name'] ?? ($item['filename'] ?? null);
                        $name = $item['name'] ?? $item['filename'] ?? ($p ? basename($p) : 'N/A');
                        $type = $item['type'] ?? ($item['is_dir'] ?? null) ? 'dir' : ($item['filetype'] ?? ($item['mode'] ?? 'file'));
                        $size = $item['size'] ?? $item['bytes'] ?? 0;

                        // normalize type value
                        if ($type === true || $type === 'dir' || stripos((string)$type, 'dir') !== false) {
                            $type = 'dir';
                        } else {
                            $type = 'file';
                        }

                        $normalized[] = [
                            'type' => $type,
                            'size' => (int) $size,
                            'name' => $name,
                            'path' => $p ?? $name,
                        ];
                    }
                }
            }

            $files = $normalized;

            // Filter: Only show items that are direct children of the current path
            // This prevents showing nested subdirectories from deeper levels
            $currentPathDepth = substr_count(rtrim($path, '/'), '/');
            
            $files = array_filter($files, function ($file) use ($path, $currentPathDepth) {
                $name = $file['name'] ?? '';
                $filePath = $file['path'] ?? '';
                $type = $file['type'] ?? 'file';
                
                // Calculate path depth to ensure we only show direct children
                $filePathDepth = substr_count(rtrim($filePath, '/'), '/');
                $expectedDepth = $currentPathDepth + 1;
                
                // Only show direct children (depth should be exactly one level deeper)
                if ($filePathDepth !== $expectedDepth) {
                    Log::debug('restore.showFiles: filtered by depth', ['name' => $name, 'fileDepth' => $filePathDepth, 'expectedDepth' => $expectedDepth]);
                    return false;
                }
                
                // Skip relative paths (symlinks)
                if (str_starts_with($filePath, './')) {
                    Log::debug('restore.showFiles: filtered - relative path', ['path' => $filePath]);
                    return false;
                }

                // Skip hidden system files and system folders
                $skipPatterns = [
                    '/^\./',                    // Starts with dot (hidden/system folders)
                    '/^dovecot-/i',            // Dovecot metadata
                    '/^maildirsize$/i',        // Maildir size file
                    '/^maildirfolder$/i',      // Maildir folder metadata
                    '/^subscriptions$/i',      // IMAP subscriptions file
                    '/^cur$/i',                // Maildir "current messages"
                    '/^new$/i',                // Maildir "new messages"
                    '/^tmp$/i',                // Maildir temp folder (in mail dirs)
                    '/^\.uidvalidity$/i',      // Maildir UID validity
                    '/^\.Trashed$/i',          // Dovecot trash
                ];
                
                foreach ($skipPatterns as $pattern) {
                    if (preg_match($pattern, $name)) {
                        Log::debug('restore.showFiles: filtered - pattern match', ['name' => $name, 'pattern' => $pattern]);
                        return false;
                    }
                }

                // Skip server default/system domain folders
                if (str_contains($filePath, '/domains/')) {
                    if (in_array(strtolower($name), ['default', 'suspended', 'sharedip'])) {
                        Log::debug('restore.showFiles: filtered - system domain', ['name' => $name]);
                        return false;
                    }
                }

                // Skip "onlineho" folder when viewing /home/onlineho (prevent self-reference)
                if ($path === 'home/onlineho' && $name === 'onlineho') {
                    Log::debug('restore.showFiles: filtered - self reference');
                    return false;
                }
                
                return true;
            });

            // Remove duplicates by name (case-insensitive)
            $seenNames = [];
            $files = array_filter($files, function ($file) use (&$seenNames) {
                $name = strtolower($file['name'] ?? '');
                
                if (in_array($name, $seenNames)) {
                    Log::debug('restore.showFiles: filtered - duplicate name', ['name' => $file['name']]);
                    return false;
                }
                
                $seenNames[] = $name;
                return true;
            });

            // Sort: directories first, then alphabetically
            $files = collect($files)->sort(function ($a, $b) {
                $aIsDir = ($a['type'] === 'dir') ? 0 : 1;
                $bIsDir = ($b['type'] === 'dir') ? 0 : 1;
                
                if ($aIsDir !== $bIsDir) {
                    return $aIsDir <=> $bIsDir;
                }
                
                return strcasecmp($a['name'] ?? '', $b['name'] ?? '');
            })->values()->all();

            // If normalization produced nothing, try root path as fallback and log it
            if (empty($files) && $path !== '') {
                \Illuminate\Support\Facades\Log::warning('restore.showFiles: no files for path, retrying root', ['archive' => $archive, 'path' => $path]);
                try {
                    $fallback = $borg->listFiles($archive, '');
                    \Illuminate\Support\Facades\Log::info('restore.showFiles: fallback listFiles', ['archive' => $archive, 'fallback_preview' => is_array($fallback) ? array_slice($fallback,0,10) : $fallback]);
                    // attempt to normalize fallback if present
                    if (is_array($fallback) && isset($fallback['files']) && is_array($fallback['files'])) {
                        $files = $fallback['files'];
                    }
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::error('restore.showFiles: fallback failed: ' . $e->getMessage());
                }
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
    public function showCalendar(Request $request, BorgService $borg)
    {
        Log::info('RestoreController@showCalendar hit', ['url' => $request->fullUrl()]);
        $rawToken = $request->query('token');

        if (! $rawToken) {
            return redirect()->route('restore.login')->with('error', 'Token vereist');
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
                $t->last_used_at = now();
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
