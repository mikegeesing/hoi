<h1>Borg Restore Portal</h1>

<p>
    <strong>Pad:</strong> {{ $path }} |
    <strong>Items:</strong> {{ count($files) }}
</p>

<p>
    <button id="openCalendarBtn" class="btn">Open kalender voor selectie</button>
</p>

@if(count($files) === 0)
    <p>Geen bestanden gevonden.</p>
@else
<table>
<thead>
<tr>
    <th>Naam</th>
    <th>Actie</th>
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
    <td style="width:40px">
        <input type="checkbox" class="select-file" value="{{ $f['path'] }}">
    </td>
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

    <td>
        <a class="btn" href="/restore/calendar?token={{ urlencode($token) }}&archive={{ urlencode($archive) }}&path={{ urlencode($f['path']) }}">
            Restore
        </a>
    </td>

    <td>{{ $fileType }}</td>
    <td>{{ number_format($fileSize / 1024, 1) }} KB</td>
</tr>
@endforeach
</tbody>
</table>
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

    window.location.href = '/restore/calendar?token=' + token + '&archive=' + archive + '&files=' + files;
});
</script>
