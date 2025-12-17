<div class="max-w-xl mx-auto mt-10 bg-white/80 backdrop-blur shadow rounded-xl p-6">
    <h1 class="text-2xl font-semibold mb-6">Restore token aanmaken</h1>

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

        <button class="bg-black text-white px-4 py-2 rounded">
            Token aanmaken
        </button>
    </form>
</div>
@if(session('generated_token'))
    <hr>

    <h3>Token aangemaakt</h3>

    <label>Token</label><br>
    <input
        type="text"
        value="{{ session('generated_token') }}"
        readonly
        style="width: 400px;"
    ><br><br>

    <small>
        Borg user: {{ session('borg_user') }}<br>
        Verloopt op: {{ session('expires_at') }}<br>
        Max uses: {{ session('max_uses') }}
    </small>
@endif
