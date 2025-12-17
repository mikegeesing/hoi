<x-restore-layout>
    <x-slot name="token">{{ $token }}</x-slot>
    
    <x-slot name="head">
        <!-- FullCalendar -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
        <style>
            .fc .fc-toolbar-title { font-size: 1.25rem; font-weight: 700; }
            .fc .fc-button { background-color: #4f46e5; border-color: #4f46e5; }
            .fc .fc-button:hover { background-color: #4338ca; border-color: #4338ca; }
            .fc .fc-button-primary:not(:disabled).fc-button-active { background-color: #3730a3; border-color: #3730a3; }
        </style>
    </x-slot>

    <div class="space-y-6">
        <div class="md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                    Backup Kalender
                </h2>
                <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6">
                    <div class="mt-2 flex items-center text-sm text-gray-500">
                        <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z" clip-rule="evenodd" />
                        </svg>
                        Selecteer een snapshot datum
                    </div>
                    @if($path)
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z" clip-rule="evenodd" />
                            </svg>
                            Pad: <code class="ml-1 bg-gray-100 px-1 py-0.5 rounded text-xs">{{ $path }}</code>
                        </div>
                    @endif
                </div>
            </div>
            <div class="mt-4 flex md:ml-4 md:mt-0">
                <a href="{{ route('restore.archives') }}?token={{ urlencode($token) }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    Lijstweergave
                </a>
            </div>
        </div>

        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl p-6">
            <div id="calendar"></div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const events = @json($events);
        const token  = @json($token);
        const filesFilter = @json($files ?? null);

        const calendar = new FullCalendar.Calendar(
            document.getElementById('calendar'),
            {
                initialView: 'dayGridMonth',
                height: 'auto',
                firstDay: 1, // maandag
                locale: 'nl',
                buttonText: {
                    today: 'Vandaag'
                },
                events: events,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listMonth'
                },

                eventClick: function(info) {
                    info.jsEvent.preventDefault();

                    const day = info.event.extendedProps.day;
                    const archiveName = info.event.extendedProps.archive;

                    if (filesFilter && Array.isArray(filesFilter) && filesFilter.length > 0) {
                        if (!confirm('Wilt u het herstel starten voor ' + filesFilter.length + ' bestanden uit archief "' + archiveName + '"?')) {
                            return;
                        }

                        // Start restore for selected files at the selected archive
                        fetch('/restore/start', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                            },
                            body: JSON.stringify({
                                token: token,
                                archive: archiveName,
                                files: filesFilter
                            })
                        })
                        .then(r => r.json())
                        .then(j => {
                            if (j.job_id) {
                                window.location.href = '/restore/status/' + j.job_id + '?token=' + encodeURIComponent(token);
                            } else if (j.error) {
                                alert('Fout: ' + j.error);
                            }
                        })
                        .catch(e => alert('Fout bij starten restore: ' + e.message));

                        return;
                    }

                    // Klik op dag → ga naar files browser voor dat archief
                    // Oorspronkelijk stuurde dit naar ?date=... maar de files browser verwacht 'archive' param.
                    // We gebruiken de archive name uit het event.
                    
                    // Route expects: /restore/files/{archive}?token=...
                    // We construct it manually or use a base url provided by blade
                    const baseUrl = '/restore/files/';
                    window.location.href = baseUrl + encodeURIComponent(archiveName) + '?token=' + encodeURIComponent(token);
                }
            }
        );

        calendar.render();
    });
    </script>
</x-restore-layout>