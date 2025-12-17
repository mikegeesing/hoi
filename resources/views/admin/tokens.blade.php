<div class="max-w-2xl mx-auto mt-8">
    <div class="bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-semibold mb-4">Restore token aanmaken</h1>

        <form method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="text-sm font-medium">Borg user</label>
                <input name="borg_user" class="w-full border rounded p-2">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm">Geldig (uren)</label>
                    <input type="number" name="expires_in_hours" value="1" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="text-sm">Max uses</label>
                    <input type="number" name="max_uses" value="3" class="w-full border rounded p-2">
                </div>
            </div>

            <div class="pt-2">
                <button class="bg-black text-white px-4 py-2 rounded">Token aanmaken</button>
            </div>
        </form>
    </div>

    @if(session('generated_token'))
        <div class="mt-6 bg-white p-4 rounded shadow">
            <h3 class="font-semibold">Token aangemaakt</h3>
            <div class="mt-2">
                <label class="text-xs text-gray-600">Token (kopieer en bewaar veilig)</label>
                <input type="text" value="{{ session('generated_token') }}" readonly class="w-full mt-1 border rounded p-2 font-mono">
            </div>

            <div class="mt-3 text-sm text-gray-700">
                Borg user: {{ session('borg_user') }}<br>
                Verloopt op: {{ session('expires_at') }}<br>
                Max uses: {{ session('max_uses') }}
            </div>
        </div>
    @endif
</div>
