@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">

    <h1 class="text-3xl font-extrabold mb-8 text-gray-800 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 10c-4.418 0-8-1.79-8-4V7a2 2 0 012-2h2m12 0a2 2 0 012 2v7c0 2.21-3.582 4-8 4z" /></svg>
        Admin <span class="font-light">– Restore tokens</span>
    </h1>

    {{-- Nieuw token --}}
    <div class="bg-white p-8 rounded-xl shadow mb-10 border border-gray-200">
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

                <button class="bg-blue-600 hover:bg-blue-700 transition text-white rounded px-4 py-2 font-semibold shadow">
                    Maak token
                </button>
            </div>
        </form>

        @if(session('new_token'))
            <div class="mt-4 p-3 bg-green-100 border border-green-300 rounded break-all">
                <strong>Nieuwe token (kopieer nu):</strong><br>
                <span class="font-mono text-lg">{{ session('new_token') }}</span>
            </div>
        @endif

        @if(session('status'))
            <div class="mt-4 p-3 bg-blue-100 border border-blue-300 rounded">
                {{ session('status') }}
            </div>
        @endif
    </div>

    {{-- Tokens tabel --}}
    <div class="bg-white rounded-xl shadow border border-gray-200 overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
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
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="p-3 font-semibold text-gray-700">{{ $t->borg_user }}</td>
                    <td class="p-3 break-all">
                        @if($t->plain_token)
                            <span class="inline-flex items-center gap-2">
                                <code class="text-sm bg-gray-100 p-1 rounded font-mono select-all">{{ $t->plain_token }}</code>
                                <button onclick="navigator.clipboard.writeText('{{ $t->plain_token }}')" class="ml-1 text-xs px-2 py-1 bg-gray-200 hover:bg-gray-300 rounded border border-gray-300">Kopieer</button>
                            </span>
                        @elseif(auth()->check() && auth()->user()->is_admin && $t->token_encrypted)
                            <span class="inline-flex items-center gap-2">
                                <code class="text-sm bg-gray-100 p-1 rounded font-mono select-all">{{ Crypt::decryptString($t->token_encrypted) }}</code>
                                <button onclick="navigator.clipboard.writeText('{{ Crypt::decryptString($t->token_encrypted) }}')" class="ml-1 text-xs px-2 py-1 bg-gray-200 hover:bg-gray-300 rounded border border-gray-300">Kopieer</button>
                            </span>
                        @else
                            <span class="text-gray-400">—</span>
                            <div class="text-xs text-gray-500">(oude token; klik Regenerate om nieuw token te maken)</div>
                        @endif
                    </td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded text-xs font-bold
                            {{ $status === 'Actief' ? 'bg-green-100 text-green-800' : ($status === 'Verlopen' ? 'bg-gray-200 text-gray-500' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ $status }}
                        </span>
                    </td>
                    <td class="p-3">{{ $t->used }} / {{ $t->max_uses }}</td>
                    <td class="p-3">{{ $t->expires_at->format('d-m-Y H:i') }}</td>
                    <td class="p-3 text-right space-x-2">
                        <form class="inline" method="POST" action="/admin/tokens/{{ $t->id }}/regenerate">
                            @csrf
                            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm font-semibold shadow">Regenerate</button>
                        </form>

                        <form class="inline" method="POST" action="/admin/tokens/{{ $t->id }}/revoke">
                            @csrf
                            <button class="ml-2 bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm font-semibold shadow">Intrekken</button>
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
