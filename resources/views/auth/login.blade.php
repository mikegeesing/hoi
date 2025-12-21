<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Username -->
        <div>
            <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
            <input id="username" class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" placeholder="Voer uw gebruikersnaam in" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Wachtwoord</label>
            <input id="password" class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" type="password" name="password" required autocomplete="current-password" placeholder="Voer uw wachtwoord in" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center mt-5">
            <input id="remember_me" type="checkbox" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500" name="remember">
            <label for="remember_me" class="ms-2 text-sm text-gray-600">Onthoud mij</label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 hover:text-green-600 transition font-medium" href="{{ route('password.request') }}">
                    Wachtwoord vergeten?
                </a>
            @endif

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg transition shadow-md hover:shadow-lg">
                Inloggen
            </button>
        </div>

        <!-- Passkey Login -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            <button id="passkey-login" type="button" class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-800 hover:bg-gray-900 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest transition shadow-md hover:shadow-lg">
                🔑 Inloggen met Passkey
            </button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/@laragear/webpass@2/dist/webpass.min.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('passkey-login');
            if (!btn) return;

            const setBusy = (busy) => {
                btn.disabled = busy;
                btn.textContent = busy ? '⏳ Bezig...' : '🔑 Inloggen met Passkey';
            };

            btn.addEventListener('click', async () => {
                if (!window.Webpass || Webpass.isUnsupported()) {
                    alert('Passkeys worden niet ondersteund op dit apparaat.');
                    return;
                }

                setBusy(true);
                try {
                    // Provide optional email hint if the username looks like an email
                    const username = document.getElementById('username')?.value?.trim();
                    const maybeEmail = username && /.+@.+\..+/.test(username) ? { email: username } : undefined;
                    const { success, error } = await Webpass.assert('/webauthn/login/options', '/webauthn/login', maybeEmail);
                    if (success) {
                        window.location.href = '/dashboard';
                        return;
                    }

                    // Toon een vriendelijke melding, details alleen in de console.
                    console.warn('WebAuthn login error:', error);
                    alert('De passkey is onjuist. Probeer opnieuw of gebruik je wachtwoord.');
                } catch (err) {
                    console.error('WebAuthn login exception:', err);
                    alert('De passkey is onjuist. Probeer opnieuw of gebruik je wachtwoord.');
                } finally {
                    setBusy(false);
                }
            });
        });
    </script>
</x-guest-layout>
