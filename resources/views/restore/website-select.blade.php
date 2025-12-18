<x-restore-layout>
    <x-slot name="token">{{ $token }}</x-slot>

    <div class="space-y-6">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                    Website Restore
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Selecteer een domein om te herstellen (bestanden + database)
                </p>
            </div>
            <div class="mt-4 flex md:ml-4 md:mt-0">
                <a href="{{ route('restore.archives') }}?token={{ urlencode($token) }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    Terug
                </a>
            </div>
        </div>

        <!-- Domains List -->
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
            @if(!empty($domains))
                <ul role="list" class="divide-y divide-gray-100">
                    @foreach($domains as $domain)
                        <li class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6 transition-colors duration-150">
                            <div class="flex min-w-0 gap-x-4 flex-1">
                                <div class="h-12 w-12 flex-none rounded-full bg-green-50 flex items-center justify-center ring-1 ring-green-200">
                                    <span class="text-xl">🌐</span>
                                </div>
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">
                                        {{ $domain }}
                                    </p>
                                    <p class="mt-1 text-xs text-gray-500">
                                        Website domein
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-x-4">
                                <a 
                                    href="#"
                                    class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-700"
                                >
                                    Selecteer
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-4 py-12 text-center">
                    <p class="text-gray-500">Geen domeinen beschikbaar</p>
                </div>
            @endif
        </div>
    </div>
</x-restore-layout>
