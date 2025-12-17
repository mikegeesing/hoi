<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Restore job #{{ $job->id }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <p><strong>Status:</strong> {{ $job->status }}</p>
                <p><strong>Archive:</strong> {{ $job->archive_name }}</p>
                <p><strong>Files:</strong></p>
                <ul>
                    @foreach($job->files_to_restore as $f)
                        <li>{{ $f }}</li>
                    @endforeach
                </ul>

                <h3 class="mt-4">Log</h3>
                <pre class="bg-gray-900 text-white p-3 rounded">{{ $job->log_output ?? 'Nog geen output' }}</pre>

                <p class="mt-4"><a href="/admin/tokens" class="text-blue-600">Terug naar tokens</a></p>
            </div>
        </div>
    </div>
</x-app-layout>
