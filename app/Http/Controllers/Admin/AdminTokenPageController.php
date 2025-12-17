<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestoreToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminTokenPageController extends Controller
{
    public function index()
    {
        $tokens = RestoreToken::orderByDesc('created_at')->get();

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

        // 2️⃣ Sla token HASH op (nooit plain)
        RestoreToken::create([
            'token' => hash('sha256', $plainToken),
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
