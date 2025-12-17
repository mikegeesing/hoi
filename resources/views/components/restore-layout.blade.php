<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Borg Restore') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind via CDN for simplicity -->
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
    </style>
    <!-- Alpine.js for simple interactions -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    {{ $head ?? '' }}
</head>
<body class="h-full font-sans antialiased text-gray-900">
    <div class="min-h-full flex flex-col">
        <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center gap-3">
                            <!-- Logo / Brand -->
                            <div class="bg-indigo-600 p-2 rounded-lg text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900 tracking-tight">Borg Restore</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        @if(isset($token))
                            <div class="hidden md:flex flex-col items-end">
                                <span class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Huidige sessie</span>
                                <span class="text-sm font-mono font-medium text-gray-700">
                                    {{ substr($token, 0, 8) }}...
                                </span>
                            </div>
                        @endif
                        <div class="border-l pl-4 border-gray-200">
                            <a href="{{ route('restore.login') }}" class="text-sm font-medium text-gray-500 hover:text-red-600 transition-colors">
                                Uitloggen
                            </a>
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

        <footer class="bg-white border-t border-gray-200 mt-auto">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <p class="text-center text-sm text-gray-500">
                    &copy; {{ date('Y') }} Borg Restore Portal. Alle rechten voorbehouden.
                </p>
            </div>
        </footer>
    </div>
</body>
</html>