<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user()->load('webAuthnCredentials');

        return view('profile.edit', [
            'user' => $user,
            'passkeys' => $user->webAuthnCredentials,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Delete a specific WebAuthn passkey from the authenticated user.
     */
    public function destroyPasskey(Request $request, string $credentialId): RedirectResponse
    {
        $user = $request->user();

        $credential = $user->webAuthnCredentials()->whereKey($credentialId)->first();

        if ($credential) {
            $credential->delete();
            return Redirect::route('profile.edit')->with('status', 'passkey-deleted');
        }

        return Redirect::route('profile.edit')->with('status', 'passkey-not-found');
    }
}
