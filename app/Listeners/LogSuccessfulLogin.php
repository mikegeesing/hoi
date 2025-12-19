<?php

namespace App\Listeners;

use App\Models\ActivityLog;
use Illuminate\Auth\Events\Login;

class LogSuccessfulLogin
{
    public function handle(Login $event): void
    {
        try {
            ActivityLog::create([
                'user_id' => $event->user->id,
                'action' => 'login',
                'description' => 'Succesvol ingelogd',
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'url' => request()->fullUrl(),
                'method' => 'POST',
            ]);
        } catch (\Throwable $e) {
            \Log::error('Login activity logging failed: ' . $e->getMessage());
        }
    }
}
