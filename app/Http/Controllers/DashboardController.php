<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BorgService;
use App\Services\BorgWrapperService;

class DashboardController extends Controller
{
    /**
     * Show dashboard with calendar if authenticated, otherwise login page
     */
    public function index(Request $request, BorgService $borg, BorgWrapperService $wrapper)
    {
        // If user is not authenticated, show login page
        if (!auth()->check()) {
            return view('dashboard-login');
        }

        // User is authenticated, show calendar view
        try {
            $data = $borg->listArchives();
            $archives = $data['archives'] ?? [];

            $events = [];
            foreach ($archives as $a) {
                $name = $a['name'];
                $time = $a['time'] ?? null;

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
        } catch (\Throwable $e) {
            $events = [];
            \Illuminate\Support\Facades\Log::error('Dashboard calendar error: ' . $e->getMessage());
        }

        return view('dashboard', [
            'events' => $events,
        ]);
    }
}
