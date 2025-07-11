{{-- filepath: resources/views/livewire/technician/technician-schedule.blade.php --}}
<div class="p-6 max-w-4xl mx-auto">
    @if(!$selectedSportName)
    <table class="w-full table-auto border-collapse border border-gray-300">
        <h2 class="text-xl font-bold mb-4">Select a Sport</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            {{-- @foreach($sports as $sport)
                <button wire:click="selectSport('{{ $sport->sport_name }}')" class="bg-blue-600 text-white px-4 py-2 rounded w-full">
                    {{ $sport->sport_name }}
                </button>
            @endforeach --}}
            {{-- PAGE 1: Show sport list --}}
            @foreach($sports as $sport)
                <flux:button variant="primary" wire:click="selectSport('{{ $sport->sport_name }}')" >{{ $sport->sport_name }}</flux:button>
            @endforeach
        </div>
    </table>
    @elseif(!$selectedSchedule)
        {{-- <button wire:click="$set('selectedSportName', null)" class="mb-4 bg-gray-400 text-white px-4 py-2 rounded">Back</button> --}}
        <button wire:click="backToList">Back</button>
        <h2 class="text-xl font-bold mb-4">Schedules for {{ $selectedSportName }}</h2>
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">Date</th>
                    <th class="border px-4 py-2">Time</th>
                    <th class="border px-4 py-2">Gender</th>
                    <th class="border px-4 py-2">Team A</th>
                    <th class="border px-4 py-2">Team B</th>
                    <th class="border px-4 py-2">Score</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schedules as $schedule)
                    <tr>
                        <td class="border px-4 py-2">{{ $schedule->match_date }}</td>
                        <td class="border px-4 py-2">{{ $schedule->match_time }}</td>
                        <td class="border px-4 py-2">{{ $schedule->gender }}</td>
                        <td class="border px-4 py-2">{{ $schedule->teamA->name }}</td>
                        <td class="border px-4 py-2">{{ $schedule->teamB->name }}</td>
                        <td class="border px-4 py-2">
                            {{ $schedule->score_a ?? '-' }} : {{ $schedule->score_b ?? '-' }}
                        </td>
                        <td class="border px-4 py-2">
                            @if($schedule->is_done)
                                <span class="text-green-600">Finalized</span>
                            @else
                                <span class="text-yellow-600">Ongoing</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2">
                            <button wire:click="selectSchedule({{ $schedule->id }})"
                                class="bg-blue-500 text-white px-2 py-1 rounded"
                                @if($schedule->is_done) disabled @endif>
                                Update Score
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">No schedules found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @else
        {{-- <button wire:click="backToList" class="mb-4 bg-gray-400 text-white px-4 py-2 rounded">Back</button> --}}
        <button wire:click="backToList">Back</button>

        <h2 class="text-xl font-bold mb-4">
            Update Score: {{ $selectedSchedule->teamA->name }} vs {{ $selectedSchedule->teamB->name }}
            ({{ $selectedSchedule->gender }}, {{ $selectedSchedule->match_date }} {{ $selectedSchedule->match_time }})
        </h2>
        @if(session()->has('success'))
            <div class="mb-2 text-green-600">{{ session('success') }}</div>
        @endif
        <form wire:submit.prevent="updateScore" class="space-y-4">
            <div class="flex space-x-4 items-center">
                <div>
                    <label class="block font-semibold mb-1">{{ $selectedSchedule->teamA->name }}</label>
                    <input type="number" wire:model="score_a" class="border p-2 rounded w-24" @if($is_done) disabled @endif>
                </div>
                <span class="font-bold text-xl">:</span>
                <div>
                    <label class="block font-semibold mb-1">{{ $selectedSchedule->teamB->name }}</label>
                    <input type="number" wire:model="score_b" class="border p-2 rounded w-24" @if($is_done) disabled @endif>
                </div>
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded" @if($is_done) disabled @endif>
                    Save Score
                </button>
                @if(!$is_done)
                    <button type="button" wire:click="finalize" class="bg-green-600 text-black px-4 py-2 rounded">
                        Done (Finalize)
                    </button>
                @endif
            </div>
            @if($is_done)
                <div class="text-green-600 mt-2">This match is finalized. Score cannot be edited.</div>
            @endif
        </form>
    @endif
</div>
