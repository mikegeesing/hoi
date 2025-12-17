<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="p-4 border rounded-lg">
                            <h3 class="font-bold">Restore portal</h3>
                            <p class="text-sm text-gray-600">Open de token-gedreven restore portal (publiek, vereist token).</p>
                            <div class="mt-3">
                                <a class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-md" href="/restore">Open portal</a>
                            </div>
                        </div>

                        <div class="p-4 border rounded-lg">
                            <h3 class="font-bold">Backup kalender</h3>
                            <p class="text-sm text-gray-600">Bekijk beschikbare snapshots per datum.</p>
                            <div class="mt-3">
                                <a class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-md" href="/restore/calendar">Open kalender</a>
                            </div>
                        </div>

                        <div class="p-4 border rounded-lg">
                            <h3 class="font-bold">Beheer tokens</h3>
                            <p class="text-sm text-gray-600">Maak of beheer tokens voor klanten (admin).</p>
                            <div class="mt-3">
                                <a class="inline-flex items-center px-3 py-2 bg-gray-800 text-white rounded-md" href="/admin/tokens">Tokens beheren</a>
                            </div>
                        </div>
                    </div>
                    
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold">Recente restore jobs</h3>
                            @php
                                $recent = \App\Models\RestoreJob::orderByDesc('created_at')->limit(8)->get();
                            @endphp

                            <div class="mt-3 bg-white p-4 rounded shadow">
                                <table class="w-full text-left text-sm">
                                    <thead>
                                        <tr><th>ID</th><th>Archive</th><th>Status</th><th>Aangemaakt</th><th></th></tr>
                                    </thead>
                                    <tbody>
                                    @foreach($recent as $r)
                                        <tr>
                                            <td>#{{ $r->id }}</td>
                                            <td>{{ $r->archive_name }}</td>
                                            <td>{{ $r->status }}</td>
                                            <td>{{ $r->created_at->diffForHumans() }}</td>
                                            <td><a class="text-blue-600" href="/admin/restore/jobs/{{ $r->id }}">Bekijk</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
