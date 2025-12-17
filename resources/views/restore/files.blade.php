<div class="min-h-screen bg-gray-50">
    <div class="max-w-6xl mx-auto py-10 px-4">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-extrabold">Restore browser</h1>
                <div class="text-sm text-gray-600">Pad: <span class="font-medium">{{ $path }}</span> — Items: {{ count($files ?? []) }}</div>
            </div>
            <div>
                <button id="openCalendarBtn" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded shadow">Open kalender voor selectie</button>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 border-b">
                <h2 class="font-semibold">Bestanden en mappen</h2>
            </div>

@php $files = $files ?? []; @endphp

@if(count($files) === 0)
    <div class="p-6">
        <div class="text-center py-10">
            <h3 class="text-lg font-semibold">Geen bestanden gevonden</h3>
            <p class="text-sm text-gray-600 mt-2">Er zijn geen bestanden gevonden op het pad <span class="font-medium">{{ $path ?: '/' }}</span> binnen dit archief.</p>
            <div class="mt-4 flex items-center justify-center gap-3">
                <a href="{{ route('restore.files', ['archive' => $archive, 'token' => $token, 'path' => '']) }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded">Bekijk root van archief</a>
                <a href="{{ route('restore.archives') }}?token={{ urlencode($token) }}" class="inline-block bg-gray-200 text-gray-800 px-4 py-2 rounded">Terug naar archieven</a>
            </div>
        </div>
    </div>
@else
    <div class="p-4 overflow-auto">
        <table class="min-w-full text-sm divide-y">
            <thead>
            <tr class="text-left text-xs text-gray-500 uppercase">
                <th class="py-2">Select</th>
                <th class="py-2">Naam</th>
                <th class="py-2">Actie</th>
                <th class="py-2">Type</th>
                <th class="py-2">Grootte</th>
            </tr>
            </thead>
            <tbody class="bg-white">
            @foreach($files as $f)
            @php
                // Veilige toegang tot alle sleutels
                $fileName = $f['name'] ?? 'N/A';
                $fileType = $f['type'] ?? '';
                $fileSize = $f['size'] ?? 0;
                $filePath = $f['path'] ?? ($f['name'] ?? '');
            @endphp
            <tr class="border-t hover:bg-gray-50">
                <td class="py-3 px-2 w-12">
                    <input type="checkbox" class="select-file" value="{{ $filePath }}">
                </td>
                <td class="py-3">
                    @if($fileType === 'dir')
                        <a href="{{ route('restore.files', ['archive' => $archive, 'token' => $token, 'path' => $filePath]) }}" class="text-indigo-700 font-medium">📁 {{ $fileName }}</a>
                    @else
                        <div class="flex items-center gap-2"><span class="text-gray-700">📄</span> <span class="text-gray-800">{{ $fileName }}</span></div>
                    @endif
                </td>
                <td class="py-3">
                    <a class="inline-flex items-center px-3 py-1 bg-blue-600 text-white rounded" href="/restore/calendar?token={{ urlencode($token) }}&archive={{ urlencode($archive) }}&path={{ urlencode($filePath) }}">Restore</a>
                </td>
                <td class="py-3 text-gray-600">{{ $fileType }}</td>
                <td class="py-3 text-gray-600">{{ $fileSize > 0 ? number_format($fileSize / 1024, 1) . ' KB' : '—' }}</td>
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

    const token = encodeURIComponent(@json($token));
    const archive = encodeURIComponent(@json($archive));
    const files = encodeURIComponent(JSON.stringify(checks));

    // graceful url + nice message
    window.location.href = '/restore/calendar?token=' + token + '&archive=' + archive + '&files=' + files;
});
</script>
