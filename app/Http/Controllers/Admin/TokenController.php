<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TokenController extends Controller
{
    public function store(Request $request)
    {
        if ($request->bearerToken() !== config('api.admin_key')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $data = $request->validate([
            'borg_user' => 'required|string',
            'expires_in_hours' => 'required|integer|min:1',
            'max_uses' => 'required|integer|min:1',
        ]);

        return response()->json([
            'token' => Str::random(64),
            'borg_user' => $data['borg_user'],
            'expires_at' => now()->addHours($data['expires_in_hours']),
            'max_uses' => $data['max_uses'],
        ]);
    }
}
