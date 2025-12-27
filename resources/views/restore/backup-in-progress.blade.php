<x-restore-layout>
    <x-slot name="token">{{ $token }}</x-slot>

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="text-center max-w-md">
            <!-- Loading Animation -->
            <div class="mb-8 flex justify-center">
                <div class="relative w-24 h-24">
                    <div class="absolute inset-0 rounded-full border-4 border-gray-200"></div>
                    <div class="absolute inset-0 rounded-full border-4 border-transparent border-t-indigo-600 border-r-indigo-600 animate-spin"></div>
                </div>
            </div>

            <!-- Heading -->
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                Backups worden gemaakt
            </h1>
            
            <p class="text-lg text-gray-600 mb-2">
                Even geduld alstublieft...
            </p>

            <p class="text-sm text-gray-500 mb-8">
                De pagina wordt automatisch vernieuwd zodra de backups klaar zijn.
            </p>

            <!-- Status Box -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
                <div class="flex items-start gap-3">
                    <div class="text-blue-600 mt-1">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM8 7a1 1 0 000 2h6a1 1 0 000-2H8zm0 4a1 1 0 000 2h3a1 1 0 000-2H8z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <p class="font-semibold text-blue-900">Wat gebeurt er?</p>
                        <p class="text-sm text-blue-700 mt-1">
                            Het systeem maakt momenteel backups van je bestanden. Dit kan even duren, afhankelijk van de hoeveelheid gegevens.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Dots animation -->
            <div class="flex justify-center gap-2 mb-8">
                <div class="w-2 h-2 bg-indigo-600 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                <div class="w-2 h-2 bg-indigo-600 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                <div class="w-2 h-2 bg-indigo-600 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
            </div>

            <!-- Auto-refresh info -->
            <p class="text-xs text-gray-400">
                Auto-refresh in <span id="countdown">5</span> seconden...
            </p>
        </div>
    </div>

    <script>
        // Auto-refresh logic
        let countdown = 5;
        let isChecking = false;

        function updateCountdown() {
            countdown--;
            document.getElementById('countdown').textContent = countdown;
            
            if (countdown <= 0) {
                checkBackupStatus();
                countdown = 5;
            }
        }

        async function checkBackupStatus() {
            if (isChecking) return;
            isChecking = true;

            try {
                const response = await fetch('{{ route("restore.archives") }}?token={{ urlencode($token) }}', {
                    headers: {
                        'Accept': 'text/html'
                    }
                });

                // If successful (no timeout), reload
                if (response.ok) {
                    const text = await response.text();
                    // Check if the response contains the backups-running view
                    if (!text.includes('Backups worden gemaakt')) {
                        // Backups are done, reload the page
                        window.location.reload();
                    }
                }
            } catch (error) {
                console.log('Still waiting for backups to complete...');
            } finally {
                isChecking = false;
            }
        }

        // Start countdown timer
        setInterval(updateCountdown, 1000);
    </script>
</x-restore-layout>
