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
<div class="card">
    <h1>Herstel job #{{ $job->id }}</h1>
    <p>Status: <strong id="status">{{ $job->status }}</strong></p>
    <p>Restore path: <span id="restore_path">{{ $job->restore_path ?? '—' }}</span></p>

    <h3>Log</h3>
    <pre id="log">{{ $job->log_output ?? 'Nog geen output' }}</pre>

    <p>
        <a href="/restore?token={{ urlencode($token) }}">Terug</a>
    </p>
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
            document.getElementById('log').textContent = data.log || '';

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
