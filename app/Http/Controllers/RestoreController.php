<?php

namespace App\Http\Controllers;

use App\Models\RestoreToken;
use App\Models\RestoreJob;
use App\Jobs\BorgRestoreJob;
use App\Services\BorgService;
use App\Services\MySQLService;
use Illuminate\Support\Facades\DB;
use App\Services\BorgWrapperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Bus;
use Illuminate\Pagination\LengthAwarePaginator;

class RestoreController extends Controller
{
    /**
     * Restore portal entry point
     * - If authenticated admin: go to archives without token
     * - Otherwise: show token input page
     */
    public function index(Request $request)
    {
        // Only admins can access without token
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('restore.archives', ['token' => 'admin-access']);
        }
        
        // Show token input page for customers
        return view('restore.token-login');
    }

    /**
     * ARCHIVE OVERZICHT
     */
    public function showArchives(Request $request, BorgService $borg)
    {
        $access = $this->validateAccess($request);
        
        if (!$access['allowed']) {
            return redirect()->route('login')->with('error', 'Token vereist');
        }

        $rawToken = $access['rawToken'];

        try {
            $data = $borg->listArchives();
        } catch (\RuntimeException $e) {
            // Check if it's a lock timeout error (backups in progress)
            if (str_contains($e->getMessage(), 'lock')) {
                return view('restore.backups-running', [
                    'token' => $rawToken,
                    'error' => $e->getMessage(),
                ]);
            }
            throw $e;
        }
        
        $archives = $data['archives'] ?? [];

        // Sort newest first (by time, fallback to name)
        usort($archives, function ($a, $b) {
            $timeA = isset($a['time']) ? strtotime($a['time']) : null;
            $timeB = isset($b['time']) ? strtotime($b['time']) : null;

            if ($timeA && $timeB) {
                return $timeB <=> $timeA; // newest first
            }

            return strcmp($b['name'] ?? '', $a['name'] ?? '');
        });

        foreach ($archives as &$a) {
            try {
                // Let op: De Blade-view archive.blade.php verwacht 'detected_type', niet 'type'
                $a['detected_type'] = $borg->detectArchiveType($a['name']);
            } catch (\Throwable $e) {
                $a['detected_type'] = 'unknown';
            }
        }

        // Paginate archives (newest first)
        $perPage = 10;
        $page = max(1, (int) $request->query('page', 1));
        $offset = ($page - 1) * $perPage;
        $paginated = new LengthAwarePaginator(
            array_slice($archives, $offset, $perPage),
            count($archives),
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('restore.archives', [
            'archives' => $paginated,
            'token' => $rawToken,
        ]);
    }

    /**
     * FILEBROWSER
     */
    public function showFiles(Request $request, string $archive, BorgService $borg)
    {
        $path = $request->query('path', '');
        $search = $request->query('search');
        $depth = (int) $request->query('depth', 0);

        // Prevent infinite recursion
        $MAX_DEPTH = 100;
        if ($depth > $MAX_DEPTH) {
            return view('landing', ['error' => 'Maximale mapdiepte bereikt']);
        }

        $access = $this->validateAccess($request);
        
        if (!$access['allowed']) {
            return redirect()->route('login')->with('error', 'Token vereist');
        }

        $rawToken = $access['rawToken'];

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
            return redirect()->route('login')->with('error', 'Token vereist');
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
            $displayTime = null;
            if ($time) {
                // Borg returns ISO time like 2025-12-17T02:00:00
                $day = substr($time, 0, 10);
                // Extract just the time HH:mm from time field
                $displayTime = substr($time, 11, 5); // "HH:mm"
            } elseif (preg_match('/(\d{4}-\d{2}-\d{2})T(\d{2}:\d{2})/', $name, $matches)) {
                // Fallback: extract time from archive name if no time field
                $day = $matches[1];
                $displayTime = $matches[2];
            }

            $events[] = [
                'title' => $displayTime ? $displayTime : $name,
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

    /**
     * MYSQL RESTORE - Show SQL database selection
     */
    public function showMySQLRestore(Request $request, BorgService $borg, MySQLService $mysql)
    {
        $rawToken = $request->query('token');
        $archive = $request->query('archive');

        $isAdmin = $this->isAdminAccess($rawToken);

        if ((!$rawToken && !$isAdmin) || !$archive) {
            return redirect()->route('restore.archives')->with('error', 'Token en archief vereist');
        }

        $token = null;
        if (!$isAdmin) {
            $token = $this->validateTokenOnly($rawToken);
            if (!$token) {
                return view('landing', ['error' => 'Token ongeldig']);
            }
        }

        try {
            // Filter SQL files by the token's borg_user
            $sqlFiles = $mysql->listSqlFiles($archive, $token?->borg_user);
        } catch (\Exception $e) {
            Log::error('Failed to list SQL files', ['archive' => $archive, 'error' => $e->getMessage()]);
            return view('restore.mysql-select', [
                'token' => $rawToken,
                'archive' => $archive,
                'error' => 'Kon SQL bestanden niet ophalen: ' . $e->getMessage(),
                'sqlFiles' => [],
            ]);
        }

        return view('restore.mysql-select', [
            'token' => $rawToken,
            'archive' => $archive,
            'sqlFiles' => $sqlFiles,
        ]);
    }

    /**
     * MYSQL RESTORE - Confirm and execute restore
     */
    public function confirmMySQLRestore(Request $request, BorgService $borg, MySQLService $mysql)
    {
        $rawToken = $request->input('token');
        $archive = $request->input('archive');
        $database = $request->input('database_name');
        $sqlFile = $request->input('database');
        $restoreType = $request->input('restore_type', 'full');
        $tables = $request->input('tables', []);

        $isAdmin = $this->isAdminAccess($rawToken);
        $token = null;

        if (!$isAdmin) {
            $token = $this->validateTokenOnly($rawToken);
            if (!$token) {
                return response()->json(['error' => 'Token ongeldig'], 403);
            }
        }

        if (!$database || !$sqlFile || !$archive) {
            return response()->json(['error' => 'Ontbrekende parameters'], 400);
        }

        try {
            // Extract SQL from archive
            $sqlContent = $mysql->extractSqlFile($archive, $sqlFile);

            // Filter by tables if needed
            if ($restoreType === 'table' && !empty($tables)) {
                $sqlContent = $mysql->filterSqlByTables($sqlContent, $tables);
            }

            // Execute restore
            $mysql->restoreDatabase($database, $sqlContent);

            Log::info('Database restored successfully', [
                'token_id' => $token->id ?? 'admin-access',
                'archive' => $archive,
                'database' => $database,
                'type' => $restoreType,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Database succesvol hersteld',
            ]);
        } catch (\Exception $e) {
            Log::error('Database restore failed', [
                'error' => $e->getMessage(),
                'archive' => $archive,
                'database' => $database,
                'sqlFile' => $sqlFile,
                'restoreType' => $restoreType,
            ]);

            return response()->json([
                'error' => 'Restore mislukt: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * API - Get tables from SQL file
     */
    public function apiSqlTables(Request $request, BorgService $borg, MySQLService $mysql)
    {
        $rawToken = $request->query('token');
        $archive = $request->query('archive');
        $sqlFile = $request->query('file');

        $isAdmin = $this->isAdminAccess($rawToken);
        $token = null;

        if (!$isAdmin) {
            $token = $this->validateTokenOnly($rawToken);
            if (!$token) {
                return response()->json(['error' => 'Token ongeldig'], 403);
            }
        }

        if (!$archive || !$sqlFile) {
            return response()->json(['error' => 'Archive en file vereist'], 400);
        }

        try {
            $sqlContent = $mysql->extractSqlFile($archive, $sqlFile);
            $tables = $mysql->extractTableNames($sqlContent);

            return response()->json([
                'tables' => $tables,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to extract tables', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Kon tabel namen niet ophalen',
            ], 500);
        }
    }

    /**
     * WEBSITE RESTORE - Show domain selection
     */
    public function showWebsiteRestore(Request $request)
    {
        $rawToken = $request->query('token');
        $archive = $request->query('archive');

        if (!$rawToken || !$archive) {
            return redirect()->route('restore.archives')->with('error', 'Token en archief vereist');
        }

        $token = $this->validateTokenOnly($rawToken);
        if (!$token) {
            return view('landing', ['error' => 'Token ongeldig']);
        }

        // TODO: Get domains from DirectAdmin or local config
        $domains = $this->getAvailableDomains();

        return view('restore.website-select', [
            'token' => $rawToken,
            'archive' => $archive,
            'domains' => $domains,
        ]);
    }

    /**
     * WEBSITE RESTORE - Confirm and execute restore
     */
    public function confirmWebsiteRestore(Request $request, BorgService $borg, MySQLService $mysql)
    {
        $rawToken = $request->input('token');
        $archive = $request->input('archive');
        $domain = $request->input('domain');
        $restorePath = $request->input('restore_path');
        $sqlFile = $request->input('database_file');
        $dbName = $request->input('database_name');

        $token = $this->validateTokenOnly($rawToken);
        if (!$token) {
            return response()->json(['error' => 'Token ongeldig'], 403);
        }

        if (!$domain || !$archive) {
            return response()->json(['error' => 'Ontbrekende parameters'], 400);
        }

        try {
            // Start restore job for files
            $result = DB::transaction(function () use ($token, $archive, $restorePath, $domain, $sqlFile, $dbName, $mysql) {
                // Check token usage
                $t = RestoreToken::where('id', $token->id)->lockForUpdate()->first();
                if (!$t || $t->used >= $t->max_uses) {
                    throw new \RuntimeException('Token niet meer geldig');
                }

                // Increment usage
                $t->used = ($t->used ?? 0) + 1;
                $t->last_used_at = now();
                $t->save();

                // Create restore job
                $job = RestoreJob::create([
                    'token_id' => $t->id,
                    'status' => 'pending',
                    'archive' => $archive,
                    'restore_path' => $restorePath ?? '/home/' . $domain,
                    'log_output' => 'Wachten op verwerking...',
                ]);

                // If database file specified, also restore DB
                if ($sqlFile && $dbName) {
                    try {
                        $sqlContent = $mysql->extractSqlFile($archive, $sqlFile);
                        $mysql->restoreDatabase($dbName, $sqlContent);
                        $job->update(['log_output' => $job->log_output . "\nDatabase hersteld: " . $dbName]);
                    } catch (\Exception $e) {
                        Log::warning('Database restore in website restore failed', ['error' => $e->getMessage()]);
                    }
                }

                return $job;
            });

            // Queue file restore job
            Bus::dispatch(new BorgRestoreJob($result));

            Log::info('Website restore started', [
                'token_id' => $token->id,
                'archive' => $archive,
                'domain' => $domain,
                'job_id' => $result->id,
            ]);

            return response()->json([
                'success' => true,
                'job_id' => $result->id,
                'message' => 'Website restore gestart',
            ]);
        } catch (\Exception $e) {
            Log::error('Website restore failed', [
                'error' => $e->getMessage(),
                'archive' => $archive,
                'domain' => $domain,
            ]);

            return response()->json([
                'error' => 'Restore mislukt: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get available domains (placeholder)
     */
    private function getAvailableDomains(): array
    {
        $domains = config('restore.domains', []);
        
        // Filter out empty strings
        $domains = array_filter($domains, fn($d) => !empty(trim($d)));
        
        // If no domains configured, return empty
        if (empty($domains)) {
            return [];
        }

        return array_map('trim', $domains);
    }

    /**
     * Validate token or allow authenticated admins
     * Returns: ['allowed' => bool, 'token' => ?RestoreToken, 'rawToken' => string]
     */
    private function validateAccess(Request $request): array
    {
        $rawToken = $request->query('token');

        // Allow authenticated ADMINS without token
        if (auth()->check() && auth()->user()->role === 'admin' && (!$rawToken || $rawToken === 'admin-access')) {
            return [
                'allowed' => true,
                'token' => null,
                'rawToken' => 'admin-access'
            ];
        }

        // Regular token validation for customers and regular users
        if (!$rawToken) {
            return ['allowed' => false, 'token' => null, 'rawToken' => null];
        }

        $token = $this->validateTokenOnly($rawToken);
        return [
            'allowed' => $token !== null,
            'token' => $token,
            'rawToken' => $rawToken
        ];
    }

    private function isAdminAccess(?string $rawToken): bool
    {
        return auth()->check() && auth()->user()->role === 'admin' && (!$rawToken || $rawToken === 'admin-access');
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

        // Increment usage counter on first use (when accessing the portal)
        if ($token->used == 0) {
            $token->used = 1;
        }

        // Update last_used_at timestamp
        $token->last_used_at = now();
        $token->save();

        return $token;
    }

    /**
     * DEBUG: Show raw borg list-files output for an archive
     * GET /restore/debug/borg-list?token=...&archive=...
     */
    public function debugBorgList(Request $request, MySQLService $mysql)
    {
        $rawToken = $request->query('token');
        $archive = $request->query('archive');

        if (!$rawToken || !$archive) {
            return response()->json(['error' => 'token and archive required'], 400);
        }

        $token = $this->validateTokenOnly($rawToken);
        if (!$token) {
            return response()->json(['error' => 'invalid token'], 403);
        }

        try {
            // Use reflection to call protected/private method for debugging
            $reflection = new \ReflectionClass($mysql);
            $method = $reflection->getMethod('runBorgListFiles');
            $method->setAccessible(true);

            // Or just directly execute the borg command
            $cmd = [
                'sudo',
                '/usr/local/bin/borg-runner.sh',
                'list-files',
                $archive,
                'home/sql_dumps',
            ];

            $process = new \Symfony\Component\Process\Process($cmd);
            $process->setTimeout(120);
            $process->run();

            return response()->json([
                'success' => $process->isSuccessful(),
                'exit_code' => $process->getExitCode(),
                'stdout_lines' => explode("\n", trim($process->getOutput())),
                'stderr' => $process->getErrorOutput(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

