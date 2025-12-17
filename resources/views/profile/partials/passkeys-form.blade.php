<section class="space-y-4">
    <header>
        <h2 class="text-lg font-medium text-gray-900">Passkeys (WebAuthn)</h2>
        <p class="mt-1 text-sm text-gray-600">Registreer een passkey om veilig en zonder wachtwoord in te loggen.</p>
    </header>

    <div class="flex items-center gap-3">
        <x-primary-button type="button" id="passkey-register">
            Passkey registreren
        </x-primary-button>
        <span id="passkey-register-status" class="text-sm text-gray-600"></span>
    </div>

    <div class="text-sm text-gray-500">Na registreren kun je inloggen via "Log in met passkey" op het login scherm.</div>

    <script src="https://cdn.jsdelivr.net/npm/@laragear/webpass@2/dist/webpass.min.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('passkey-register');
            const status = document.getElementById('passkey-register-status');

            const setStatus = (message, isError = false) => {
                if (status) {
                    status.textContent = message;
                    status.classList.toggle('text-red-600', isError);
                    status.classList.toggle('text-gray-600', !isError);
                }
            };

            if (!btn) return;

            btn.addEventListener('click', async () => {
                if (!window.Webpass || Webpass.isUnsupported()) {
                    setStatus('Passkeys worden niet ondersteund in deze browser of apparaat.', true);
                    return;
                }

                btn.disabled = true;
                setStatus('Bezig met registreren...');

                try {
                    const { success, error } = await Webpass.attest('/webauthn/register/options', '/webauthn/register');
                    if (success) {
                        setStatus('Passkey geregistreerd!');
                    } else {
                        setStatus(error || 'Registreren mislukt. Probeer opnieuw.', true);
                    }
                } catch (err) {
                    console.error(err);
                    setStatus('Registreren mislukt. Probeer opnieuw.', true);
                } finally {
                    btn.disabled = false;
                }
            });
        });
    </script>
</section>
