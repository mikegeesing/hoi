<?php

namespace App\Http\Controllers;

use App\Models\RestoreToken;
use App\Services\BorgService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    private function validateTokenOnly(string $plainToken): ?RestoreToken
    {
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
