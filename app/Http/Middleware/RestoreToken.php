<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RestoreToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->query('token');

        if (!$token) {
            abort(403, 'Geen token');
        }

        // later: database-validatie
        $request->attributes->set('restore_token', $token);

        return $next($request);
    }
}
