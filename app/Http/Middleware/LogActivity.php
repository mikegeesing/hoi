<?php

namespace App\Http\Middleware;

use App\Models\ActivityLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LogActivity
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Only log for authenticated users
        if (auth()->check()) {
            $this->logActivity($request);
        }

        return $response;
    }

    private function logActivity(Request $request): void
    {
        try {
            $action = $this->determineAction($request);
            
            // Skip logging for certain routes
            if ($this->shouldSkip($request, $action)) {
                return;
            }

            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => $action,
                'description' => $this->getDescription($request, $action),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'method' => $request->method(),
            ]);
        } catch (\Throwable $e) {
            // Silently fail - don't break the app if logging fails
            \Log::error('Activity logging failed: ' . $e->getMessage());
        }
    }

    private function determineAction(Request $request): string
    {
        $path = $request->path();
        $method = $request->method();

        if (Str::contains($path, 'restore/archives')) return 'view_archives';
        if (Str::contains($path, 'restore/files')) return 'browse_files';
        if (Str::contains($path, 'restore/mysql')) return 'view_mysql_restore';
        if (Str::contains($path, 'restore/website')) return 'view_website_restore';
        if (Str::contains($path, 'restore/start') && $method === 'POST') return 'start_restore';
        if (Str::contains($path, 'restore/calendar')) return 'view_calendar';
        if (Str::contains($path, 'admin/tokens') && $method === 'POST') return 'manage_tokens';
        if (Str::contains($path, 'dashboard')) return 'view_dashboard';
        if (Str::contains($path, 'profile')) return 'view_profile';

        return 'page_view';
    }

    private function getDescription(Request $request, string $action): string
    {
        switch ($action) {
            case 'view_archives':
                return 'Bekijkt beschikbare backup archieven';
            case 'browse_files':
                $archive = $request->route('archive');
                $path = $request->query('path', '/');
                return "Bladert door bestanden in archief: {$archive}, pad: {$path}";
            case 'start_restore':
                $archive = $request->input('archive');
                $fileCount = count($request->input('files', []));
                return "Start restore van {$fileCount} bestand(en) uit archief: {$archive}";
            case 'view_mysql_restore':
                return 'Opent MySQL database restore pagina';
            case 'view_website_restore':
                return 'Opent website restore pagina';
            case 'view_calendar':
                return 'Bekijkt backup kalender';
            case 'manage_tokens':
                return 'Beheert restore tokens';
            case 'view_dashboard':
                return 'Bekijkt dashboard';
            case 'view_profile':
                return 'Bekijkt profiel';
            default:
                return $request->method() . ' ' . $request->path();
        }
    }

    private function shouldSkip(Request $request, string $action): bool
    {
        // Skip asset requests, API health checks, etc
        $path = $request->path();
        
        if (Str::startsWith($path, ['api/_health', 'build/', 'css/', 'js/', 'images/'])) {
            return true;
        }

        // Skip frequent polling endpoints
        if (Str::contains($path, 'restore/status') && $request->method() === 'GET') {
            return true;
        }

        return false;
    }
}
