<div class="max-w-5xl mx-auto px-4">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold">Restore browser</h1>
            <div class="text-sm text-gray-600">Pad: <span class="font-medium">{{ $path }}</span> — Items: {{ count($files) }}</div>
        </div>
        <div>
            <button id="openCalendarBtn" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded">Open kalender voor selectie</button>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="p-4 border-b">
            <h2 class="font-semibold">Bestanden en mappen</h2>
        </div>

@if(count($files) === 0)
    <div class="p-6">Geen bestanden gevonden.</div>
@else
    <div class="p-4 overflow-auto">
        <table class="min-w-full text-sm">
            <thead>
            <tr class="text-left text-xs text-gray-500 uppercase">
                <th class="py-2">Select</th>
                <th class="py-2">Naam</th>
                <th class="py-2">Actie</th>
                <th class="py-2">Type</th>
                <th class="py-2">Grootte</th>
            </tr>
            </thead>
            <tbody>
            @foreach($files as $f)
            <tr class="border-t">
    @php
        // Veilige toegang tot alle sleutels
        $fileName = $f['name'] ?? 'N/A'; // Fix voor 'Undefined array key "name"'
        $fileType = $f['type'] ?? '';
        $fileSize = $f['size'] ?? 0;
    @endphp
    <td class="py-3" style="width:40px">
        <input type="checkbox" class="select-file" value="{{ $f['path'] }}">
    </td>
    <td class="py-3">
        @if($fileType === 'dir')
        <a href="{{ route('restore.files', [
            'archive' => $archive, // Gebruik de variabele, niet de string
            'token' => $token,
            'path' => $f['path']
        ]) }}">
            📁 {{ $fileName }}
        </a>
        @else
            📄 {{ $fileName }}
        @endif
    </td>

    <td class="py-3">
        <a class="inline-flex items-center px-3 py-1 bg-blue-600 text-white rounded" href="/restore/calendar?token={{ urlencode($token) }}&archive={{ urlencode($archive) }}&path={{ urlencode($f['path']) }}">Restore</a>
    </td>

    <td class="py-3 text-gray-600">{{ $fileType }}</td>
    <td class="py-3 text-gray-600">{{ number_format($fileSize / 1024, 1) }} KB</td>
</tr>
@endforeach
            </tbody>
        </table>
    </div>
@endif

<script>
document.getElementById('openCalendarBtn').addEventListener('click', function(){
    const checks = Array.from(document.querySelectorAll('.select-file:checked'))
        .map(n => n.value);

    if (checks.length === 0) {
        alert('Selecteer eerst één of meer bestanden/mappen');
        return;
    }

    const token = encodeURIComponent('{{ $token }}');
    const archive = encodeURIComponent('{{ $archive }}');
    const files = encodeURIComponent(JSON.stringify(checks));

    // graceful url + nice message
    window.location.href = '/restore/calendar?token=' + token + '&archive=' + archive + '&files=' + files;
});
</script>
