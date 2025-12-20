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
        $events = [];
        try {
            $data = $borg->listArchives();
            $archives = $data['archives'] ?? [];

            // Sort archives newest first
            usort($archives, function ($a, $b) {
                $timeA = isset($a['time']) ? strtotime($a['time']) : null;
                $timeB = isset($b['time']) ? strtotime($b['time']) : null;

                if ($timeA && $timeB) {
                    return $timeB <=> $timeA; // newest first
                }

                return strcmp($b['name'] ?? '', $a['name'] ?? '');
            });

            foreach ($archives as $a) {
                $name = $a['name'] ?? null;
                $time = $a['time'] ?? null;

                if (!$name) continue;

                $day = null;
                $displayName = $name;
                
                // Extract datetime from archive name (e.g., server-2025-12-14T23:03:13.604073)
                if (preg_match('/(\d{4}-\d{2}-\d{2})T(\d{2}:\d{2}:\d{2})/', $name, $matches)) {
                    $datetime = \DateTime::createFromFormat('Y-m-d\TH:i:s', $matches[1] . 'T' . $matches[2]);
                    if ($datetime) {
                        $displayName = $datetime->format('d-m-Y H:i:s');
                        $day = $matches[1]; // Keep original format for 'start' field
                    }
                } elseif ($time) {
                    // Borg returns ISO time like 2025-12-17T02:00:00
                    $day = substr($time, 0, 10);
                }

                $events[] = [
                    'title' => $displayName,
                    'start' => $day,
                    'day' => $day,
                    'archive' => $displayName,
                ];
            }
        } catch (\Throwable $e) {
            $events = [];
            \Illuminate\Support\Facades\Log::error('Dashboard calendar error: ' . $e->getMessage());
        }

        return view('dashboard', [
            'events' => $events ?? [],
        ]);
    }
}
