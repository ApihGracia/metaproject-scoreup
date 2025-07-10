{{-- filepath: resources/views/livewire/admin/admin-dashboard.blade.php --}}
<div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Scoreboard Management</h1>

    @if(session()->has('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <h2 class="text-xl font-bold mb-2">Overview: Total Medals per Team</h2>
    <table class="w-full table-auto border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Team</th>
                <th class="border px-4 py-2">Gold</th>
                <th class="border px-4 py-2">Silver</th>
                <th class="border px-4 py-2">Bronze</th>
                <th class="border px-4 py-2">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($overview as $row)
                <tr>
                    <td class="border px-4 py-2">{{ $row['team']->name }}</td>
                    <td class="border px-4 py-2">{{ $row['gold'] }}</td>
                    <td class="border px-4 py-2">{{ $row['silver'] }}</td>
                    <td class="border px-4 py-2">{{ $row['bronze'] }}</td>
                    <td class="border px-4 py-2">{{ $row['total'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 class="mt-6 text-xl font-bold mb-2">Detailed Scoreboard (Per Team Per Sport)</h2>
    <table class="w-full table-auto border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Team</th>
                <th class="border px-4 py-2">Sport</th>
                <th class="border px-4 py-2">Type</th>
                <th class="border px-4 py-2">Gold</th>
                <th class="border px-4 py-2">Silver</th>
                <th class="border px-4 py-2">Bronze</th>
                <th class="border px-4 py-2">Total</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($scoreboards as $scoreboard)
                <tr>
                    <td class="border px-4 py-2">{{ $scoreboard->team->name }}</td>
                    <td class="border px-4 py-2">{{ $scoreboard->sport->sport_name }}</td>
                    <td class="border px-4 py-2">{{ $scoreboard->gold }}</td>
                    <td class="border px-4 py-2">{{ $scoreboard->silver }}</td>
                    <td class="border px-4 py-2">{{ $scoreboard->bronze }}</td>
                    <td class="border px-4 py-2">{{ $scoreboard->gold + $scoreboard->silver + $scoreboard->bronze }}</td>
                </tr>
            @endforeach --}}
            @foreach($scoreboards as $row)
            <tr>
                <td class="border px-4 py-2">{{ $row['team']->name }}</td>
                <td class="border px-4 py-2">{{ $row['sport']->sport_name }}</td>
                <td class="border px-4 py-2">{{ $row['sport']->gender }}</td>
                <td class="border px-4 py-2">{{ $row['gold'] }}</td>
                <td class="border px-4 py-2">{{ $row['silver'] }}</td>
                <td class="border px-4 py-2">{{ $row['bronze'] }}</td>
                <td class="border px-4 py-2">{{ $row['total'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- <table class="w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Team</th>
                <th class="border px-4 py-2">Gold</th>
                <th class="border px-4 py-2">Silver</th>
                <th class="border px-4 py-2">Bronze</th>
                <th class="border px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($scoreboards as $team)
                <tr>
                    <td class="border px-4 py-2">{{ $team->team_name ?? $team->name }}</td>
                    <td class="border px-4 py-2">
                        <input type="number" min="0" wire:model.defer="medals.{{ $team->id }}.gold" class="w-16 border rounded p-1">
                    </td>
                    <td class="border px-4 py-2">
                        <input type="number" min="0" wire:model.defer="medals.{{ $team->id }}.silver" class="w-16 border rounded p-1">
                    </td>
                    <td class="border px-4 py-2">
                        <input type="number" min="0" wire:model.defer="medals.{{ $team->id }}.bronze" class="w-16 border rounded p-1">
                    </td>
                    <td class="border px-4 py-2">
                        <button wire:click="saveMedals({{ $team->id }})" class="bg-blue-600 text-white px-3 py-1 rounded">Save</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No teams found.</td>
                </tr>
            @endforelse
        </tbody>
    </table> --}}
</div>
