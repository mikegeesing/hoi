@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">Admin – Restore tokens</h1>

    {{-- Nieuw token --}}
    <div class="bg-white p-6 rounded shadow mb-8">
        <form method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input
                    name="borg_user"
                    placeholder="Borg user (bv: onlineh)"
                    class="border p-2 rounded"
                    required
                >

                <input
                    name="expires_in_hours"
                    type="number"
                    placeholder="Verloopt (uren)"
                    class="border p-2 rounded"
                    required
                >

                <input
                    name="max_uses"
                    type="number"
                    placeholder="Max uses"
                    class="border p-2 rounded"
                    required
                >

                <button class="bg-blue-600 text-white rounded px-4 py-2">
                    Maak token
                </button>
            </div>
        </form>

        @if(session('new_token'))
            <div class="mt-4 p-3 bg-green-100 rounded break-all">
                <strong>Nieuwe token (kopieer nu):</strong><br>
                {{ session('new_token') }}
            </div>
        @endif

        @if(session('status'))
            <div class="mt-4 p-3 bg-blue-100 rounded">
                {{ session('status') }}
            </div>
        @endif
    </div>

    {{-- Tokens tabel --}}
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Borg user</th>
                    <th class="p-3">Token</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Gebruik</th>
                    <th class="p-3">Verloopt</th>
                    <th class="p-3"></th>
                </tr>
            </thead>
            <tbody>
            @forelse($tokens as $t)
                @php
                    $status = 'Actief';
                    if ($t->expires_at->isPast()) $status = 'Verlopen';
                    if ($t->used >= $t->max_uses) $status = 'Opgebruikt';
                @endphp
                <tr class="border-t">
                    <td class="p-3">{{ $t->borg_user }}</td>
                    <td class="p-3 break-all">
                        @if($t->plain_token)
                            <code class="text-sm bg-gray-100 p-1 rounded">{{ $t->plain_token }}</code>
                        @else
                            <span class="text-gray-400">—</span>
                            <div class="text-xs text-gray-500">(oude token; klik Regenerate om nieuw token te maken)</div>
                        @endif
                    </td>
                    <td class="p-3">{{ $status }}</td>
                    <td class="p-3">{{ $t->used }} / {{ $t->max_uses }}</td>
                    <td class="p-3">{{ $t->expires_at->format('d-m-Y H:i') }}</td>
                    <td class="p-3 text-right space-x-2">
                        <form class="inline" method="POST" action="/admin/tokens/{{ $t->id }}/regenerate">
                            @csrf
                            <button class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">Regenerate</button>
                        </form>

                        <form class="inline" method="POST" action="/admin/tokens/{{ $t->id }}/revoke">
                            @csrf
                            <button class="ml-2 bg-red-600 text-white px-3 py-1 rounded text-sm">Intrekken</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">
                        Nog geen tokens aangemaakt
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
