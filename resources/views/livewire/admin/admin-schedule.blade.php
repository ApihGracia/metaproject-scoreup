<div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Manage Match Schedules</h1>

    <form wire:submit.prevent="save" class="mb-6 space-y-4">
        <div>

            @if($this->allMatchesDone($sport_id, $gender, 'Quarterfinal'))
                <button wire:click="generateNextRound({{ $sport_id }}, '{{ $gender }}', 'Quarterfinal')" class="mt-4 bg-purple-600 text-white px-4 py-2 rounded">
                    Generate Semifinal
                </button>
            @endif
            @if($this->allMatchesDone($sport_id, $gender, 'Semifinal'))
                <button wire:click="generateNextRound({{ $sport_id }}, '{{ $gender }}', 'Semifinal')" class="mt-2 bg-pink-600 text-white px-4 py-2 rounded">
                    Generate Final
                </button>
            @endif

            <label>Sport</label>
            <select wire:model="sport_id" class="border p-2 rounded w-full">
                <option value="">Select Sport</option>
                @foreach($sports as $sport)
                    {{-- <option value="{{ $sport->id }}">{{ $sport->sport_name }}</option> --}}
                    <option value="{{ $sport->id }}">{{ $sport->sport_name }} ({{ $sport->gender }})</option>
                @endforeach
            </select>
            @error('sport_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            {{-- <label>Gender</label>
            <input type="text" class="border p-2 rounded w-full bg-gray-100" value="{{ $gender }}" readonly> --}}
            <label>Gender</label>
            {{-- <input type="text" class="border p-2 rounded w-full bg-gray-100" value="{{ $gender }}" readonly> --}}
            <select wire:model="gender" class="border p-2 rounded w-full">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Mixed">Mixed</option>
            </select>
            @error('gender') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="flex space-x-2">
            <div class="w-1/2">
                <label>Team A</label>
                <select wire:model="team_a_id" class="border p-2 rounded w-full">
                    <option value="">Select Team A</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
                @error('team_a_id') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-1/2">
                <label>Team B</label>
                <select wire:model="team_b_id" class="border p-2 rounded w-full">
                    <option value="">Select Team B</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
                @error('team_b_id') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>
        <div>
            <label>Date</label>
            <input type="date" wire:model="match_date" class="border p-2 rounded w-full">
            @error('match_date') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Time</label>
            <input type="time" wire:model="match_time" class="border p-2 rounded w-full">
            @error('match_time') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Venue</label>
            <input type="text" wire:model="venue" class="border p-2 rounded w-full">
            @error('venue') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Stage/Round</label>
            <input type="text" wire:model="round" class="border p-2 rounded w-full" placeholder="Quarterfinal, Semifinal, Final">
            @error('round') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ $editId ? 'Update Match' : 'Add Match' }}
            </button>
            @if($editId)
                <button type="button" wire:click="$set('editId', null)" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
            @endif
        </div>
    </form>

    <h2 class="text-xl font-semibold mb-2">All Matches</h2>
    <table class="w-full table-auto border-collapse border rounded-3xl overflow-hidden shadow-lg border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Date</th>
                <th class="border px-4 py-2">Time</th>
                <th class="border px-4 py-2">Sport</th>
                <th class="border px-4 py-2">Gender</th>
                <th class="border px-4 py-2">Team A</th>
                <th class="border px-4 py-2">Team B</th>
                <th class="border px-4 py-2">Score</th>
                <th class="border px-4 py-2">Stage</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schedules as $match)
                <tr>
                    <td class="border px-4 py-2">{{ $match->match_date }}</td>
                    <td class="border px-4 py-2">{{ $match->match_time }}</td>
                    <td class="border px-4 py-2">{{ $match->sport->sport_name }}</td>
                    <td class="border px-4 py-2">{{ $match->gender }}</td>
                    <td class="border px-4 py-2">{{ $match->teamA->name }}</td>
                    <td class="border px-4 py-2">{{ $match->teamB->name }}</td>
                    <td class="border px-4 py-2">
                        {{ $match->score_a ?? '-' }} : {{ $match->score_b ?? '-' }}
                    </td>
                    <td class="border px-4 py-2">{{ $match->round }}</td>
                    <td class="border px-4 py-2">
                        @if($match->is_done)
                            <span class="text-green-600">Finalized</span>
                        @else
                            <span class="text-yellow-600">Ongoing</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $match->id }})" class="bg-yellow-400 text-white px-2 py-1 rounded">Edit</button>
                        <button wire:click="delete({{ $match->id }})" class="bg-red-500 text-white px-2 py-1 rounded ml-2"
                            onclick="return confirm('Are you sure you want to delete this match?')">Delete</button>
                        @if(!$match->is_done)
                            <button wire:click="finalize({{ $match->id }})" class="bg-green-600 text-white px-2 py-1 rounded ml-2">Finalize</button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center py-4">No matches found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Bracket generation buttons --}}
    @foreach($sports as $sport)
        @foreach(['Male','Female','Mixed'] as $gender)
            @if(app('App\\Livewire\\Admin\\AdminSchedule')->allMatchesDone($sport->id, $gender, 'Quarterfinal'))
                <button wire:click="generateNextRound({{ $sport->id }}, '{{ $gender }}', 'Quarterfinal')" class="mt-4 bg-purple-600 text-white px-4 py-2 rounded">
                    Generate Semifinal for {{ $sport->sport_name }} ({{ $gender }})
                </button>
            @endif
            @if(app('App\\Livewire\\Admin\\AdminSchedule')->allMatchesDone($sport->id, $gender, 'Semifinal'))
                <button wire:click="generateNextRound({{ $sport->id }}, '{{ $gender }}', 'Semifinal')" class="mt-2 bg-pink-600 text-white px-4 py-2 rounded">
                    Generate Final for {{ $sport->sport_name }} ({{ $gender }})
                </button>
            @endif
        @endforeach
    @endforeach
</div>


{{-- <div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Manage Match Schedules</h1>

    <form wire:submit.prevent="save" class="mb-6 space-y-4">
        <div>
            <label>Sport</label>
            <select wire:model="sport_id" class="border p-2 rounded w-full">
                <option value="">Select Sport</option>
                @foreach($sports as $sport)
                    <option value="{{ $sport->id }}">{{ $sport->sport_name }} ({{ $sport->gender }})</option>
                @endforeach
            </select>
            @error('sport_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Gender</label> --}}
            {{-- <input type="text" class="border p-2 rounded w-full bg-gray-100" value="{{ $gender }}" readonly> --}}
            {{-- <select wire:model="gender" class="border p-2 rounded w-full">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Mixed">Mixed</option>
            </select>
            @error('gender') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="flex space-x-2">
            <div class="w-1/2">
                <label>Team A</label>
                <select wire:model="team_a_id" class="border p-2 rounded w-full">
                    <option value="">Select Team A</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
                @error('team_a_id') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-1/2">
                <label>Team B</label>
                <select wire:model="team_b_id" class="border p-2 rounded w-full">
                    <option value="">Select Team B</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
                @error('team_b_id') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>
        <div>
            <label>Date</label>
            <input type="date" wire:model="match_date" class="border p-2 rounded w-full">
            @error('match_date') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Time</label>
            <input type="time" wire:model="match_time" class="border p-2 rounded w-full">
            @error('match_time') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Venue</label>
            <input type="text" wire:model="venue" class="border p-2 rounded w-full">
            @error('venue') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Stage (optional)</label>
            <input type="text" wire:model="stage" class="border p-2 rounded w-full" placeholder="e.g. Semifinal, Final">
            @error('stage') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ $editId ? 'Update Match' : 'Add Match' }}
            </button>
            @if($editId)
                <button type="button" wire:click="$set('editId', null)" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
            @endif
        </div>
    </form>

    <h2 class="text-xl font-semibold mb-2">All Matches</h2>
    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Date</th>
                <th class="border px-4 py-2">Time</th>
                <th class="border px-4 py-2">Sport</th>
                <th class="border px-4 py-2">Gender</th>
                <th class="border px-4 py-2">Team A</th>
                <th class="border px-4 py-2">Team B</th>
                <th class="border px-4 py-2">Venue</th>
                <th class="border px-4 py-2">Stage</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schedules as $match)
                <tr>
                    <td class="border px-4 py-2">{{ $match->match_date }}</td>
                    <td class="border px-4 py-2">{{ $match->match_time }}</td>
                    <td class="border px-4 py-2">{{ $match->sport->sport_name }}</td>
                    <td class="border px-4 py-2">{{ $match->gender }}</td>
                    <td class="border px-4 py-2">{{ $match->teamA->name }}</td>
                    <td class="border px-4 py-2">{{ $match->teamB->name }}</td>
                    <td class="border px-4 py-2">{{ $match->venue }}</td>
                    <td class="border px-4 py-2">{{ $match->stage }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $match->id }})" class="bg-yellow-400 text-white px-2 py-1 rounded">Edit</button>
                        <button wire:click="delete({{ $match->id }})" class="bg-red-500 text-white px-2 py-1 rounded ml-2"
                            onclick="return confirm('Are you sure you want to delete this match?')">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center py-4">No matches found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div> --}}
