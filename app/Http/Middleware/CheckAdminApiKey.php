<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Haal de verwachte sleutel op uit de .env variabele
        $expectedKey = env('ADMIN_API_KEY');

        // Als de sleutel niet is ingesteld (ontwikkelingsfout), stuur dan een foutmelding
        if (!$expectedKey) {
            return response()->json(['error' => 'Systeemfout: Admin API Key is niet geconfigureerd.'], 500);
        }

        // 2. Haal de sleutel op uit de header (meestal "Bearer XXXXXX" of direct de sleutel)
        $apiKey = $request->header('X-API-KEY'); // Populaire methode
        // Of: $request->bearerToken();

        // 3. Controleer of de ingezonden sleutel overeenkomt
        if (!$apiKey || $apiKey !== $expectedKey) {
            return response()->json(['error' => 'Ongeautoriseerd. Geldige API-sleutel vereist.'], 401);
        }

        // 4. Als de sleutel geldig is, laat het verzoek doorgaan
        return $next($request);
    }
}
