<h1>Borg Restore Portal</h1>

<table border="0" cellpadding="6" cellspacing="0">
    <thead>
        <tr>
            <th>Naam</th>
            <th>Type</th>
            <th>Actie</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($archives as $a)
        @php
            // Veilig de 'detected_type' ophalen.
            // Als de key niet bestaat, wordt 'Unknown' (Onbekend) gebruikt als fallback.
            $detectedType = $a['detected_type'] ?? 'Unknown';
        @endphp
        <tr>
            <td>{{ $a['name'] }}</td>
            <td>
                @if ($detectedType === 'DB')
                    🛢️ Database
                @elseif ($detectedType === 'Files')
                    📁 Bestanden
                @elseif ($detectedType === 'Full')
                    💾 Volledig
                @else
                    ❓ Onbekend
                @endif
            </td>
            <td>
                <a href="{{ route('restore.files', [
                    'archive' => $a['name'],
                    'token' => $token
                ]) }}">
                    Bekijk
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
