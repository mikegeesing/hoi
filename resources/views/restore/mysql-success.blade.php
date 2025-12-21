<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Database hersteld</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Success Header -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-12 text-center">
            <svg class="w-16 h-16 mx-auto mb-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h1 class="text-4xl font-bold text-white mb-2">Database succesvol hersteld!</h1>
            <p class="text-green-100 text-lg">De database restore is voltooid</p>
        </div>

        <!-- Details -->
        <div class="px-6 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Database Info -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="text-xs uppercase tracking-wider text-gray-500 mb-2">Database</div>
                    <div class="font-mono text-sm text-gray-900 break-all">{{ $database }}</div>
                </div>

                <!-- Archive Info -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="text-xs uppercase tracking-wider text-gray-500 mb-2">Backup archief</div>
                    <div class="font-mono text-sm text-gray-900 break-all">{{ $archive }}</div>
                </div>

                <!-- Restore Type -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="text-xs uppercase tracking-wider text-gray-500 mb-2">Restore type</div>
                    <div class="text-sm text-gray-900">
                        @if($restoreType === 'full')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                Volledige database
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                Selectieve tabellen
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Timestamp -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="text-xs uppercase tracking-wider text-gray-500 mb-2">Hersteld op</div>
                    <div class="text-sm text-gray-900">{{ now()->format('d-m-Y H:i:s') }}</div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 flex-col sm:flex-row">
                <a href="/restore" class="flex-1 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg text-center transition-colors">
                    ← Terug naar restore
                </a>
                <a href="/restore/mysql" class="flex-1 inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg text-center transition-colors">
                    Nog een database herstellen
                </a>
            </div>

            <!-- Info Message -->
            <div class="mt-8 bg-blue-50 border-l-4 border-blue-400 rounded-r-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            De database is met succes hersteld en klaar voor gebruik. Zorg ervoor dat alle applicaties hun databaseverbinding hebben herstart.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
