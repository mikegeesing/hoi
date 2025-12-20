<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Restore status</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; padding: 24px; }
        .card { background:#fff; padding:16px; border-radius:8px; box-shadow:0 6px 20px rgba(0,0,0,0.06); }
        pre { background:#0f172a; color:#e6eef8; padding:12px; border-radius:6px; overflow:auto; }
    </style>
</head>
<body>
<div class="max-w-3xl mx-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-bold">Herstel job #{{ $job->id }}</h1>
                <div class="text-sm text-gray-600">Aangemaakt: {{ $job->created_at->diffForHumans() }}</div>
            </div>
            <div class="text-right">
                <div class="text-sm text-gray-500">Status</div>
                <div class="mt-1 font-semibold" id="status">{{ $job->status }}</div>
            </div>
        </div>

        <div class="mt-4">
            <div class="text-sm text-gray-600">Restore path</div>
            <div class="font-mono mt-1 text-sm" id="restore_path">{{ $job->restore_path ?? '—' }}</div>
        </div>

        <!-- Wacht bericht voor pending jobs -->
        @if($job->status === 'pending')
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4" id="pending-message">
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
            <div class="mt-6 bg-green-50 border border-green-200 rounded-lg p-4" id="running-message">
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

        <h3 class="mt-6 mb-2 text-sm font-semibold">Log</h3>
        <pre id="log" class="bg-gray-900 text-white p-3 rounded h-56 overflow-auto">{{ $job->log_output ?? 'Nog geen output - wachten op start van de taak...' }}</pre>

        <div class="mt-4">
            <a class="text-blue-600" href="/restore?token={{ urlencode($token) }}">Terug naar portal</a>
        </div>
    </div>
</div>

<script>
(function(){
    const jobId = {{ $job->id }};
    const token = "{{ $token }}";

    function fetchStatus(){
        fetch('/restore/status/' + jobId + '?token=' + encodeURIComponent(token), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('status').textContent = data.status || '—';
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
