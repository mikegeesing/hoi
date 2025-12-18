<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-end mt-4">
            <button id="passkey-login" type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Log in with passkey') }}
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
                btn.textContent = busy ? 'Bezig...' : 'Log in met passkey';
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

                    alert(error || 'Kon niet inloggen met passkey.');
                } catch (err) {
                    console.error(err);
                    alert('Kon niet inloggen met passkey.');
                } finally {
                    setBusy(false);
                }
            });
        });
    </script>
</x-guest-layout>
