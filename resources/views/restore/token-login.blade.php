<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restore Portal - Online Hoster</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .navbar-bg { background-color: #1a1a1a; }
        .btn-green { background-color: #22c55e; }
        .btn-green:hover { background-color: #16a34a; }
        .logo-circle { background-color: #22c55e; }
    </style>
</head>
<body class="font-sans antialiased text-gray-900">
    <!-- Navigation -->
    <nav class="bg-white text-gray-900 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <a href="/" class="flex items-center space-x-3">
                    <div class="logo-circle w-10 h-10 rounded-full flex items-center justify-center font-bold text-white">
                        O
                    </div>
                    <span class="text-xl font-bold hidden sm:inline text-gray-900">Online Hoster</span>
                </a>
                <a href="/" class="btn-green text-white px-6 py-2 rounded font-semibold hover:shadow-lg transition">
                    Inloggen
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Left Column - Content -->
                <div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6">
                        Backup Restore Portal
                    </h1>
                    <p class="text-lg text-gray-600 mb-8">
                        Herstel uw gegevens snel en eenvoudig met uw restore token.
                    </p>

                    <!-- Benefits -->
                    <ul class="space-y-4 mb-12">
                        <li class="flex items-start">
                            <span class="text-green-500 font-bold mr-3 text-xl">✓</span>
                            <span class="text-gray-700"><strong>Veilig:</strong> Versleutelde restore processen</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 font-bold mr-3 text-xl">✓</span>
                            <span class="text-gray-700"><strong>Snel:</strong> Directe terugzet van uw bestanden</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 font-bold mr-3 text-xl">✓</span>
                            <span class="text-gray-700"><strong>Flexibel:</strong> Selectieve bestandsherstel</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 font-bold mr-3 text-xl">✓</span>
                            <span class="text-gray-700"><strong>Databases:</strong> MySQL databases herstellen</span>
                        </li>
                    </ul>

                    <!-- Token Form -->
                    <div class="bg-white rounded-lg shadow-lg p-8 border-l-4 border-green-500">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Restore Token</h2>
                        
                        @if(session('error'))
                            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="GET" action="{{ route('restore.archives') }}" class="space-y-6">
                            <div>
                                <label for="token" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Voer uw restore token in
                                </label>
                                <input 
                                    type="text" 
                                    name="token" 
                                    id="token" 
                                    required
                                    placeholder="Plak hier uw token..."
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 font-mono text-sm"
                                    autofocus
                                >
                                <p class="mt-2 text-sm text-gray-600">
                                    U heeft deze token ontvangen per e-mail van Online Hoster.
                                </p>
                            </div>

                            <button 
                                type="submit"
                                class="w-full btn-green text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 shadow-lg hover:shadow-xl"
                            >
                                → Toegang tot Restore Portal
                            </button>
                        </form>

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <p class="text-xs text-gray-500">
                                <strong>Heeft u geen token ontvangen?</strong><br>
                                Neem contact op met <a href="mailto:support@onlinehoster.nl" class="text-green-600 hover:underline">Support@onlinehoster.nl</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Illustration -->
                <div class="hidden md:block">
                    <div class="bg-white rounded-lg shadow-xl p-12 text-center">
                        <div class="inline-block">
                            <svg class="w-48 h-48 text-green-500 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3v-5" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Cloud Backup & Restore</h3>
                        <p class="text-gray-600">Uw gegevens veilig bewaard in de cloud</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <p class="font-semibold text-white">Online Hoster - Backup Restore Portal</p>
                <p class="text-sm text-gray-400 mt-2">&copy; {{ date('Y') }} Alle rechten voorbehouden.</p>
            </div>
        </div>
    </footer>
</body>
</html>
