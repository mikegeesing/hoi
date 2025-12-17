<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestoreToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class AdminTokenPageController extends Controller
{
    public function index()
    {
        $tokens = RestoreToken::orderByDesc('created_at')->get();

        // Decrypt the stored encrypted token for admins so they can view it
        if (auth()->check() && auth()->user()->is_admin) {
            foreach ($tokens as $t) {
                try {
                    $t->plain_token = $t->token_encrypted ? Crypt::decryptString($t->token_encrypted) : null;
                } catch (\Throwable $e) {
                    $t->plain_token = null;
                }
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

        // 1️⃣ Genereer token
        $plainToken = Str::random(64);

        // 2️⃣ Sla token HASH op (nooit plain) en bewaar versleuteld zodat admin deze kan zien
        RestoreToken::create([
            'token' => hash('sha256', $plainToken),
            'token_encrypted' => Crypt::encryptString($plainToken),
            'borg_user' => $data['borg_user'],
            'expires_at' => now()->addHours((int)$data['expires_in_hours']),
            'max_uses' => (int)$data['max_uses'],
        ]);

        // 3️⃣ Toon plain token één keer
        return back()->with('new_token', $plainToken);
    }

    public function revoke(RestoreToken $token)
    {
        $token->delete();

        return back()->with('status', 'Token ingetrokken');
    }
}
