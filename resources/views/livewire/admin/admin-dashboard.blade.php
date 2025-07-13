{{-- filepath: resources/views/livewire/admin/admin-dashboard.blade.php --}}
<div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Scoreboard Management</h1>

    @if(session()->has('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <h2 class="text-xl font-bold mb-2">Overview: Total Medals per Team</h2>
    <div class="overflow-x-auto">
    {{-- <table class="min-w-full border-separate border-spacing-y-2 shadow-xl rounded-2xl"> --}}
    <table class="w-full table-auto border border-gray-300">
        <thead>
            <tr class="bg-gradient-to-r from-yellow-400 via-orange-400 to-red-500 text-white text-lg">
                <th class="px-4 py-2 rounded-l-2xl font-extrabold border">Team</th>
                <th class="px-4 py-2 font-extrabold border">🥇 Gold</th>
                <th class="px-4 py-2 font-extrabold border">🥈 Silver</th>
                <th class="px-4 py-2 font-extrabold border">🥉 Bronze</th>
                <th class="px-4 py-2 font-extrabold border">Total</th>
                <th class="px-4 py-2 rounded-r-2xl font-extrabold border">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($overview as $row)
                <tr class="bg-white text-gray-900 text-center font-bold shadow-lg rounded-2xl hover:bg-orange-50 transition border px-4 py-2">
                    <td class="px-4 py-2 rounded-l-2xl flex items-center gap-2 justify-center border">
                        @if($row['team']->photo)
                            <img src="{{ asset('storage/' . $row['team']->photo) }}" alt="logo" class="w-8 h-8 rounded-full object-cover border border-gray-300 shadow" />
                        @else
                            <span class="inline-block w-8 h-8 rounded-full bg-gray-200 border border-gray-300"></span>
                        @endif
                        <span>{{ $row['team']->name }}</span>
                    </td>
                    <td class="px-4 py-2 text-yellow-500 font-extrabold border">{{ $row['gold'] }}</td>
                    <td class="px-4 py-2 text-gray-700 font-extrabold border">{{ $row['silver'] }}</td>
                    <td class="px-4 py-2 text-orange-500 font-extrabold border">{{ $row['bronze'] }}</td>
                    <td class="px-4 py-2 text-black font-extrabold border">{{ $row['total'] }}</td>
                    <td class="px-4 py-2 rounded-r-2xl border">
                        <flux:button wire:click="editScoreboard({{ $row['team']->id }})" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-bold shadow transition flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h2m-1 0v14m-7-7h14" /></svg>
                            Edit
                        </flux:button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Update Modal -->
    @if(isset($showModal) && $showModal)
    <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-md flex flex-col gap-6">
            <h2 class="text-xl font-bold mb-4">Update Team Medals</h2>
            <form wire:submit.prevent="saveUpdate">
                <div class="mb-4">
                    <label class="block font-bold mb-2">Select Team</label>
                    <select wire:model="modalTeamId" class="w-full border rounded px-3 py-2">
                        <option value="">-- Choose Team --</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label class="block font-bold mb-2">Gold</label>
                    <input type="number" min="0" wire:model.defer="modalGold" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-2">
                    <label class="block font-bold mb-2">Silver</label>
                    <input type="number" min="0" wire:model.defer="modalSilver" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-2">
                    <label class="block font-bold mb-2">Bronze</label>
                    <input type="number" min="0" wire:model.defer="modalBronze" class="w-full border rounded px-3 py-2">
                </div>
                <div class="flex gap-4 justify-end mt-6">
                    <button type="button" wire:click="closeModal" class="bg-gray-400 text-white px-6 py-2 rounded-lg font-bold">Cancel</button>
                    <button type="submit" class="bg-orange-600 text-white px-6 py-2 rounded-lg font-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
    @endif

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
