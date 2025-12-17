<x-restore-layout>
    <x-slot name="token">{{ $token }}</x-slot>

    <div class="space-y-6">
        <!-- Header / Breadcrumbs / Actions -->
        <div class="md:flex md:items-center md:justify-between gap-4">
            <div class="min-w-0 flex-1">
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
                    <a href="{{ route('restore.archives') }}?token={{ urlencode($token) }}" class="hover:text-gray-900 hover:underline">Archieven</a>
                    <span>/</span>
                    <span class="font-medium text-gray-900">{{ $archive }}</span>
                </div>
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                    Bestanden Browser
                </h2>
                <div class="mt-1 text-sm text-gray-600 flex flex-wrap gap-2 items-center">
                    <span>Huidig pad:</span>
                    <code class="bg-gray-100 px-2 py-0.5 rounded text-gray-800 font-mono text-xs break-all">{{ $path ?: '/' }}</code>
                    <span class="text-gray-400">|</span>
                    <span>{{ count($files ?? []) }} items</span>
                </div>
            </div>

            <div class="mt-4 flex flex-col sm:flex-row gap-3 md:mt-0 md:ml-4">
                 <form method="GET" class="flex gap-2 w-full sm:w-auto">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="archive" value="{{ $archive }}">
                    <input type="hidden" name="path" value="{{ $path }}">
                    
                    <div class="relative rounded-md shadow-sm flex-grow">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Zoek bestand..." 
                            value="{{ request('search') }}" 
                            class="block w-full rounded-md border-0 py-1.5 pl-9 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        >
                    </div>
                    
                    @if(request('search'))
                        <a href="{{ route('restore.files', ['archive' => $archive, 'token' => $token, 'path' => $path]) }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-red-300 hover:bg-red-50 text-red-600">
                            ✕
                        </a>
                    @else
                        <button type="submit" class="hidden sm:inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            Zoek
                        </button>
                    @endif
                </form>

                <button id="openCalendarBtn" x-data="{ loading: false }" @click="loading = true" :disabled="loading" class="inline-flex justify-center items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg x-show="!loading" class="mr-2 -ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <svg x-show="loading" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span x-text="loading ? 'Laden...' : 'Selectie herstellen'"></span>
                </button>
            </div>
        </div>

        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
            @php $files = $files ?? []; @endphp

            @if(count($files) === 0)
                <div class="p-12 text-center">
                    <div class="mx-auto h-12 w-12 text-gray-400">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">Geen bestanden gevonden</h3>
                    <p class="mt-1 text-sm text-gray-500">Er zijn geen bestanden gevonden op het pad <span class="font-mono text-xs bg-gray-100 px-1 rounded">{{ $path ?: '/' }}</span>.</p>
                    <div class="mt-6">
                        @if($path !== '' && $path !== '/' && $path !== 'home/onlineho')
                             @php
                                $parentPath = dirname($path);
                                if ($parentPath === '.' || $parentPath === '/' || $parentPath === 'home') $parentPath = 'home/onlineho';
                             @endphp
                             <a href="{{ route('restore.files', ['archive' => $archive, 'token' => $token, 'path' => $parentPath, 'depth' => (request('depth', 1) - 1)]) }}" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                                Ga map omhoog
                            </a>
                        @else
                             <a href="{{ route('restore.archives') }}?token={{ urlencode($token) }}" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                                Terug naar archieven
                            </a>
                        @endif
                    </div>
                </div>
            @else
                <!-- File List Header (Desktop) -->
                <div class="border-b border-gray-200 bg-gray-50 px-4 py-3 text-xs font-medium uppercase tracking-wider text-gray-500 hidden sm:grid sm:grid-cols-12 gap-4">
                    <div class="col-span-1 text-center">Select</div>
                    <div class="col-span-7">Naam</div>
                    <div class="col-span-2 text-right">Grootte</div>
                    <div class="col-span-2 text-right">Actie</div>
                </div>

                <ul role="list" class="divide-y divide-gray-100">
                    @if($path !== '' && $path !== '/' && $path !== 'home/onlineho' && !request('search'))
                         @php
                            $parentPath = dirname($path);
                            if ($parentPath === '.' || $parentPath === '/' || $parentPath === 'home') $parentPath = 'home/onlineho';
                         @endphp
                        <li class="hover:bg-gray-50 transition-colors">
                            <a href="{{ route('restore.files', ['archive' => $archive, 'token' => $token, 'path' => $parentPath]) }}" class="block px-4 py-3 sm:px-6">
                                <div class="flex items-center gap-3">
                                    <div class="text-indigo-400">
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-indigo-900">.. (Map omhoog)</span>
                                </div>
                            </a>
                        </li>
                    @endif

                    @foreach($files as $f)
                        @php
                            $fileName = $f['name'] ?? 'N/A';
                            $fileType = $f['type'] ?? '';
                            $fileSize = $f['size'] ?? 0;
                            $filePath = $f['path'] ?? ($f['name'] ?? '');
                            $isDir = $fileType === 'dir';
                        @endphp
                        <li class="relative hover:bg-gray-50 transition-colors group">
                            <div class="px-4 py-3 sm:px-6 sm:grid sm:grid-cols-12 sm:gap-4 sm:items-center">
                                <!-- Checkbox -->
                                <div class="col-span-1 flex justify-center items-center mb-2 sm:mb-0">
                                    <input type="checkbox" class="select-file h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 cursor-pointer" value="{{ $filePath }}">
                                </div>

                                <!-- Name & Icon -->
                                <div class="col-span-7 min-w-0">
                                    <div class="flex items-center gap-3">
                                        <div class="flex-shrink-0">
                                            @if($isDir)
                                                <svg class="h-6 w-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                                </svg>
                                            @else
                                                <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            @if($isDir)
                                                <a href="{{ route('restore.files', ['archive' => $archive, 'token' => $token, 'path' => $filePath, 'depth' => (request('depth', 0) + 1)]) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-900 truncate block focus:outline-none">
                                                    <span class="absolute inset-x-0 -top-px bottom-0 sm:hidden"></span>
                                                    {{ $fileName }}
                                                </a>
                                            @else
                                                <p class="text-sm font-medium text-gray-900 truncate">{{ $fileName }}</p>
                                                @if(request('search'))
                                                    <p class="text-xs text-gray-500 truncate">{{ $filePath }}</p>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Size -->
                                <div class="col-span-2 text-right text-sm text-gray-500 font-mono hidden sm:block">
                                    {{ $isDir ? '-' : ($fileSize > 0 ? number_format($fileSize / 1024, 1) . ' KB' : '0 KB') }}
                                </div>

                                <!-- Actions -->
                                <div class="col-span-2 text-right z-10 relative flex justify-end gap-2">
                                    <button 
                                        onclick="restoreFile('{{ addslashes($filePath) }}')"
                                        class="text-xs font-semibold text-white bg-indigo-600 px-3 py-1 rounded hover:bg-indigo-700 border border-indigo-700 shadow-sm transition"
                                    >
                                        Restore
                                    </button>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <script>
    document.getElementById('openCalendarBtn').addEventListener('click', function(){
        const checks = Array.from(document.querySelectorAll('.select-file:checked'))
            .map(n => n.value);

        if (checks.length === 0) {
            alert('Selecteer eerst één of meer bestanden/mappen om te herstellen.');
            return;
        }

        const token = encodeURIComponent(@json($token));
        const archive = encodeURIComponent(@json($archive));
        const files = encodeURIComponent(JSON.stringify(checks));
        const url = @json(route('restore.calendar'));

        // graceful url + nice message
        window.location.href = url + '?token=' + token + '&archive=' + archive + '&files=' + files;
    });

    async function restoreFile(filePath) {
        if (!confirm('Weet je zeker dat je dit bestand/map wilt herstellen?\n\nPad: ' + filePath)) {
            return;
        }

        const token = @json($token);
        const archive = @json($archive);

        try {
            const response = await fetch('/api/restore', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    token: token,
                    archive: archive,
                    files: [filePath]
                })
            });

            let data;
            try {
                data = await response.json();
            } catch (e) {
                const text = await response.text();
                alert('Fout bij herstellen (geen JSON response):\nStatus: ' + response.status + '\nResponse: ' + text.substring(0, 500));
                console.error('Response text:', text);
                return;
            }

            if (!response.ok) {
                alert('Fout bij herstellen:\nStatus: ' + response.status + '\n' + (data.error || JSON.stringify(data)));
                console.error('Error response:', data);
                return;
            }

            // Redirect naar status pagina
            window.location.href = '/restore/status/' + data.job_id + '?token=' + encodeURIComponent(token);
        } catch (error) {
            alert('Fout bij herstellen: ' + error.message);
            console.error('Fetch error:', error);
        }
    }
    </script>
</x-restore-layout>