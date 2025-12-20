<x-restore-layout>
    <x-slot name="token">{{ $token }}</x-slot>

    <div class="space-y-8" x-data="{ search: '', type: 'all', timeframe: 'all' }">
        <!-- Hero / Header -->
        <div class="rounded-2xl bg-gradient-to-r from-indigo-50 via-white to-cyan-50 border border-indigo-100/60 shadow-sm px-6 py-5 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-xs uppercase font-semibold tracking-[0.12em] text-indigo-600">Borg Restore</p>
                <h2 class="mt-1 text-2xl font-bold text-slate-900 sm:text-3xl">Beschikbare Archieven</h2>
                <p class="mt-2 text-sm text-slate-600">Kies een archief om bestanden te bekijken of te herstellen. Nieuwste archieven staan bovenaan.</p>
            </div>
            <div class="flex flex-col gap-3 w-full md:w-80">
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        x-model="search"
                        class="block w-full rounded-xl border border-slate-200 bg-white/90 py-2 pl-10 pr-3 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300"
                        placeholder="Zoek op naam..."
                    >
                </div>
                <div class="flex items-center gap-3 text-xs text-slate-500">
                    <span class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-3 py-1 font-semibold text-indigo-700 ring-1 ring-indigo-100">{{ $archives->total() }} archieven</span>
                    <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 font-semibold text-slate-700 ring-1 ring-slate-200">Pagina {{ $archives->currentPage() }} / {{ $archives->lastPage() }}</span>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="flex flex-wrap items-center gap-2">
            <span class="text-xs font-semibold text-slate-500 mr-2">Filter:</span>
            <!-- Type chips -->
            <button @click="type = 'all'" :class="{'bg-indigo-600 text-white': type==='all', 'bg-white text-slate-800': type!=='all'}" class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold shadow-sm ring-1 ring-slate-200 hover:bg-indigo-50">Alle</button>
            <button @click="type = 'files'" :class="{'bg-indigo-600 text-white': type==='files', 'bg-white text-slate-800': type!=='files'}" class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold shadow-sm ring-1 ring-slate-200 hover:bg-indigo-50">Bestanden</button>
            <button @click="type = 'db'" :class="{'bg-indigo-600 text-white': type==='db', 'bg-white text-slate-800': type!=='db'}" class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold shadow-sm ring-1 ring-slate-200 hover:bg-indigo-50">Database</button>
            <button @click="type = 'full'" :class="{'bg-indigo-600 text-white': type==='full', 'bg-white text-slate-800': type!=='full'}" class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold shadow-sm ring-1 ring-slate-200 hover:bg-indigo-50">Volledige</button>
            <!-- Timeframe chips -->
            <span class="ml-4 text-xs font-semibold text-slate-500">Periode:</span>
            <button @click="timeframe = 'recent'" :class="{'bg-cyan-600 text-white': timeframe==='recent', 'bg-white text-slate-800': timeframe!=='recent'}" class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold shadow-sm ring-1 ring-slate-200 hover:bg-cyan-50">7 dagen</button>
            <button @click="timeframe = 'month'" :class="{'bg-cyan-600 text-white': timeframe==='month', 'bg-white text-slate-800': timeframe!=='month'}" class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold shadow-sm ring-1 ring-slate-200 hover:bg-cyan-50">30 dagen</button>
            <button @click="timeframe = 'all'" :class="{'bg-cyan-600 text-white': timeframe==='all', 'bg-white text-slate-800': timeframe!=='all'}" class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold shadow-sm ring-1 ring-slate-200 hover:bg-cyan-50">Alles</button>
        </div>

        <!-- Archives Grid/List -->
        <div class="grid gap-4">
            @foreach ($archives as $a)
                @php
                    $detectedType = $a['detected_type'] ?? 'Onbekend';
                    $name = $a['name'];
                    $dateDisplay = null;
                    $relativeDisplay = null;
                    $displayName = $name;
                    if (preg_match('/(\d{4}-\d{2}-\d{2})T(\d{2}:\d{2}:\d{2})/', $name, $matches)) {
                        $datetime = \DateTime::createFromFormat('Y-m-d\TH:i:s', $matches[1] . 'T' . $matches[2]);
                        if ($datetime) {
                            $dateDisplay = $datetime->format('d-m-Y H:i');
                            $diff = $datetime->diff(new \DateTime());
                            $days = (int) $diff->format('%a');
                            $hours = (int) $diff->format('%h');
                            if ($days > 0) {
                                $relativeDisplay = $days . ' dagen geleden';
                            } else {
                                $relativeDisplay = $hours . ' uur geleden';
                            }
                            $prefix = substr($name, 0, strpos($name, '-'));
                            $displayName = $prefix . ' ' . $dateDisplay;
                        }
                    }
                @endphp
                @php
                    $daysAgo = null;
                    if (isset($datetime) && $datetime instanceof \DateTime) {
                        $daysAgo = (int) $datetime->diff(new \DateTime())->format('%a');
                    }
                    $typeKey = strtolower(($detectedType ?? 'unknown'));
                    // map to our filter keys
                    if ($typeKey === 'db') { $typeKey = 'db'; }
                    elseif ($typeKey === 'files') { $typeKey = 'files'; }
                    elseif ($typeKey === 'full') { $typeKey = 'full'; }
                    else { $typeKey = 'unknown'; }
                @endphp
                <div 
                    class="relative flex flex-col gap-4 rounded-2xl border border-slate-200/80 bg-white/90 p-4 shadow-sm hover:shadow-md transition-all duration-150"
                    x-show="
                        (search === '' || '{{ strtolower($name) }}'.includes(search.toLowerCase()) || '{{ strtolower($displayName) }}'.includes(search.toLowerCase())) &&
                        (type === 'all' || type === '{{ $typeKey }}') &&
                        (timeframe === 'all' || {{ $daysAgo !== null ? $daysAgo : 9999 }} <= (timeframe === 'recent' ? 7 : 30))
                    "
                    x-transition
                >
                    <div class="flex gap-4">
                        <div class="h-12 w-12 flex-none rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center ring-1 ring-indigo-100 shadow-sm">
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
                            <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2">
                                <a href="{{ route('restore.files', ['archive' => $name, 'token' => $token]) }}" class="text-base font-semibold text-slate-900 hover:text-indigo-700">
                                    @if($dateDisplay)
                                        📅 {{ $dateDisplay }}
                                    @else
                                        {{ $displayName }}
                                    @endif
                                </a>
                                <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700 ring-1 ring-slate-200">{{ $detectedType }}</span>
                                @if($daysAgo !== null && $daysAgo <= 2)
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700 ring-1 ring-green-200">Nieuw</span>
                                @endif
                            </div>
                            @if($relativeDisplay)
                                <div class="mt-1 text-xs text-slate-500">
                                    ⏱️ {{ $relativeDisplay }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <a 
                            href="{{ route('restore.calendar') }}?token={{ urlencode($token) }}&archive={{ urlencode($name) }}"
                            class="inline-flex items-center justify-center rounded-full bg-white px-3 py-1.5 text-sm font-semibold text-slate-800 shadow-sm ring-1 ring-slate-200 hover:bg-slate-50"
                            title="Blader door bestanden"
                        >
                            Kalender →
                        </a>
                        <a 
                            href="{{ route('restore.mysql') }}?token={{ urlencode($token) }}&archive={{ urlencode($name) }}"
                            class="inline-flex items-center justify-center rounded-full bg-amber-50 px-3 py-1.5 text-sm font-semibold text-amber-700 shadow-sm ring-1 ring-amber-200 hover:bg-amber-100"
                            title="Database restore"
                        >
                            MySQL 🗄️
                        </a>
                        <a 
                            href="{{ route('restore.website') }}?token={{ urlencode($token) }}&archive={{ urlencode($name) }}"
                            class="inline-flex items-center justify-center rounded-full bg-green-50 px-3 py-1.5 text-sm font-semibold text-green-700 shadow-sm ring-1 ring-green-200 hover:bg-green-100"
                            title="Website + database restore"
                        >
                            Website 🌐
                        </a>
                        <a 
                            href="{{ route('restore.files', ['archive' => $name, 'token' => $token]) }}"
                            class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500"
                        >
                            Bestanden →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($archives->hasPages())
            <div class="flex items-center justify-between pt-2">
                <div class="text-sm text-slate-500">
                    Toon {{ $archives->firstItem() }}–{{ $archives->lastItem() }} van {{ $archives->total() }} archieven
                </div>
                <div class="text-right">
                    {{ $archives->onEachSide(1)->links() }}
                </div>
            </div>
        @endif
        
        <div class="text-center text-sm text-gray-500 mt-4" x-show="search !== ''">
            <span x-text="document.querySelectorAll('[x-show]')?.length || 0"></span> resultaten zichtbaar
        </div>
    </div>
</x-restore-layout>