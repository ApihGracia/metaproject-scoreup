
<div>
    <div class="flex items-center justify-between mb-4">
        <div class="view-toggle-row flex gap-2">
            <button wire:click="$set('viewType', 'grid')" class="view-toggle-btn {{ $viewType === 'grid' ? 'active' : '' }}">Grid View</button>
            <button wire:click="$set('viewType', 'list')" class="view-toggle-btn {{ $viewType === 'list' ? 'active' : '' }}">List View</button>
        </div>
        <button wire:click="$set('showFilter', true)" class="bg-red-600 text-white px-4 py-2 rounded flex items-center gap-2 shadow-lg font-bold text-lg hover:bg-red-700 transition">
            <span>Filter</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-5.414 5.414A1 1 0 0015 13v5a1 1 0 01-1 1h-4a1 1 0 01-1-1v-5a1 1 0 00-.293-.707L3.293 6.707A1 1 0 013 6V4z" /></svg>
        </button>
    </div>

    <!-- Filter Modal -->
    @if($showFilter)
    <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-md flex flex-col gap-6">
            <div>
                <div class="font-bold mb-2 text-lg">Sport</div>
                <div class="flex flex-wrap gap-2">
                    <button wire:click="$set('filterSport', '')" class="px-4 py-2 rounded-lg font-bold text-base {{ $filterSport == '' ? 'bg-red-600 text-white' : 'bg-gray-400 text-white' }}">All</button>
                    @foreach($sports as $sport)
                        <button wire:click="$set('filterSport', {{ $sport->id }})" class="px-4 py-2 rounded-lg font-bold text-base {{ $filterSport == $sport->id ? 'bg-red-600 text-white' : 'bg-gray-400 text-white' }}">{{ $sport->sport_name }}</button>
                    @endforeach
                </div>
            </div>
            <div>
                <div class="font-bold mb-2 text-lg">Gender</div>
                <div class="flex gap-2">
                    <button wire:click="$set('filterGender', '')" class="px-4 py-2 rounded-lg font-bold text-base {{ $filterGender == '' ? 'bg-red-600 text-white' : 'bg-gray-400 text-white' }}">All</button>
                    <button wire:click="$set('filterGender', 'Male')" class="px-4 py-2 rounded-lg font-bold text-base {{ $filterGender == 'Male' ? 'bg-red-600 text-white' : 'bg-gray-400 text-white' }}">Male</button>
                    <button wire:click="$set('filterGender', 'Female')" class="px-4 py-2 rounded-lg font-bold text-base {{ $filterGender == 'Female' ? 'bg-red-600 text-white' : 'bg-gray-400 text-white' }}">Female</button>
                    <button wire:click="$set('filterGender', 'Mixed')" class="px-4 py-2 rounded-lg font-bold text-base {{ $filterGender == 'Mixed' ? 'bg-red-600 text-white' : 'bg-gray-400 text-white' }}">Mixed</button>
                </div>
            </div>
            <div class="flex gap-4 justify-end mt-8">
                <button wire:click="cancelFilter" class="bg-gray-400 text-white px-6 py-2 rounded-lg font-bold text-base">Cancel</button>
                <button wire:click="applyFilter" class="bg-red-600 text-white px-6 py-2 rounded-lg font-bold text-base">Apply</button>
            </div>
        </div>
    </div>
    @endif

    @if($viewType === 'grid')
        <div class="schedule-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($this->filteredSchedules as $match)
                <div class="match-card">
                    <div class="match-type">{{ $match->sport->sport_name }}</div>
                    <div class="match-info">{{ $match->match_date }} &bull; {{ $match->match_time }}</div>
                    <div class="match-teams">
                        <span>{{ $match->teamA->name }}</span>
                        <span class="match-score">{{ $match->score_a ?? '-' }} : {{ $match->score_b ?? '-' }}</span>
                        <span>{{ $match->teamB->name }}</span>
                    </div>
                    <div class="match-status">{{ $match->is_done ? 'Finalized' : 'Ongoing' }}</div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-400 py-8">No matches found.</div>
            @endforelse
        </div>
    @else
        <div class="flex flex-col gap-6">
            @php
                $sorted = $this->filteredSchedules->sort(function($a, $b) {
                    $ad = strtotime($a->match_date.' '.$a->match_time);
                    $bd = strtotime($b->match_date.' '.$b->match_time);
                    return $ad <=> $bd;
                });
            @endphp
            @forelse($sorted as $match)
                <div class="bg-gray-900 rounded-2xl shadow-lg p-6 flex items-center justify-between border border-gray-700 hover:shadow-xl transition-shadow">
                    <div class="flex items-center gap-4 w-1/3">
                        <img src="{{ $match->teamA->photo ? Storage::url($match->teamA->photo) : '/scoreup-logo.svg' }}" class="h-12 w-12 rounded-full object-cover" alt="Logo">
                        <span class="text-white font-bold text-lg">{{ $match->teamA->name }}</span>
                    </div>
                    <div class="flex flex-col items-center w-1/3">
                        <span class="text-yellow-400 font-bold text-xl">{{ $match->score_a ?? '-' }} : {{ $match->score_b ?? '-' }}</span>
                        <span class="text-gray-300 text-sm">{{ $match->match_date }} &bull; {{ $match->match_time }}</span>
                    </div>
                    <div class="flex items-center gap-4 w-1/3 justify-end">
                        <img src="{{ $match->teamB->photo ? Storage::url($match->teamB->photo) : '/scoreup-logo.svg' }}" class="h-12 w-12 rounded-full object-cover" alt="Logo">
                        <span class="text-white font-bold text-lg">{{ $match->teamB->name }}</span>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-400 py-8">No matches found.</div>
            @endforelse
        </div>
    @endif
</div>
