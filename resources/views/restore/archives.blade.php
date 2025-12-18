<x-restore-layout>
    <x-slot name="token">{{ $token }}</x-slot>

    <div class="space-y-6" x-data="{ search: '' }">
        <!-- Header Section -->
        <div class="md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                    Beschikbare Archieven
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Kies een archief om bestanden te bekijken of te herstellen.
                </p>
            </div>
            <div class="mt-4 flex md:ml-4 md:mt-0">
                <div class="relative rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        x-model="search"
                        class="block w-full rounded-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" 
                        placeholder="Zoek op naam..."
                    >
                </div>
            </div>
        </div>

        <!-- Archives Grid/List -->
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
            <ul role="list" class="divide-y divide-gray-100">
                @foreach ($archives as $a)
                    @php
                        $detectedType = $a['detected_type'] ?? 'Unknown';
                        $name = $a['name'];
                        // Extract datetime from name if possible (assuming format like server-YYYY-MM-DDTHH:MM:SS...)
                        $dateDisplay = null;
                        $displayName = $name;
                        if (preg_match('/(\d{4}-\d{2}-\d{2})T(\d{2}:\d{2}:\d{2})/', $name, $matches)) {
                            // Parse the date and time
                            $datetime = \DateTime::createFromFormat('Y-m-d\TH:i:s', $matches[1] . 'T' . $matches[2]);
                            if ($datetime) {
                                // Format as Dutch date and time: dd-mm-yyyy HH:mm
                                $dateDisplay = $datetime->format('d-m-Y H:i');
                                // Extract the prefix (e.g., "server") and show it with the formatted date
                                $prefix = substr($name, 0, strpos($name, '-'));
                                $displayName = $prefix . ' ' . $dateDisplay;
                            }
                        }
                    @endphp
                    <li 
                        class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6 transition-colors duration-150"
                        x-show="search === '' || '{{ strtolower($name) }}'.includes(search.toLowerCase()) || '{{ strtolower($displayName) }}'.includes(search.toLowerCase())"
                        x-transition
                    >
                        <div class="flex min-w-0 gap-x-4">
                            <div class="h-12 w-12 flex-none rounded-full bg-gray-50 flex items-center justify-center ring-1 ring-gray-200">
                                @if ($detectedType === 'DB')
                                    <span class="text-xl" title="Database">🛢️</span>
                                @elseif ($detectedType === 'Files')
                                    <span class="text-xl" title="Bestanden">📁</span>
                                @elseif ($detectedType === 'Full')
                                    <span class="text-xl" title="Volledig">💾</span>
                                @else
                                    <span class="text-xl" title="Onbekend">📦</span>
                                @endif
                            </div>
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold leading-6 text-gray-900">
                                    <a href="{{ route('restore.files', ['archive' => $name, 'token' => $token]) }}">
                                        <span class="absolute inset-x-0 -top-px bottom-0"></span>
                                        {{ $displayName }}
                                    </a>
                                </p>
                                <div class="mt-1 flex text-xs leading-5 text-gray-500 gap-2">
                                    @if($dateDisplay)
                                        <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">📅 {{ $dateDisplay }}</span>
                                    @endif
                                    <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">{{ $detectedType }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-x-4 z-10">
                            <div class="hidden sm:flex flex-col gap-2">
                                <a 
                                    href="{{ route('restore.calendar') }}?token={{ urlencode($token) }}&archive={{ urlencode($name) }}"
                                    class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                    title="Blader door bestanden"
                                >
                                    Kalender →
                                </a>
                            </div>
                            <div class="hidden sm:flex flex-col gap-2">
                                <a 
                                    href="{{ route('restore.mysql') }}?token={{ urlencode($token) }}&archive={{ urlencode($name) }}"
                                    class="rounded-md bg-amber-50 px-2.5 py-1.5 text-sm font-semibold text-amber-700 shadow-sm ring-1 ring-inset ring-amber-200 hover:bg-amber-100"
                                    title="Database restore"
                                >
                                    MySQL 🗄️
                                </a>
                            </div>
                            <div class="hidden sm:flex flex-col gap-2">
                                <a 
                                    href="{{ route('restore.website') }}?token={{ urlencode($token) }}&archive={{ urlencode($name) }}"
                                    class="rounded-md bg-green-50 px-2.5 py-1.5 text-sm font-semibold text-green-700 shadow-sm ring-1 ring-inset ring-green-200 hover:bg-green-100"
                                    title="Website + database restore"
                                >
                                    Website 🌐
                                </a>
                            </div>
                            <a 
                                href="{{ route('restore.files', ['archive' => $name, 'token' => $token]) }}"
                                class="rounded-full bg-white px-3 py-1.5 text-sm font-semibold text-indigo-600 shadow-sm ring-1 ring-inset ring-indigo-200 hover:bg-indigo-50"
                            >
                                Browse →
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        
        <div class="text-center text-sm text-gray-500 mt-4" x-show="search !== ''">
            <span x-text="document.querySelectorAll('li[x-show]').length"></span> resultaten zichtbaar
        </div>
    </div>
</x-restore-layout>