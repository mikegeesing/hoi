@extends('layouts.restore')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-900 to-gray-800 py-12 px-4">
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
                <a href="javascript:history.back()" class="flex-1 inline-flex justify-center items-center px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Terug
                </a>
                <a href="{{ route('restore.archives', ['token' => request('token')]) }}" class="flex-1 inline-flex justify-center items-center px-6 py-3 btn-green text-white font-semibold rounded-lg hover:shadow-lg transition">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12a9 9 0 019-9 9.75 9.75 0 016.74 2.74L21 8" />
                    </svg>
                    Naar Backups
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
