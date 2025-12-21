<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' - ' : '' }}Restore Portal - Online Hoster</title>

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
        .navbar-bg { background-color: #1a1a1a; }
        .btn-green { background-color: #22c55e; }
        .btn-green:hover { background-color: #16a34a; }
        .logo-circle { background-color: #22c55e; }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">
    <!-- Navigation -->
    <nav class="navbar-bg text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-3">
                        <div class="logo-circle w-10 h-10 rounded-full flex items-center justify-center font-bold text-white">
                            O
                        </div>
                        <span class="text-xl font-bold hidden sm:inline">Online Hoster</span>
                    </a>
                </div>

                <!-- Menu Items -->
                <div class="hidden md:flex items-center space-x-8 text-sm">
                    <a href="/" class="hover:text-green-400 transition">Home</a>
                    <a href="/" class="hover:text-green-400 transition">Over ons</a>
                    <a href="/" class="hover:text-green-400 transition">Webhosting</a>
                    <a href="/" class="hover:text-green-400 transition">Servers</a>
                </div>

                <!-- Right Menu -->
                <div class="flex items-center space-x-4">
                    @if(isset($token))
                        <div class="text-xs sm:text-sm text-gray-300 hidden sm:block">
                            Token: <span class="font-mono text-green-400">{{ substr($token, 0, 8) }}...</span>
                        </div>
                    @endif
                    @if(auth()->check())
                        <span class="text-sm hidden sm:inline">{{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-green text-white px-4 sm:px-6 py-2 rounded font-semibold text-sm hover:shadow-lg transition">
                                Uitloggen
                            </button>
                        </form>
                    @else
                        <a href="/login" class="btn-green text-white px-4 sm:px-6 py-2 rounded font-semibold text-sm hover:shadow-lg transition">
                            Inloggen
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <p class="font-semibold text-white mb-2">Online Hoster - Backup Restore Portal</p>
                <p class="text-sm text-gray-400 mb-4">&copy; {{ date('Y') }} Alle rechten voorbehouden.</p>
                <p class="text-xs text-gray-500">
                    Support: <a href="mailto:support@onlinehoter.nl" class="hover:text-green-400 transition">Support@onlinehoter.nl</a>
                </p>
            </div>
        </div>
    </footer>
</body>
</html>