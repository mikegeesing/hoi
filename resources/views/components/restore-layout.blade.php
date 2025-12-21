<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Restore Portal') }} - Online Hoster</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .navbar-bg { background-color: #ffffff; border-bottom: 1px solid #e5e7eb; }
        .btn-green { background-color: #22c55e; }
        .btn-green:hover { background-color: #16a34a; }
    </style>
    <!-- Alpine.js for interactions -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    {{ $head ?? '' }}
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">
    <!-- Navigation -->
    <nav class="navbar-bg text-gray-900 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="/" class="flex items-center gap-3">
                        <!-- Logo -->
                        <img src="https://onlinehoster.nl/assets/images/logo.png" alt="Online Hoster Logo" class="h-10">
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    @if(isset($token))
                        <div class="hidden md:flex flex-col items-end text-right">
                            <span class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Token</span>
                            <span class="text-sm font-mono text-green-600">{{ substr($token, 0, 8) }}...</span>
                        </div>
                    @endif
                    <div class="flex items-center gap-3">
                        @auth
                            <div class="hidden md:flex flex-col items-end">
                                <span class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Ingelogd</span>
                                <span class="text-sm font-medium text-gray-900">{{ auth()->user()->name ?? auth()->user()->email }}</span>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn-green text-white px-4 py-2 rounded font-semibold text-sm hover:shadow-lg transition">
                                    Uitloggen
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn-green text-white px-4 py-2 rounded font-semibold text-sm hover:shadow-lg transition">
                                Inloggen
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
            </div>
        </nav>

        <main class="flex-1 py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-300 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="text-center">
                    <p class="font-semibold text-white">Online Hoster - Backup Restore Portal</p>
                    <p class="text-sm text-gray-400 mt-2">&copy; {{ date('Y') }} Alle rechten voorbehouden.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>