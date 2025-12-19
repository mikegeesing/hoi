<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restore Token - Online Hoster</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-purple-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <!-- Logo/Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-full mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Backup Restore</h1>
                <p class="text-gray-600 mt-2">Voer uw restore token in</p>
            </div>

            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Token Input Form -->
            <form method="GET" action="{{ route('restore.archives') }}" class="space-y-6">
                <div>
                    <label for="token" class="block text-sm font-medium text-gray-700 mb-2">
                        Restore Token
                    </label>
                    <input 
                        type="text" 
                        name="token" 
                        id="token" 
                        required
                        placeholder="Plak hier uw token..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-mono text-sm"
                        autofocus
                    >
                    <p class="mt-2 text-sm text-gray-500">
                        U heeft een token ontvangen van Online Hoster. Plak deze hierboven in.
                    </p>
                </div>

                <button 
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 shadow-lg hover:shadow-xl"
                >
                    Toegang tot Restore Portal
                </button>
            </form>

            <!-- Help Text -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <p class="text-xs text-gray-500 text-center">
                    Heeft u geen token ontvangen? Neem contact op met Online Hoster support.
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-sm text-gray-600">
            <p>&copy; {{ date('Y') }} Online Hoster - Backup Restore Portal</p>
        </div>
    </div>
</body>
</html>
