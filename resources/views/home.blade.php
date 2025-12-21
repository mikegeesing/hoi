<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup Restore Portal - Online Hoster</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .navbar-bg { background-color: #1a1a1a; }
        .btn-green { background-color: #22c55e; }
        .btn-green:hover { background-color: #16a34a; }
        .hero-gradient { background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%); }
    </style>
</head>
<body class="font-sans antialiased text-gray-900">
    <!-- Navigation -->
    <nav class="bg-white text-gray-900 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <a href="/" class="flex items-center space-x-3">
                    <img src="https://onlinehoster.nl/assets/images/logo.png" alt="Online Hoster Logo" class="h-8">
                </a>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-green-600 transition">Inloggen</a>
                    <a href="/restore" class="btn-green text-white px-6 py-2 rounded font-semibold hover:shadow-lg transition">
                        Restore Portal
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-gradient text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-5xl sm:text-6xl font-bold mb-6">
                        Backup Restore Portal
                    </h1>
                    <p class="text-xl text-green-50 mb-8 leading-relaxed">
                        Herstel uw data snel, veilig en eenvoudig. Met uw persoonlijke restore-token kunt u zelf bepalen wat u wilt herstellen.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/restore" class="inline-block bg-white text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-green-50 transition text-center">
                            → Restore Portal Openen
                        </a>
                        <a href="{{ route('login') }}" class="inline-block bg-green-700 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-800 transition text-center">
                            Dashboard
                        </a>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white/10 backdrop-blur rounded-lg p-12 text-center">
                        <svg class="w-32 h-32 mx-auto text-white opacity-80 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3v-5" />
                        </svg>
                        <h3 class="text-2xl font-bold mb-2">Veilige Backups</h3>
                        <p class="text-green-50">Uw gegevens zijn altijd beschermd</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Mogelijkheden</h2>
                <p class="text-xl text-gray-600">Alles wat u nodig heeft om uw data terug te zetten</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Bestanden & Mappen</h3>
                    <p class="text-gray-600 mb-4">
                        Blader door uw backups en herstel selectief bestanden of complete mappen. Eenvoudig en controleerbaar.
                    </p>
                    <a href="/restore" class="text-green-600 font-semibold hover:text-green-700">Meer info →</a>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">MySQL Databases</h3>
                    <p class="text-gray-600 mb-4">
                        Selecteer tabellen of volledige databases. U ziet eerst een duidelijk overzicht voordat u bevestigt.
                    </p>
                    <a href="/restore" class="text-green-600 font-semibold hover:text-green-700">Meer info →</a>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.658 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Website Herstel</h3>
                    <p class="text-gray-600 mb-4">
                        Herstel een volledige website naar een snapshot. Ideaal na fouten of ongewenste wijzigingen.
                    </p>
                    <a href="/restore" class="text-green-600 font-semibold hover:text-green-700">Meer info →</a>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">Klaar om uw data terug te zetten?</h2>
            <p class="text-xl text-gray-600 mb-8">
                Gebruik uw restore token om in enkele minuten uw gegevens terug te halen.
            </p>
            <a href="/restore" class="inline-block btn-green text-white px-10 py-4 rounded-lg font-bold text-lg hover:shadow-lg transition">
                → Open Restore Portal
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-white font-bold mb-4">Online Hoster</h3>
                    <p class="text-sm">Betrouwbare hosting & backup oplossingen voor alle bedrijven.</p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Producten</h4>
                    <ul class="text-sm space-y-2">
                        <li><a href="/" class="hover:text-green-400">Webhosting</a></li>
                        <li><a href="/" class="hover:text-green-400">VPS Servers</a></li>
                        <li><a href="/" class="hover:text-green-400">Dedicated</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Support</h4>
                    <ul class="text-sm space-y-2">
                        <li><a href="mailto:support@onlinehoster.nl" class="hover:text-green-400">E-mail Support</a></li>
                        <li><a href="/" class="hover:text-green-400">Kennisbank</a></li>
                        <li><a href="/" class="hover:text-green-400">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Contact</h4>
                    <p class="text-sm">
                        <strong>E-mail:</strong><br>
                        <a href="mailto:support@onlinehoster.nl" class="hover:text-green-400">Support@onlinehoster.nl</a>
                    </p>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-sm">
                <p>&copy; {{ date('Y') }} Online Hoster. Alle rechten voorbehouden.</p>
            </div>
        </div>
    </footer>
</body>
</html>
                        <h3>Inloggen voor dashboard</h3>
                        <p>Toegang tot het admin dashboard voor tokenbeheer en monitoring.
                        </p>
                        <div class="links" style="margin-top:12px;">
                            <a href="{{ route('login') }}" class="btn btn-primary">Inloggen</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <p class="footer">
            Registratie is uitgeschakeld. Accounts worden alleen door de administratie aangemaakt.
        </p>
    </div>
</body>
</html>
