<h1>Borg Restore Portal</h1>

<p>
    <strong>Pad:</strong> {{ $path }} |
    <strong>Items:</strong> {{ count($files) }}
</p>

@if(count($files) === 0)
    <p>Geen bestanden gevonden.</p>
@else
<table>
<thead>
<tr>
    <th>Naam</th>
    <th>Type</th>
    <th>Grootte</th>
</tr>
</thead>

<tbody>
@foreach($files as $f)
<tr>
    @php
        // Veilige toegang tot alle sleutels
        $fileName = $f['name'] ?? 'N/A'; // Fix voor 'Undefined array key "name"'
        $fileType = $f['type'] ?? '';
        $fileSize = $f['size'] ?? 0;
    @endphp
    <td>
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

    <td>{{ $fileType }}</td>
    <td>{{ number_format($fileSize / 1024, 1) }} KB</td>
</tr>
@endforeach
</tbody>
</table>
@endif
