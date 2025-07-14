{{-- filepath: resources/views/livewire/admin/schedule-detail.blade.php --}}
<div class="p-6 max-w-6xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div class="flex gap-2">
            <flux:input wire:model="search" type="text" placeholder="Search team or venue..." class="w-64" />
            <flux:select wire:model="filterSport" class="w-40">
                <option value="">All Sports</option>
                @foreach($sports as $sport)
                    <option value="{{ $sport->id }}">{{ $sport->sport_name }}</option>
                @endforeach
            </flux:select>
            <flux:select wire:model="filterStatus" class="w-40">
                <option value="">All Status</option>
                <option value="finalized">Finalized</option>
                <option value="ongoing">Ongoing</option>
            </flux:select>
        </div>
            <flux:button wire:click="goBack" variant="primary" color="emerald">Match Game Begin Here</flux:button>
        </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 ">
        @forelse($this->filteredSchedules as $match)
            <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col justify-between border border-gray-200 hover:shadow-xl transition-shadow bg-gradient-to-r from-blue-100 to-purple-100">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs px-2 py-1 rounded bg-blue-100 text-blue-700 font-semibold">{{ $match->round }}</span>
                        <span class="text-xs px-2 py-1 rounded bg-purple-100 text-purple-700 font-semibold">{{ $match->stage }}</span>
                    </div>
                    <div class="font-bold text-lg mb-1">{{ $match->sport->sport_name }} <span class="text-sm text-gray-500">({{ $match->gender }})</span></div>
                    <div class="mb-2 text-sm text-gray-600">{{ $match->match_date }} &bull; {{ $match->match_time }}</div>
                    <div class="mb-2 flex items-center justify-between">
                        <span class="font-semibold">{{ $match->teamA->name }}</span>
                        <span class="px-2 py-1 rounded bg-gray-100 text-gray-700 font-bold">{{ $match->score_a ?? '-' }} : {{ $match->score_b ?? '-' }}</span>
                        <span class="font-semibold">{{ $match->teamB->name }}</span>
                    </div>
                    <div class="mb-2 text-sm text-gray-500">Venue: {{ $match->venue }}</div>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <span>
                        @if($match->is_done)
                            <span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs">Finalized</span>
                        @else
                            <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-700 text-xs">Ongoing</span>
                        @endif
                    </span>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-400 py-8">No matches found.</div>
        @endforelse
    </div>
</div>