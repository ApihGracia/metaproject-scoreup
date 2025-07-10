<div>
    @if (session()->has('message'))
        <div class="p-2 text-green-600">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save">
        <div>
            <label>Match Name</label>
            <input type="text" wire:model="match_name" class="border p-1">
            @error('match_name') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Team A Score</label>
            <input type="number" wire:model="team_a_score" class="border p-1">
            @error('team_a_score') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Team B Score</label>
            <input type="number" wire:model="team_b_score" class="border p-1">
            @error('team_b_score') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 mt-2">Save</button>
    </form>
</div>
