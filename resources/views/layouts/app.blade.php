<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Backup restore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; line-height: 1.5; color: #1f2937; }
            .bg-gray-50 { background-color: #f9fafb; }
            .min-h-screen { min-height: 100vh; }
        </style>
    @endif
</head>
<body class="bg-gray-50">
    <main class="min-h-screen">
        @yield('content')
    </main>
</body>
</html>
