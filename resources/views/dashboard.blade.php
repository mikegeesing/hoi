<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Borg Restore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <nav class="gradient-bg text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">📊 Dashboard</h1>
            <div class="flex items-center gap-4">
                <span>{{ auth()->user()?->name ?? 'Guest' }}</span>
                @if(auth()->check())
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded">Uitloggen</button>
                    </form>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if(!auth()->check())
            <!-- Not authenticated - show redirect message -->
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <h2 class="text-2xl font-bold mb-4">Login vereist</h2>
                <p class="text-gray-600 mb-6">U moet ingelogd zijn om het dashboard te zien.</p>
                <a href="{{ route('login') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">Ga naar login</a>
            </div>
        @else
            <!-- Authenticated - show calendar and quick links -->
            <div>
                <h2 class="text-xl font-semibold mb-6">👋 Welkom, {{ auth()->user()->name }}!</h2>

                <!-- Quick Links -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                        <h3 class="font-bold text-lg mb-2">🔐 Restore Portal</h3>
                        <p class="text-gray-600 text-sm mb-4">Open de token-gedreven restore portal.</p>
                        <a href="/restore" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Open</a>
                    </div>

                    @if(auth()->user() && auth()->user()->role === 'admin')
                        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                            <h3 class="font-bold text-lg mb-2">🗝️ Tokens Beheren</h3>
                            <p class="text-gray-600 text-sm mb-4">Maak of beheer tokens voor klanten.</p>
                            <a href="/admin/tokens" class="inline-block bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-900">Beheren</a>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                            <h3 class="font-bold text-lg mb-2">📋 Activiteiten</h3>
                            <p class="text-gray-600 text-sm mb-4">Bekijk alle gebruikersactiviteiten.</p>
                            <a href="/admin/activity" class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Bekijken</a>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                            <h3 class="font-bold text-lg mb-2">⚙️ Profiel</h3>
                            <p class="text-gray-600 text-sm mb-4">Wijzig uw profiel instellingen.</p>
                            <a href="/admin/profile" class="inline-block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Instellingen</a>
                        </div>
                    @else
                        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                            <h3 class="font-bold text-lg mb-2">⚙️ Profiel</h3>
                            <p class="text-gray-600 text-sm mb-4">Wijzig uw profiel instellingen.</p>
                            <a href="/profile" class="inline-block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Instellingen</a>
                        </div>
                    @endif
                </div>

                <!-- Calendar Section -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-semibold mb-4">📅 Beschikbare Snapshots</h3>
                    
                    @if(empty($events) || count($events) === 0)
                        <div class="bg-yellow-50 border border-yellow-200 rounded p-4 text-yellow-800">
                            ℹ️ Geen snapshots beschikbaar op dit moment.
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($events as $event)
                                <div class="p-4 border border-blue-200 rounded-lg bg-blue-50 hover:bg-blue-100 transition">
                                    <div class="font-semibold text-blue-900 truncate">{{ $event['archive'] }}</div>
                                    <div class="text-sm text-blue-700 mt-1">📅 {{ $event['day'] ?? 'N/A' }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Recent Jobs Section (Admin Only) -->
                @if(auth()->user() && auth()->user()->role === 'admin')
                    <div class="bg-white rounded-lg shadow p-6 mt-8">
                        <h3 class="text-xl font-semibold mb-4">📋 Recente Restore Jobs</h3>
                        
                        @php
                            $recent = \App\Models\RestoreJob::orderByDesc('created_at')->limit(8)->get();
                        @endphp

                        @if($recent->isEmpty())
                            <div class="bg-gray-50 border border-gray-200 rounded p-4 text-gray-600">
                                Geen recent jobs.
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm">
                                    <thead class="bg-gray-100 border-b">
                                        <tr>
                                            <th class="px-4 py-2">ID</th>
                                            <th class="px-4 py-2">Archive</th>
                                            <th class="px-4 py-2">Type</th>
                                            <th class="px-4 py-2">Status</th>
                                            <th class="px-4 py-2">Gebruiker</th>
                                            <th class="px-4 py-2">Aangemaakt</th>
                                            <th class="px-4 py-2"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($recent as $r)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="px-4 py-2">#{{ $r->id }}</td>
                                            <td class="px-4 py-2 font-medium">{{ $r->archive_name }}</td>
                                            <td class="px-4 py-2">
                                                @if($r->restore_type === 'mysql')
                                                    <span class="bg-amber-100 text-amber-800 px-2 py-1 rounded text-xs">🗄️ Database</span>
                                                @else
                                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">📁 Bestanden</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2">
                                                @if($r->status === 'completed')
                                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">✓ Voltooid</span>
                                                @elseif($r->status === 'failed')
                                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">✗ Mislukt</span>
                                                @else
                                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">⏳ {{ ucfirst($r->status) }}</span>
                                                @endif
                                            </td>                                            <td class=\"px-4 py-2\">
                                                @if($r->user)
                                                    {{ $r->user->name }}
                                                @else
                                                    <span class=\"text-gray-400\">-</span>
                                                @endif
                                            </td>                                            <td class="px-4 py-2">{{ $r->created_at->diffForHumans() }}</td>
                                            <td class="px-4 py-2"><a href="/admin/restore/jobs/{{ $r->id }}" class="text-blue-600 hover:underline">Bekijk</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 text-center py-4 mt-12">
        <p>Borg Restore Portal &copy; {{ date('Y') }} - Online Hoster</p>
    </footer>
</body>
</html>
