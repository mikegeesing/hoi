<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Online Hoster') }} - Inloggen</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Tailwind -->
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            .navbar-bg { background-color: #ffffff; border-bottom: 1px solid #e5e7eb; }
            .btn-green { background-color: #22c55e; }
            .btn-green:hover { background-color: #16a34a; }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50">
        <!-- Navigation -->
        <nav class="navbar-bg text-gray-900 shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    <a href="/" class="flex items-center space-x-3">
                        <img src="https://onlinehoster.nl/assets/images/logo.png" alt="Online Hoster Logo" class="h-8">
                        <span class="text-xl font-bold hidden sm:inline">Online Hoster</span>
                    </a>
                    <a href="/" class="btn-green text-white px-6 py-2 rounded font-semibold hover:shadow-lg transition">
                        Terug naar home
                    </a>
                </div>
            </div>
        </nav>

        <!-- Login Container -->
        <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="w-full max-w-md">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <img src="https://onlinehoster.nl/assets/images/logo.png" alt="Online Hoster Logo" class="h-16 mx-auto mb-4">
                    <h1 class="text-3xl font-bold text-gray-900">Inloggen</h1>
                    <p class="text-gray-600 mt-2">Online Hoster - Dashboard</p>
                </div>

                <!-- Card -->
                <div class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-green-500">
                    {{ $slot }}
                </div>

                <!-- Footer -->
                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">
                        Geen account? <a href="/" class="text-green-600 font-semibold hover:text-green-700">Ga naar home</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-300 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="text-center">
                    <p class="font-semibold text-white">Online Hoster</p>
                    <p class="text-sm text-gray-400 mt-2">&copy; {{ date('Y') }} Alle rechten voorbehouden.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
