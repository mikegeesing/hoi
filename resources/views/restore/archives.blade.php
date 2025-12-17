<div class="max-w-5xl mx-auto px-4">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Borg Restore Portal</h1>
        <div class="text-sm text-gray-600">Token: <code class="bg-gray-100 px-2 py-1 rounded">••••••••••</code></div>
    </div>

    <div class="grid gap-6">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 border-b">
                <h2 class="font-semibold">Beschikbare archieven</h2>
            </div>

            <div class="p-4">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs text-gray-500 uppercase">
                            <th class="py-2">Naam</th>
                            <th class="py-2">Type</th>
                            <th class="py-2">Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($archives as $a)
                        @php
                            $detectedType = $a['detected_type'] ?? 'Unknown';
                        @endphp
                        <tr class="border-t">
                            <td class="py-3">{{ $a['name'] }}</td>
                            <td class="py-3 text-gray-600">
                                @if ($detectedType === 'DB')
                                    <span class="inline-flex items-center gap-2">🛢️ Database</span>
                                @elseif ($detectedType === 'Files')
                                    <span class="inline-flex items-center gap-2">📁 Bestanden</span>
                                @elseif ($detectedType === 'Full')
                                    <span class="inline-flex items-center gap-2">💾 Volledig</span>
                                @else
                                    <span class="inline-flex items-center gap-2">❓ Onbekend</span>
                                @endif
                            </td>
                            <td class="py-3">
                                <a class="inline-flex items-center px-3 py-1 bg-blue-600 text-white rounded" href="{{ route('restore.files', ['archive' => $a['name'], 'token' => $token]) }}">Bekijk</a>
                                <a class="ml-2 inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 rounded" href="{{ route('restore.calendar') }}?token={{ urlencode($token) }}&archive={{ urlencode($a['name']) }}">Kalender</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
