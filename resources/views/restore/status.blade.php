<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Restore status</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="flex items-start justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Herstel job #{{ $job->id }}</h1>
                <div class="text-sm text-gray-500 mt-1">Aangemaakt: {{ $job->created_at->diffForHumans() }}</div>
            </div>
            <div class="text-right">
                <div class="text-xs uppercase tracking-wider text-gray-500 mb-1">Status</div>
                <div class="mt-1">
                    <span id="status" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if($job->status === 'success') bg-green-100 text-green-800
                        @elseif($job->status === 'failed') bg-red-100 text-red-800
                        @elseif($job->status === 'running') bg-blue-100 text-blue-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        {{ ucfirst($job->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <div class="text-xs uppercase tracking-wider text-gray-500 mb-2">Restore pad</div>
            <div class="font-mono text-sm text-gray-900 break-all" id="restore_path">{{ $job->restore_path ?? '—' }}</div>
        </div>

        <!-- Wacht bericht voor pending jobs -->
        @if($job->status === 'pending')
            <div class="mb-6 bg-blue-50 border-l-4 border-blue-400 rounded-r-lg p-4" id="pending-message">
                <div class="flex items-center">
                    <svg class="animate-spin h-5 w-5 text-blue-600 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <div>
                        <div class="font-semibold text-blue-900">Taak staat in wachtrij...</div>
                        <div class="text-sm text-blue-700">De restore job wordt voorbereid en zal zo starten. Dit kan even duren.</div>
                    </div>
                </div>
            </div>
        @endif

        @if($job->status === 'running')
            <div class="mb-6 bg-green-50 border-l-4 border-green-400 rounded-r-lg p-4" id="running-message">
                <div class="flex items-center">
                    <svg class="animate-spin h-5 w-5 text-green-600 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <div>
                        <div class="font-semibold text-green-900">Bestanden worden hersteld...</div>
                        <div class="text-sm text-green-700">De restore is bezig. Even geduld alstublieft.</div>
                    </div>
                </div>
            </div>
        @endif

        @if($job->status === 'success')
            <div class="mb-6 bg-green-50 border-l-4 border-green-400 rounded-r-lg p-4">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-green-600 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <div class="font-semibold text-green-900">Restore succesvol voltooid!</div>
                        <div class="text-sm text-green-700">De bestanden zijn hersteld.</div>
                    </div>
                </div>
            </div>
        @endif

        @if($job->status === 'failed')
            <div class="mb-6 bg-red-50 border-l-4 border-red-400 rounded-r-lg p-4">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-red-600 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <div class="font-semibold text-red-900">Restore mislukt</div>
                        <div class="text-sm text-red-700">Er is een fout opgetreden tijdens het herstellen.</div>
                    </div>
                </div>
            </div>
        @endif

        <div class="mb-2">
            <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Log output</h3>
        </div>
        <pre id="log" class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-auto max-h-96 font-mono">{{ $job->log_output ?? 'Nog geen output - wachten op start van de taak...' }}</pre>

        <div class="mt-6 pt-6 border-t border-gray-200">
            <a href="/restore?token={{ urlencode($token) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Terug naar portal
            </a>
        </div>
    </div>
</div>

<script>
(function(){
    const jobId = {{ $job->id }};
    const token = "{{ $token }}";

    function updateStatusBadge(status) {
        const badge = document.getElementById('status');
        badge.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium';
        
        if (status === 'success') {
            badge.className += ' bg-green-100 text-green-800';
            badge.textContent = 'Success';
        } else if (status === 'failed') {
            badge.className += ' bg-red-100 text-red-800';
            badge.textContent = 'Failed';
        } else if (status === 'running') {
            badge.className += ' bg-blue-100 text-blue-800';
            badge.textContent = 'Running';
        } else {
            badge.className += ' bg-gray-100 text-gray-800';
            badge.textContent = status.charAt(0).toUpperCase() + status.slice(1);
        }
    }

    function fetchStatus(){
        fetch('/restore/status/' + jobId + '?token=' + encodeURIComponent(token), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            updateStatusBadge(data.status || 'unknown');
            document.getElementById('restore_path').textContent = data.restore_path || '—';
            document.getElementById('log').textContent = data.log || 'Nog geen output - wachten op start van de taak...';

            // Update status messages
            const pendingMsg = document.getElementById('pending-message');
            const runningMsg = document.getElementById('running-message');
            
            if (pendingMsg) {
                pendingMsg.style.display = (data.status === 'pending') ? 'block' : 'none';
            }
            if (runningMsg) {
                runningMsg.style.display = (data.status === 'running') ? 'block' : 'none';
            }

            if (data.status === 'running' || data.status === 'pending') {
                setTimeout(fetchStatus, 3000);
            }
        })
        .catch(err => console.error('Status fetch error', err));
    }

    // start polling
    fetchStatus();
})();
</script>
</body>
</html>
