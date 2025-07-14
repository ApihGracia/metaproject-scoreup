
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ScoreUp | Chase Your Dream</title>
    <link rel="icon" href="/scoreup-logo.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        body {
            margin: 0;
            font-family: 'Montserrat', Arial, sans-serif;
            background: #E9E3E6;
            color: #1F2937;
        }
        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 2rem 3rem 0 3rem;
            width: 100%;
            z-index: 10;
        }
        .nav-logo {
            font-size: 2.2rem;
            font-weight: 900;
            color: #DC2626;
            letter-spacing: -2px;
        }
        .nav-actions {
            display: flex;
            gap: 1.2rem;
            align-items: center;
        }
        .nav-actions a {
            background: #DC2626;
            color: #fff;
            border-radius: 2rem;
            padding: 0.7rem 2.7rem;
            font-weight: 700;
            font-size: 1.1rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        .nav-actions a:hover {
            background: #F97316;
            color: #fff;
        }
        .main-card-row {
            display: flex;
            gap: 2.5rem;
            margin: 2.5rem auto 0 auto;
            max-width: 1100px;
            justify-content: center;
        }
        .main-card {
            background: #fff;
            border-radius: 2.2rem;
            box-shadow: 0 2px 16px rgba(220,38,38,0.08);
            padding: 2.2rem 2.5rem 1.7rem 2.5rem;
            min-width: 340px;
            max-width: 480px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 2px solid #E5E7EB;
        }
        .slider-img {
            width: 100%;
            height: 260px;
            object-fit: cover;
            border-radius: 1.5rem;
            box-shadow: 0 2px 12px rgba(220,38,38,0.10);
        }
        .slider-controls {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        .slider-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #E5E7EB;
            cursor: pointer;
        }
        .slider-dot.active {
            background: #DC2626;
        }
        .main-card-quote {
            font-size: 1.5rem;
            font-weight: 700;
            color: #DC2626;
            margin-top: 2.5rem;
            text-align: center;
        }
        .nav-tabs {
            display: flex;
            justify-content: center;
            gap: 2.5rem;
            margin: 2.5rem auto 0 auto;
            max-width: 900px;
        }
        .nav-tab {
            background: #fff;
            color: #DC2626;
            font-weight: 700;
            font-size: 1.2rem;
            border-radius: 1.5rem 1.5rem 0 0;
            padding: 1rem 2.5rem;
            border: 2px solid #DC2626;
            border-bottom: none;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        .nav-tab.active {
            background: #DC2626;
            color: #fff;
        }
        .schedule-section {
            background: #fff;
            border-radius: 2rem;
            box-shadow: 0 2px 16px rgba(220,38,38,0.08);
            padding: 2.2rem 2.5rem 1.7rem 2.5rem;
            max-width: 1100px;
            margin: 0 auto 2.5rem auto;
        }
        .schedule-header {
            font-size: 2rem;
            font-weight: 900;
            color: #DC2626;
            margin-bottom: 1.5rem;
        }
        .schedule-filters {
            display: flex;
            gap: 1.2rem;
            margin-bottom: 1.5rem;
        }
        .schedule-filters select {
            padding: 0.7rem 1.2rem;
            border-radius: 1rem;
            border: 2px solid #E5E7EB;
            font-size: 1rem;
            font-weight: 600;
            color: #1F2937;
        }
        .view-toggle-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .view-toggle-btn {
            background: #fff;
            color: #DC2626;
            border-radius: 1.5rem;
            padding: 0.7rem 2rem;
            font-weight: 700;
            font-size: 1.1rem;
            border: 2px solid #DC2626;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        .view-toggle-btn.active {
            background: #DC2626;
            color: #fff;
        }
        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }
        .match-card {
            background: #fff;
            border-radius: 1.5rem;
            box-shadow: 0 2px 12px rgba(220,38,38,0.10);
            padding: 1.5rem 1.2rem 1.2rem 1.2rem;
            border: 2px solid #E5E7EB;
            display: flex;
            flex-direction: column;
            gap: 0.7rem;
        }
        .match-card .match-type {
            font-size: 1.1rem;
            font-weight: 700;
            color: #DC2626;
            margin-bottom: 0.5rem;
        }
        .match-card .match-info {
            font-size: 1rem;
            color: #1F2937;
            font-weight: 600;
        }
        .match-card .match-teams {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .match-card .match-score {
            background: #F97316;
            color: #fff;
            border-radius: 1rem;
            padding: 0.3rem 1.2rem;
            font-size: 1.1rem;
            font-weight: 900;
        }
        .match-card .match-status {
            font-size: 0.95rem;
            font-weight: 700;
            color: #22C55E;
        }
        .schedule-list {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        @media (max-width: 1100px) {
            .main-card-row, .schedule-section { max-width: 100%; }
            .schedule-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 900px) {
            .main-card-row { flex-direction: column; align-items: center; gap: 1.5rem; }
            .schedule-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 700px) {
            .nav { flex-direction: column; gap: 1rem; padding: 1rem; }
            .main-card { min-width: 90vw; max-width: 98vw; }
            .schedule-section { padding: 1rem; }
        }
    </style>
</head>
<body x-data="{ slider: 0, images: [
    '/storage/backgrounds/POSTER_BADMINTON.jpg',
    '/storage/backgrounds/POSTER_BOLASEPAK.jpg',
    '/storage/backgrounds/POSTER_FRISBEE.jpg',
    '/storage/backgrounds/POSTER_NETBALL.jpg'
], timer: null }" x-init="timer = setInterval(() => { slider = (slider + 1) % images.length }, 2000)">
    <div class="nav">
        <img src="/scoreup-logo.svg" alt="ScoreUp Logo" style="height:60px; margin-right:1rem; border-radius:12px; box-shadow:0 2px 8px rgba(220,38,38,0.10); background:#fff;">
        <div class="nav-actions">
            <a href="{{ route('login') }}">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        </div>
    </div>

    <!-- Single Card View for Landscape Poster -->
    <div style="width:100%; display:flex; justify-content:center; align-items:center; margin-top:2rem;">
        <div class="main-card" style="max-width:1000px; width:100%; margin:0 auto; display:flex; flex-direction:column; align-items:center;">
            <img src="/storage/backgrounds/MAIN_POSTER.jpg" alt="Landscape Poster" class="slider-img" style="height:320px; object-fit:cover; border-radius:1.5rem; box-shadow:0 2px 12px rgba(220,38,38,0.10); display:block; margin:auto;">
        </div>
    </div>

    <div class="main-card-row">
        <div class="main-card" style="flex:1;">
            <div style="width:100%;">
                <img :src="images[slider]" class="slider-img" alt="Sport Image">
                <div class="slider-controls">
                    <template x-for="(img, idx) in images">
                        <div :class="'slider-dot' + (slider === idx ? ' active' : '')" @click="slider = idx"></div>
                    </template>
                </div>
            </div>
        </div>
        <div class="main-card" style="flex:1; display:flex; align-items:center; justify-content:center;">
            <div class="main-card-quote">Upcoming event soon!<br>stay tune</div>
        </div>
    </div>

    <div x-data="Object.assign({ tab: 'schedule' }, scheduleComponent())">
        <div class="nav-tabs">
            <button @click="tab = 'rules'" :class="tab === 'rules' ? 'nav-tab active' : 'nav-tab'">Rules</button>
            <button @click="tab = 'scoreboard'" :class="tab === 'scoreboard' ? 'nav-tab active' : 'nav-tab'">Live Scoreboard</button>
            <button @click="tab = 'schedule'" :class="tab === 'schedule' ? 'nav-tab active' : 'nav-tab'">Schedule</button>
        </div>

        <div x-show="tab === 'schedule'" class="schedule-section w-full max-w-full mx-auto px-2">
            <div class="schedule-header">Match Schedule</div>
            <div class="flex items-center justify-between mb-4">
                <div class="view-toggle-row flex gap-2">
                    <button @click="viewType = 'grid'" :class="viewType === 'grid' ? 'view-toggle-btn active' : 'view-toggle-btn'">Grid View</button>
                    <button @click="viewType = 'list'" :class="viewType === 'list' ? 'view-toggle-btn active' : 'view-toggle-btn'">List View</button>
                </div>
                <button @click="showFilter = true" class="bg-red-600 text-white px-4 py-2 rounded flex items-center gap-2 shadow-lg font-bold text-lg hover:bg-red-700 transition">
                    <span>Filter</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-5.414 5.414A1 1 0 0015 13v5a1 1 0 01-1 1h-4a1 1 0 01-1-1v-5a1 1 0 00-.293-.707L3.293 6.707A1 1 0 013 6V4z" /></svg>
                </button>
            </div>
            <!-- Filter Modal -->
            <div x-show="showFilter" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
                <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-md flex flex-col gap-6">
                    <div>
                        <div class="font-bold mb-2 text-lg">Sport</div>
                        <div class="flex flex-wrap gap-2">
                            <button @click="filterSport = ''" :class="filterSport === '' ? 'px-4 py-2 rounded-lg font-bold text-base bg-red-600 text-white' : 'px-4 py-2 rounded-lg font-bold text-base bg-gray-400 text-white'">All</button>
                            <template x-for="sport in sports" :key="sport.id">
                                <button @click="filterSport = sport.id" :class="filterSport === sport.id ? 'px-4 py-2 rounded-lg font-bold text-base bg-red-600 text-white' : 'px-4 py-2 rounded-lg font-bold text-base bg-gray-400 text-white'" x-text="sport.sport_name"></button>
                            </template>
                        </div>
                    </div>
                    <div>
                        <div class="font-bold mb-2 text-lg">Gender</div>
                        <div class="flex gap-2">
                            <button @click="filterGender = ''" :class="filterGender === '' ? 'px-4 py-2 rounded-lg font-bold text-base bg-red-600 text-white' : 'px-4 py-2 rounded-lg font-bold text-base bg-gray-400 text-white'">All</button>
                            <button @click="filterGender = 'Male'" :class="filterGender === 'Male' ? 'px-4 py-2 rounded-lg font-bold text-base bg-red-600 text-white' : 'px-4 py-2 rounded-lg font-bold text-base bg-gray-400 text-white'">Male</button>
                            <button @click="filterGender = 'Female'" :class="filterGender === 'Female' ? 'px-4 py-2 rounded-lg font-bold text-base bg-red-600 text-white' : 'px-4 py-2 rounded-lg font-bold text-base bg-gray-400 text-white'">Female</button>
                            <button @click="filterGender = 'Mixed'" :class="filterGender === 'Mixed' ? 'px-4 py-2 rounded-lg font-bold text-base bg-red-600 text-white' : 'px-4 py-2 rounded-lg font-bold text-base bg-gray-400 text-white'">Mixed</button>
                        </div>
                    </div>
                    <div class="flex gap-4 justify-end mt-8">
                        <button @click="showFilter = false" class="bg-gray-400 text-white px-6 py-2 rounded-lg font-bold text-base">Cancel</button>
                        <button @click="showFilter = false" class="bg-red-600 text-white px-6 py-2 rounded-lg font-bold text-base">Apply</button>
                    </div>
                </div>
            </div>

            <template x-if="viewType === 'grid'">
                {{-- <div class="schedule-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $schedules = \App\Models\Schedule::with(['sport', 'teamA', 'teamB'])->orderBy('match_date')->get();
                @endphp
                @forelse($schedules as $match)
                    <div class="match-card flex flex-col gap-2">
                        <div class="flex items-center gap-2 mb-1">

                            @if($match->teamA && $match->teamA->photo)
                                <img src="{{ asset('storage/' . $match->teamA->photo) }}" alt="logo" class="w-7 h-7 rounded-full object-cover border border-gray-300" />
                            @else
                                <span class="inline-block w-7 h-7 rounded-full bg-gray-200 border border-gray-300"></span>
                            @endif

                            <span class="font-bold text-base">{{ $match->teamA->name ?? '-' }}</span>
                            <span class="mx-2 font-bold text-gray-600">vs</span>

                            @if($match->teamB && $match->teamB->photo)
                                <img src="{{ asset('storage/' . $match->teamB->photo) }}" alt="logo" class="w-7 h-7 rounded-full object-cover border border-gray-300" />
                            @else
                                <span class="inline-block w-7 h-7 rounded-full bg-gray-200 border border-gray-300"></span>
                            @endif

                            <span class="font-bold text-base">{{ $match->teamB->name ?? '-' }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="font-semibold text-gray-700">Gender:</span>
                            <span>{{ $match->gender }}</span>
                            <span class="ml-4 font-semibold text-gray-700">Score:</span>
                            <span class="font-bold">{{ $match->score_a ?? '-' }} : {{ $match->score_b ?? '-' }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="font-semibold text-gray-700">Status:</span>
                            @if($match->is_done)
                                <span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs">Finalized</span>
                            @else
                                <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-700 text-xs">Ongoing</span>
                            @endif
                        </div>
                    </div>
                    @empty
                        <div class="col-span-full text-center text-gray-400 py-8">No matches found.</div>
                    @endforelse
                </div> --}}

                <div class="schedule-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @php
                        $schedules = \App\Models\Schedule::with(['sport', 'teamA', 'teamB'])->orderBy('match_date')->get();
                    @endphp
                    @forelse($schedules as $match)
                        <template x-for="match in filteredSchedules" :key="match.id">
                            <div class="match-card">
                                <div class="match-type" x-text="match.sport.sport_name"></div>
                                <div class="match-info" x-text="match.match_date + ' • ' + match.match_time"></div>
                                <div class="match-teams">
                                    <span font-bold text-base>{{ $match->teamA->name ?? '-' }}</span>
                                    <span class="match-score" x-text="{{ $match->score_a ?? '-' }} + ' : ' + {{ $match->score_b ?? '-' }}"></span>
                                    <span font-bold text-base>{{ $match->teamB->name ?? '-' }}</span>
                                </div>
                                <div class="match-status" x-text="match.is_done ? 'Finalized' : 'Ongoing'"></div>
                            </div>
                        </template>
                        <template x-if="filteredSchedules.length === 0">
                            <div class="col-span-full text-center text-gray-400 py-8">No matches found.</div>
                        </template>
                    @empty
                        <div class="col-span-full text-center text-gray-400 py-8">No matches found.</div>
                    @endforelse
                </div>
            </template>

            <template x-if="viewType === 'list'">
                <div class="schedule-list flex flex-col gap-4">
                @php
                    $schedules = \App\Models\Schedule::with(['sport', 'teamA', 'teamB'])->orderBy('match_date')->get();
                @endphp
                @forelse($schedules as $match)
                    <div class="bg-white rounded-2xl shadow-lg p-4 flex items-center gap-4 border border-gray-200 hover:shadow-xl transition-shadow">
                        @if($match->teamA && $match->teamA->photo)
                            <img src="{{ asset('storage/' . $match->teamA->photo) }}" alt="logo" class="w-8 h-8 rounded-full object-cover border border-gray-300" />
                        @else
                            <span class="inline-block w-8 h-8 rounded-full bg-gray-200 border border-gray-300"></span>
                        @endif
                        <span class="font-bold text-base">{{ $match->teamA->name ?? '-' }}</span>
                        <span class="mx-2 font-bold text-gray-600">vs</span>
                        @if($match->teamB && $match->teamB->photo)
                            <img src="{{ asset('storage/' . $match->teamB->photo) }}" alt="logo" class="w-8 h-8 rounded-full object-cover border border-gray-300" />
                        @else
                            <span class="inline-block w-8 h-8 rounded-full bg-gray-200 border border-gray-300"></span>
                        @endif
                        <span class="font-bold text-base">{{ $match->teamB->name ?? '-' }}</span>
                        <span class="ml-4 font-semibold text-gray-700">Gender:</span>
                        <span>{{ $match->gender }}</span>
                        <span class="ml-4 font-semibold text-gray-700">Score:</span>
                        <span class="font-bold">{{ $match->score_a ?? '-' }} : {{ $match->score_b ?? '-' }}</span>
                        <span class="ml-4 font-semibold text-gray-700">Status:</span>
                        @if($match->is_done)
                            <span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs">Finalized</span>
                        @else
                            <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-700 text-xs">Ongoing</span>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-400 py-8">No matches found.</div>
                @endforelse
            </div>
            </template>
        </div>

        <div x-show="tab === 'rules'" class="schedule-section w-full max-w-full mx-auto px-2">
            <div class="schedule-header">Sport Rules</div>
            @php
                $rules = \App\Models\Rules::with('sport')->orderBy('created_at', 'desc')->get();
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($rules as $rule)
                    <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col h-full border border-gray-200">
                        <div class="flex flex-col gap-2 mb-4">
                            <div class="font-bold text-lg text-red-600">{{ $rule->title }}</div>
                            <div class="text-sm text-gray-500">Sport: {{ $rule->sport->sport_name ?? '-' }}</div>
                            <div class="text-gray-700 text-sm">{{ $rule->description }}</div>
                        </div>
                        @if($rule->file_path)
                            <div class="mb-4 flex justify-center">
                                <iframe src="{{ asset('storage/'.$rule->file_path) }}#toolbar=0&navpanes=0&scrollbar=0&page=1" class="w-40 h-56 rounded shadow border" frameborder="0"></iframe>
                            </div>
                        @else
                            <div class="mb-4 flex justify-center">
                                <span class="text-gray-400">No PDF</span>
                            </div>
                        @endif
                        <div class="flex gap-2 mt-auto">
                            @if($rule->file_path)
                                <a href="{{ asset('storage/'.$rule->file_path) }}" target="_blank" class="bg-blue-600 text-white px-4 py-2 rounded font-bold flex-1 text-center">Preview</a>
                                <a href="{{ asset('storage/'.$rule->file_path) }}" download class="bg-green-600 text-white px-4 py-2 rounded font-bold flex-1 text-center">Download</a>
                            @else
                                <span class="text-gray-400">No PDF</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500">No rules found.</div>
                @endforelse
            </div>
        </div>
        <!-- Scoreboard Card View Section -->
        <div x-show="tab === 'scoreboard'" class="schedule-section w-full max-w-full mx-auto px-2">
            <div class="schedule-header">Live Scoreboard</div>
            @php
                $teams = \App\Models\Team::all();
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($teams as $team)
                    <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col border border-gray-200 items-start">
                        <div class="flex items-center gap-3 mb-4 w-full">
                            @if($team->photo)
                                <img src="{{ asset('storage/' . $team->photo) }}" alt="logo" class="w-10 h-10 rounded-full object-cover border border-gray-300 shadow" />
                            @else
                                <span class="inline-block w-10 h-10 rounded-full bg-gray-200 border border-gray-300"></span>
                            @endif
                            <span class="font-bold text-lg text-red-600">{{ $team->name }}</span>
                        </div>
                        <div class="flex flex-col gap-2 w-full mt-2">
                            <div class="flex items-center gap-2">
                                <span class="text-yellow-500 text-xl">🥇</span>
                                <span class="font-bold text-gray-800">Gold:</span>
                                <span class="font-extrabold text-yellow-500 ml-auto">{{ $team->scoreboards->sum('gold') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500 text-xl">🥈</span>
                                <span class="font-bold text-gray-800">Silver:</span>
                                <span class="font-extrabold text-gray-700 ml-auto">{{ $team->scoreboards->sum('silver') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-orange-500 text-xl">🥉</span>
                                <span class="font-bold text-gray-800">Bronze:</span>
                                <span class="font-extrabold text-orange-500 ml-auto">{{ $team->scoreboards->sum('bronze') }}</span>
                            </div>
                            <div class="flex items-center gap-2 border-t pt-2 mt-2">
                                <span class="font-bold text-black">Total:</span>
                                <span class="font-extrabold text-black ml-auto">{{ $team->scoreboards->sum(function($s){ return $s->gold + $s->silver + $s->bronze; }) }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500">No teams found.</div>
                @endforelse
            </div>
        </div>
    </div>
<script>
function scheduleComponent() {
    return {
        viewType: 'grid',
        showFilter: false,
        filterSport: '',
        filterGender: '',
        sports: @json(\App\Models\Sport::all()),
        schedules: @json(\App\Models\Schedule::with(['sport', 'teamA', 'teamB'])->get()),
        get filteredSchedules() {
            return this.schedules.filter(match => {
                const sportMatch = !this.filterSport || match.sport_id == this.filterSport;
                const genderMatch = !this.filterGender || match.gender == this.filterGender;
                return sportMatch && genderMatch;
            });
        },
        get sortedSchedules() {
            return [...this.filteredSchedules].sort((a, b) => {
                const ad = new Date(a.match_date + ' ' + a.match_time);
                const bd = new Date(b.match_date + ' ' + b.match_time);
                return ad - bd;
            });
        }
    }
}
</script>

    <div x-show="tab === 'rules'" class="schedule-section w-full max-w-full mx-auto px-2">
        <div class="schedule-header">Sport Rules</div>
        @php
            $rules = \App\Models\Rules::with('sport')->orderBy('created_at', 'desc')->get();
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($rules as $rule)
                <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col h-full border border-gray-200">
                    <div class="flex flex-col gap-2 mb-4">
                        <div class="font-bold text-lg text-red-600">{{ $rule->title }}</div>
                        <div class="text-sm text-gray-500">Sport: {{ $rule->sport->sport_name ?? '-' }}</div>
                        <div class="text-gray-700 text-sm">{{ $rule->description }}</div>
                    </div>
                    @if($rule->file_path)
                        <div class="mb-4 flex justify-center">
                            <iframe src="{{ asset('storage/'.$rule->file_path) }}#toolbar=0&navpanes=0&scrollbar=0&page=1" class="w-40 h-56 rounded shadow border" frameborder="0"></iframe>
                        </div>
                    @else
                        <div class="mb-4 flex justify-center">
                            <span class="text-gray-400">No PDF</span>
                        </div>
                    @endif
                    <div class="flex gap-2 mt-auto">
                        @if($rule->file_path)
                            <a href="{{ asset('storage/'.$rule->file_path) }}" target="_blank" class="bg-blue-600 text-white px-4 py-2 rounded font-bold flex-1 text-center">Preview</a>
                            <a href="{{ asset('storage/'.$rule->file_path) }}" download class="bg-green-600 text-white px-4 py-2 rounded font-bold flex-1 text-center">Download</a>
                        @else
                            <span class="text-gray-400">No PDF</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">No rules found.</div>
            @endforelse
        </div>
    </div>
</body>
</html>