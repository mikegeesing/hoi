<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restore Fout - Online Hoster</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .navbar-bg { background-color: #ffffff; border-bottom: 1px solid #e5e7eb; }
        .btn-green { background-color: #22c55e; }
        .btn-green:hover { background-color: #16a34a; }
    </style>
</head>
<body class="font-sans antialiased text-gray-900">
    <!-- Navigation -->
    <nav class="navbar-bg text-gray-900 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <a href="/" class="flex items-center space-x-3">
                    <img src="https://onlinehoster.nl/assets/images/logo.png" alt="Online Hoster Logo" class="h-10">
                </a>
                <div class="flex items-center space-x-4">
                    <a href="/restore" class="btn-green text-white px-6 py-2 rounded font-semibold hover:shadow-lg transition">
                        Restore Portal
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-12 px-4">
        <div class="max-w-2xl mx-auto">
            <!-- Error Card -->
            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <!-- Error Header -->
                <div class="bg-red-50 border-b-4 border-red-500 px-6 py-8">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <svg class="h-12 w-12 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0-10.5a8.5 8.5 0 1 1 0 17 8.5 8.5 0 0 1 0-17zm0 13a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Restore Niet Mogelijk</h1>
                            <p class="text-gray-600 mt-1">Er is een probleem met je restore aanvraag</p>
                        </div>
                    </div>
                </div>

                <!-- Error Message -->
                <div class="px-6 py-8">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-6">
                        <p class="text-red-800 font-semibold text-lg">{{ $error }}</p>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                        <h3 class="text-blue-900 font-semibold mb-2">Wat is het probleem?</h3>
                        <p class="text-blue-800 text-sm mb-3">
                            Je backup kan alleen worden hersteld naar de originele database. Dit is een beveiligingsmaatregel 
                            om ervoor te zorgen dat je niet per ongeluk tabellen van iemand anders overschrijft.
                        </p>
                        <p class="text-blue-800 text-sm">
                            Als je je database wilt herstellen, zorg ervoor dat je de juiste database selecteert in de vorige stap.
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="bg-gray-50 px-6 py-6 border-t flex space-x-4">
                    <button onclick="history.back()" class="flex-1 inline-flex justify-center items-center px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Terug
                    </button>
                    <a href="{{ route('restore.archives', ['token' => request('token')]) }}" class="flex-1 inline-flex justify-center items-center px-6 py-3 btn-green text-white font-semibold rounded-lg hover:shadow-lg transition">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12a9 9 0 009-9 9.75 9.75 0 016.74 2.74L21 8" />
                        </svg>
                        Naar Backups
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <p class="font-semibold text-white mb-2">Online Hoster - Backup Restore Portal</p>
                    <p class="text-sm">Veilig en gemakkelijk je backups terugzetten</p>
                </div>
                <div>
                    <p class="font-semibold text-white mb-3">Contactgegevens</p>
                    <p class="text-sm">Sales: <a href="mailto:Sales@onlinehoster.nl" class="text-green-400 hover:text-green-300">Sales@onlinehoster.nl</a></p>
                    <p class="text-sm">Support: <a href="mailto:Support@onlinehoster.nl" class="text-green-400 hover:text-green-300">Support@onlinehoster.nl</a></p>
                </div>
                <div>
                    <p class="font-semibold text-white mb-3">Informatie</p>
                    <p class="text-sm"><a href="https://onlinehoster.nl" class="text-green-400 hover:text-green-300">Naar onlinehoster.nl</a></p>
                </div>
            </div>
            <p class="text-center text-sm border-t border-gray-700 pt-8">Borg Restore Portal &copy; {{ date('Y') }} - Online Hoster</p>
        </div>
    </footer>
</body>
</html>
