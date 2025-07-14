@if($showDetail)
    @include('livewire.admin.schedule-detail')
@else

<div class="p-20 max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Manage Match Schedules</h1>

    <flux:button wire:click="$set('showModal', true)">
        Add Schedule
    </flux:button>

    <flux:button wire:click="showScheduleDetail" class="mb-4">
        Schedule Detail
    </flux:button>

    <flux:modal wire:model="showModal">
        <div class="p-6">
            <h2 class="text-xl font-bold mb-4">Add Match Schedule</h2>
            <form wire:submit.prevent="save">
                <div class="mb-4">
                    <flux:select wire:model="sport_id" :label="'Sport'">
                        <option value="">Select Sport</option>
                        @foreach($sports as $sport)
                            <option value="{{ $sport->id }}">{{ $sport->sport_name }} ({{ $sport->gender }})</option>
                        @endforeach
                    </flux:select>
                    @error('sport_id') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <flux:select wire:model="gender" :label="'Gender'">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Mixed">Mixed</option>
                    </flux:select>
                    @error('gender') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4 flex gap-2">
                    <div class="w-1/2">
                        <flux:select wire:model="team_a_id" :label="'Team A'">
                            <option value="">Select Team A</option>
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </flux:select>
                        @error('team_a_id') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="w-1/2">
                        <flux:select wire:model="team_b_id" :label="'Team B'">
                            <option value="">Select Team B</option>
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </flux:select>
                        @error('team_b_id') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <flux:input wire:model="match_date" :label="'Date'" type="date" />
                    @error('match_date') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <flux:input wire:model="match_time" :label="'Time'" type="time" />
                    @error('match_time') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <flux:input wire:model="venue" :label="'Venue'" type="text" />
                    @error('venue') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <flux:input wire:model="round" :label="'Stage/Round'" type="text" placeholder="Quarterfinal, Semifinal, Final" />
                    @error('round') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                {{-- <div class="mb-4">
                    <flux:input wire:model="photo" :label="'Image/Logo'" type="file" accept="image/*" />
                    @error('photo') <span class="text-red-500">{{ $message }}</span> @enderror
                </div> --}}
                <div class="flex gap-2 justify-end">
                    {{-- <flux:button variant="secondary" type="button" wire:click="$set('showModal', false)">Cancel</flux:button> --}}
                    <flux:button type="submit">Save</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <table class="w-full table-auto border-collapse rounded-2xl overflow-hidden shadow-lg border border-gray-300 mt-6">
        <thead>
            <tr class="bg-gradient-to-r from-yellow-400 via-orange-400 to-red-500 text-black text-lg">
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
                <tr class="bg-gradient-to-r from-blue-100 to-purple-100">
                    <td class="border px-4 py-2">{{ $match->match_date }}</td>
                    <td class="border px-4 py-2">{{ $match->match_time }}</td>
                    <td class="border px-4 py-2">{{ $match->sport->sport_name }}</td>
                    <td class="border px-4 py-2">{{ $match->gender }}</td>
                    <td class="border px-4 py-2">{{ $match->teamA->name }}</td>
                    <td class="border px-4 py-2">{{ $match->teamB->name }}</td>
                    <td class="border px-4 py-2">{{ $match->score_a ?? '-' }} : {{ $match->score_b ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $match->round }}</td>
                    <td class="border px-4 py-2">
                        @if($match->is_done)
                            <span class="text-green-600">Finalized</span>
                        @else
                            <span class="text-yellow-600">Ongoing</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        <div class="flex space-x-1">
                            <flux:button size="sm" variant="primary" wire:click="edit({{ $match->id }})" class="bg-yellow-400 hover:bg-yellow-500 text-white rounded px-2 py-1">Edit</flux:button>
                            <flux:button size="sm" variant="primary" color="red" wire:click="delete({{ $match->id }})" class="bg-red-500 hover:bg-red-600 text-white rounded px-2 py-1">Delete</flux:button>
                            @if(!$match->is_done)
                                <flux:button size="sm" variant="primary" color="green" wire:click="finalize({{ $match->id }})" class="bg-green-500 hover:bg-green-600 text-white rounded px-2 py-1">Finalize</flux:button>
                            @endif
                        </div>
                    </td>
                    {{-- Uncomment if you want to add edit/delete buttons
                    {{-- <td class="border px-4 py-2">
                        <flux:button size="sm" wire:click="edit({{ $match->id }})">Edit</flux:button>
                        <flux:button size="sm" wire:click="delete({{ $match->id }})">Delete</flux:button>
                        @if(!$match->is_done)
                            <flux:button size="sm" wire:click="finalize({{ $match->id }})">Finalize</flux:button>
                        @endif
                    </td> --}}
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center py-4">No matches found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>


@endif

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
