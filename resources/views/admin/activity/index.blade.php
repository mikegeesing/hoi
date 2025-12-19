<x-restore-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Activiteiten Log</h1>
            <p class="mt-2 text-sm text-gray-600">
                Bekijk alle gebruikersactiviteiten in het systeem
            </p>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <form method="GET" action="{{ route('admin.activity.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- User Filter -->
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Gebruiker
                        </label>
                        <select name="user_id" id="user_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Alle gebruikers</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Action Filter -->
                    <div>
                        <label for="action" class="block text-sm font-medium text-gray-700 mb-1">
                            Actie
                        </label>
                        <select name="action" id="action" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Alle acties</option>
                            @foreach($actions as $action)
                                <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                                    {{ $action }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- From Date -->
                    <div>
                        <label for="from_date" class="block text-sm font-medium text-gray-700 mb-1">
                            Van datum
                        </label>
                        <input type="date" name="from_date" id="from_date" value="{{ request('from_date') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- To Date -->
                    <div>
                        <label for="to_date" class="block text-sm font-medium text-gray-700 mb-1">
                            Tot datum
                        </label>
                        <input type="date" name="to_date" id="to_date" value="{{ request('to_date') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Filteren
                    </button>
                    <a href="{{ route('admin.activity.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Activity Log Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Datum & Tijd
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Gebruiker
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actie
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Beschrijving
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                IP Adres
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                URL
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($logs as $log)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $log->created_at->format('d-m-Y H:i:s') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if($log->user)
                                        <div>
                                            <div class="font-medium">{{ $log->user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $log->user->email }}</div>
                                        </div>
                                    @else
                                        <span class="text-gray-400">Onbekend</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if($log->action === 'login') bg-green-100 text-green-800
                                        @elseif($log->action === 'logout') bg-red-100 text-red-800
                                        @elseif(str_contains($log->action, 'restore')) bg-blue-100 text-blue-800
                                        @elseif(str_contains($log->action, 'delete') || str_contains($log->action, 'destroy')) bg-red-100 text-red-800
                                        @elseif(str_contains($log->action, 'create') || str_contains($log->action, 'store')) bg-green-100 text-green-800
                                        @elseif(str_contains($log->action, 'update') || str_contains($log->action, 'edit')) bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $log->description ?: '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $log->ip_address }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <div class="max-w-xs truncate" title="{{ $log->url }}">
                                        {{ $log->url }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    Geen activiteiten gevonden
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($logs->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>

        <!-- Statistics -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="text-sm font-medium text-gray-500">Totaal aantal logs</div>
                <div class="mt-2 text-3xl font-bold text-gray-900">{{ $logs->total() }}</div>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="text-sm font-medium text-gray-500">Huidige pagina</div>
                <div class="mt-2 text-3xl font-bold text-gray-900">{{ $logs->currentPage() }} / {{ $logs->lastPage() }}</div>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="text-sm font-medium text-gray-500">Logs per pagina</div>
                <div class="mt-2 text-3xl font-bold text-gray-900">{{ $logs->perPage() }}</div>
            </div>
        </div>
    </div>
</x-restore-layout>
