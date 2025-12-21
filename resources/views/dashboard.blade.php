<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Online Hoster</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .navbar-bg { background-color: #ffffff; border-bottom: 1px solid #e5e7eb; }
        .btn-green { background-color: #22c55e; }
        .btn-green:hover { background-color: #16a34a; }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">
    <!-- Navigation -->
    <nav class="navbar-bg text-gray-900 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <a href="/" class="flex items-center space-x-3">
                    <img src="https://onlinehoster.nl/assets/images/logo.png" alt="Online Hoster Logo" class="h-10">
                </a>
                <div class="flex items-center space-x-4">
                    <span class="text-sm hidden md:inline">{{ auth()->user()?->name ?? 'Guest' }}</span>
                    @if(auth()->check())
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-green text-white px-6 py-2 rounded font-semibold hover:shadow-lg transition">
                                Uitloggen
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if(!auth()->check())
            <!-- Not authenticated -->
            <div class="bg-white rounded-xl shadow p-12 text-center">
                <h2 class="text-3xl font-bold mb-4 text-gray-900">Login vereist</h2>
                <p class="text-gray-600 mb-8 text-lg">U moet ingelogd zijn om het dashboard te zien.</p>
                <a href="{{ route('login') }}" class="inline-block btn-green text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                    → Ga naar login
                </a>
            </div>
        @else
            <!-- Welcome Section -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">👋 Welkom, {{ auth()->user()->name }}!</h1>
                <p class="text-gray-600">Beheer uw backups en restore jobs op een centraal plek</p>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                <!-- Restore Portal -->
                <div class="bg-white rounded-xl shadow card-hover p-8 border-l-4 border-green-500">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-1">🔐 Restore Portal</h3>
                            <p class="text-gray-600 text-sm">Herstel uw gegevens zelf</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">Open de token-gedreven restore portal om snel en veilig uw bestanden of databases terug te zetten.</p>
                    <a href="/restore" class="inline-block btn-green text-white px-6 py-2 rounded font-semibold hover:shadow-lg transition">
                        Portal Openen →
                    </a>
                </div>

                <!-- Profiel -->
                <div class="bg-white rounded-xl shadow card-hover p-8 border-l-4 border-blue-500">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-1">⚙️ Profiel</h3>
                            <p class="text-gray-600 text-sm">Beheer uw instellingen</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">Wijzig uw profielgegevens, wachtwoord en andere persoonlijke instellingen.</p>
                    <a href="{{ auth()->user()->role === 'admin' ? '/admin/profile' : '/profile' }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded font-semibold hover:bg-blue-700 transition">
                        Instellingen →
                    </a>
                </div>

                @if(auth()->user() && auth()->user()->role === 'admin')
                    <!-- Token Management -->
                    <div class="bg-white rounded-xl shadow card-hover p-8 border-l-4 border-purple-500">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-1">🗝️ Tokens</h3>
                                <p class="text-gray-600 text-sm">Beheer klant tokens</p>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6">Maak nieuwe tokens voor klanten of beheer bestaande tokens.</p>
                        <a href="/admin/tokens" class="inline-block bg-purple-600 text-white px-6 py-2 rounded font-semibold hover:bg-purple-700 transition">
                            Beheren →
                        </a>
                    </div>

                    <!-- Activity Log -->
                    <div class="bg-white rounded-xl shadow card-hover p-8 border-l-4 border-orange-500">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-1">📋 Activiteiten</h3>
                                <p class="text-gray-600 text-sm">Bekijk alle logs</p>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6">Controleer alle gebruikersactiviteiten en restore jobs in het systeem.</p>
                        <a href="/admin/activity" class="inline-block bg-orange-600 text-white px-6 py-2 rounded font-semibold hover:bg-orange-700 transition">
                            Logs →
                        </a>
                    </div>
                @endif
            </div>

            <!-- Calendar Section -->
            @if(!empty($events) && count($events) > 0)
            <div class="bg-white rounded-xl shadow p-8 mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">📅 Beschikbare Snapshots</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($events as $event)
                        <div class="p-4 border-l-4 border-green-500 rounded-lg bg-gradient-to-r from-green-50 to-transparent hover:shadow-md transition">
                            <div class="font-semibold text-gray-900 truncate">{{ $event['archive'] }}</div>
                            <div class="text-sm text-gray-600 mt-1">📅 {{ $event['day'] ?? 'N/A' }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Recent Jobs Section (Admin Only) -->
            @if(auth()->user() && auth()->user()->role === 'admin')
                @php
                    $recent = \App\Models\RestoreJob::orderByDesc('created_at')->limit(10)->get();
                @endphp

                @if($recent->isNotEmpty())
                <div class="bg-white rounded-xl shadow p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">📊 Recente Restore Jobs</h2>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-100 border-b border-gray-200">
                                <tr>
                                    <th class="px-4 py-3 font-semibold text-gray-900">ID</th>
                                    <th class="px-4 py-3 font-semibold text-gray-900">Archive</th>
                                    <th class="px-4 py-3 font-semibold text-gray-900">Type</th>
                                    <th class="px-4 py-3 font-semibold text-gray-900">Status</th>
                                    <th class="px-4 py-3 font-semibold text-gray-900">Gebruiker</th>
                                    <th class="px-4 py-3 font-semibold text-gray-900">Datum</th>
                                    <th class="px-4 py-3 font-semibold text-gray-900">Actie</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent as $r)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 font-mono text-sm text-gray-600">#{{ $r->id }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $r->archive_name }}</td>
                                    <td class="px-4 py-3">
                                        @if($r->restore_type === 'mysql')
                                            <span class="inline-flex items-center rounded-full bg-amber-100 text-amber-800 px-3 py-1 text-xs font-semibold">🗄️ Database</span>
                                        @else
                                            <span class="inline-flex items-center rounded-full bg-blue-100 text-blue-800 px-3 py-1 text-xs font-semibold">📁 Bestanden</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($r->status === 'completed')
                                            <span class="inline-flex items-center rounded-full bg-green-100 text-green-800 px-3 py-1 text-xs font-semibold">✓ Voltooid</span>
                                        @elseif($r->status === 'failed')
                                            <span class="inline-flex items-center rounded-full bg-red-100 text-red-800 px-3 py-1 text-xs font-semibold">✗ Mislukt</span>
                                        @else
                                            <span class="inline-flex items-center rounded-full bg-yellow-100 text-yellow-800 px-3 py-1 text-xs font-semibold">⏳ {{ ucfirst($r->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($r->user)
                                            <span class="text-gray-700">{{ $r->user->name }}</span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $r->created_at->format('d-m-Y H:i') }}</td>
                                    <td class="px-4 py-3">
                                        <a href="/admin/restore/jobs/{{ $r->id }}" class="text-green-600 font-semibold hover:text-green-700">Details →</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            @endif
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <p class="font-semibold text-white">Online Hoster - Backup & Restore Management</p>
                <p class="text-sm text-gray-400 mt-2">&copy; {{ date('Y') }} Alle rechten voorbehouden.</p>
            </div>
        </div>
    </footer>
</body>
</html>
    <footer class="bg-gray-800 text-gray-300 text-center py-4 mt-12">
        <p>Borg Restore Portal &copy; {{ date('Y') }} - Online Hoster</p>
    </footer>
</body>
</html>
