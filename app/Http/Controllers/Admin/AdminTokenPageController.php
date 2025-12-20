<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestoreToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AdminTokenPageController extends Controller
{
    public function index()
    {
        $tokens = RestoreToken::orderByDesc('created_at')->get();

        // Decrypt the stored encrypted token for admins so ze altijd zichtbaar is in de view
        foreach ($tokens as $t) {
            try {
                if ($t->token_encrypted) {
                    $t->plain_token = Crypt::decryptString($t->token_encrypted);
                } else {
                    $t->plain_token = null;
                }
            } catch (\Throwable $e) {
                $t->plain_token = null;
            }
        }

        return view('admin.tokens.index', compact('tokens'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'borg_user' => 'required|string',
            'expires_in_hours' => 'required|integer|min:1',
            'max_uses' => 'required|integer|min:1',
        ]);

        // 1️⃣ Zorg dat de user bestaat met role 'user' (niet admin!)
        User::firstOrCreate(
            ['name' => $data['borg_user']],
            [
                'email' => $data['borg_user'] . '@localhost',
                'password' => Hash::make(Str::random(32)),
                'role' => 'user', // IMPORTANT: Altijd 'user', nooit 'admin'!
            ]
        );

        // 2️⃣ Genereer gegarandeerd uniek token
        [$plainToken, $tokenHash] = $this->generateUniqueToken();

        // 3️⃣ Sla token HASH op (nooit plain) en bewaar versleuteld zodat admin deze kan zien
        RestoreToken::create([
            'token' => $tokenHash,
            'token_hash' => $tokenHash, // legacy column blijft uniek
            'token_encrypted' => Crypt::encryptString($plainToken),
            'borg_user' => $data['borg_user'],
            'expires_at' => now()->addHours((int)$data['expires_in_hours']),
            'max_uses' => (int)$data['max_uses'],
        ]);

        // 4️⃣ Toon plain token één keer
        return back()->with('new_token', $plainToken);
    }

    public function revoke(RestoreToken $token)
    {
        $token->delete();

        return back()->with('status', 'Token ingetrokken');
    }

    public function regenerate(RestoreToken $token)
    {
        // Only admins may regenerate — middleware ensures this, but double-check
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403);
        }

        [$plainToken, $tokenHash] = $this->generateUniqueToken();

        $token->update([
            'token' => $tokenHash,
            'token_hash' => $tokenHash,
            'token_encrypted' => Crypt::encryptString($plainToken),
            'used' => 0,
        ]);

        return back()->with('new_token', $plainToken)->with('status', 'Token opnieuw gegenereerd');
    }

    /**
     * Genereer een unieke token/hash combi, retry beperkt aantal keer om collisions te voorkomen.
     */
    private function generateUniqueToken(): array
    {
        $attempts = 0;
        $maxAttempts = 5;

        do {
            $plain = Str::random(64);
            $hash = hash('sha256', $plain);
            $exists = RestoreToken::where('token', $hash)
                ->orWhere('token_hash', $hash)
                ->exists();
            $attempts++;
        } while ($exists && $attempts < $maxAttempts);

        if ($exists) {
            throw new \RuntimeException('Kon geen uniek token genereren na meerdere pogingen');
        }

        return [$plain, $hash];
    }
}
