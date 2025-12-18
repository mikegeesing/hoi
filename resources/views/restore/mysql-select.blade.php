<x-restore-layout>
    <x-slot name="token">{{ $token }}</x-slot>

    <div class="space-y-6">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                    Database Restore
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Selecteer een database om te herstellen
                </p>
            </div>
            <div class="mt-4 flex md:ml-4 md:mt-0">
                <a href="{{ route('restore.archives') }}?token={{ urlencode($token) }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    Terug
                </a>
            </div>
        </div>

        @if(isset($error))
            <div class="rounded-md bg-red-50 p-4">
                <p class="text-sm font-medium text-red-800">{{ $error }}</p>
            </div>
        @endif

        <!-- SQL Files -->
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
            @if(!empty($sqlFiles))
                <ul role="list" class="divide-y divide-gray-100">
                    @foreach($sqlFiles as $file)
                        <li class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6 transition-colors duration-150">
                            <div class="flex min-w-0 gap-x-4 flex-1">
                                <div class="h-12 w-12 flex-none rounded-full bg-amber-50 flex items-center justify-center ring-1 ring-amber-200">
                                    <span class="text-xl">🗄️</span>
                                </div>
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">
                                        {{ $file }}
                                    </p>
                                    <p class="mt-1 text-xs text-gray-500">
                                        SQL database dump
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-x-4">
                                <a 
                                    href="#"
                                    onclick="openRestoreModal('{{ $file }}'); return false;"
                                    class="rounded-md bg-amber-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-amber-700"
                                >
                                    Herstellen
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-4 py-12 text-center">
                    <p class="text-gray-500">Geen SQL bestanden gevonden in dit archief</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Restore Modal -->
    <div id="restoreModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 sm:px-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="relative bg-white rounded-lg shadow-xl max-w-md w-full p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    Database herstellen
                </h3>
                
                <form method="POST" action="{{ route('restore.mysql-confirm') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="archive" value="{{ $archive }}">
                    <input type="hidden" name="database" id="dbFile" value="">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Database naam
                        </label>
                        <input type="text" name="database_name" required placeholder="bijv. my_database" class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-amber-600 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Restore type
                        </label>
                        <select name="restore_type" id="restoreType" onchange="updateTableSelect()" class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-amber-600 sm:text-sm">
                            <option value="full">Hele database herstellen</option>
                            <option value="table">Alleen specifieke tabel(len)</option>
                        </select>
                    </div>

                    <div id="tableSelectDiv" class="mb-4 hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tabel(len) selecteren
                        </label>
                        <div id="tableCheckboxes" class="space-y-2 max-h-48 overflow-y-auto">
                            <!-- Filled by JS -->
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeRestoreModal()" class="px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-50 rounded-md hover:bg-gray-100">
                            Annuleren
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-amber-600 rounded-md hover:bg-amber-700">
                            Herstellen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let currentSqlFile = null;
        let parsedTables = {};

        async function openRestoreModal(filename) {
            currentSqlFile = filename;
            document.getElementById('dbFile').value = filename;
            
            // TODO: Fetch tables from API
            // For now, just show the modal
            document.getElementById('restoreModal').classList.remove('hidden');
        }

        function closeRestoreModal() {
            document.getElementById('restoreModal').classList.add('hidden');
        }

        function updateTableSelect() {
            const type = document.getElementById('restoreType').value;
            const div = document.getElementById('tableSelectDiv');
            
            if (type === 'table') {
                div.classList.remove('hidden');
                // TODO: Load tables for current SQL file
            } else {
                div.classList.add('hidden');
            }
        }

        // Close modal on outside click
        document.getElementById('restoreModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'restoreModal') {
                closeRestoreModal();
            }
        });
    </script>
</x-restore-layout>
