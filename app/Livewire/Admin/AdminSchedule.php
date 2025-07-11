<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Sport;
use App\Models\Team;
use App\Models\Schedule;

class AdminSchedule extends Component
{
    public $sports, $teams, $schedules;
    public $sport_id, $gender = 'Male', $team_a_id, $team_b_id, $match_date, $match_time, $venue, $stage, $editId = null;
    public $score_a, $score_b, $round = 'Quarterfinal';

    public $showDetail = false;
    public $search = '';
    public $filterSport = '';
    public $filterStatus = '';

    public $title;
    public $date;
    public $description;

    public $showModal = false;

    protected $rules = [
        'sport_id' => 'required|exists:sports,id',
        'gender' => 'required|in:Male,Female,Mixed',
        'team_a_id' => 'required|different:team_b_id|exists:teams,id',
        'team_b_id' => 'required|exists:teams,id',
        'match_date' => 'required|date',
        'match_time' => 'required',
        'venue' => 'required|string|max:255',
        'stage' => 'nullable|string|max:255',
        'score_a' => 'nullable|integer',
        'score_b' => 'nullable|integer',
        'round' => 'nullable|string',
    ];

    public function mount()
    {
        $this->sports = Sport::all();
        $this->teams = Team::all();
        if ($this->sport_id) {
            $sport = Sport::find($this->sport_id);
            if ($sport) {
                $this->gender = $sport->gender;
            }
        }
        $this->loadSchedules();
    }

    // Removed duplicate edit($id) method

    public function updatedSport_id()
    {
        $sport = Sport::find($this->sport_id);
        if ($sport) {
            $this->gender = $sport->gender;
        }
        $this->teams = Team::all();
    }

    public function save()
    {
        $this->validate();

        $data = [
            'sport_id' => $this->sport_id,
            'gender' => $this->gender,
            'team_a_id' => $this->team_a_id,
            'team_b_id' => $this->team_b_id,
            'match_date' => $this->match_date,
            'match_time' => $this->match_time,
            'venue' => $this->venue,
            'round' => $this->round,
            'stage' => $this->stage,
            'score_a' => $this->score_a,
            'score_b' => $this->score_b,
            // handle photo upload if needed
        ];

        if ($this->editId) {
            $match = \App\Models\Schedule::findOrFail($this->editId);
            $match->update($data);
            $this->dispatch('showMessage', 'Schedule updated successfully.');
        } else {
            \App\Models\Schedule::create($data);
            $this->dispatch('showMessage', 'Schedule created successfully.');
        }

        $this->resetForm();
        $this->showModal = false;
        $this->loadSchedules(); // reload data



        
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $this->editId = $schedule->id;
        $this->sport_id = $schedule->sport_id;
        $this->gender = $schedule->gender;
        $this->team_a_id = $schedule->team_a_id;
        $this->team_b_id = $schedule->team_b_id;
        $this->match_date = $schedule->match_date;
        $this->match_time = $schedule->match_time;
        $this->venue = $schedule->venue;
        $this->stage = $schedule->stage;
        $this->score_a = $schedule->score_a;
        $this->score_b = $schedule->score_b;
        $this->round = $schedule->round;
        $this->teams = Team::all();
    }

    public function delete($id)
    {
        Schedule::findOrFail($id)->delete();
        $this->loadSchedules();
        $this->dispatch('showMessage', 'Schedule deleted successfully.');
    }

    public function finalize($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->is_done = true;
        $schedule->save();
        $this->loadSchedules();
        $this->dispatch('showMessage', 'Schedule finalized successfully.');
    }

    public function loadSchedules()
    {
        $this->schedules = Schedule::with(['sport', 'teamA', 'teamB'])
            ->orderBy('match_date')
            ->orderByRaw("
                CASE gender
                    WHEN 'Male' THEN 1
                    WHEN 'Female' THEN 2
                    WHEN 'Mixed' THEN 3
                    ELSE 4
                END
            ")
            ->orderBy('match_time')
            ->get();
    }

    // --- Bracket logic below ---

    // public function allMatchesDone($sport_id, $gender, $round)
    // {
    //     $total = Schedule::where('sport_id', $sport_id)
    //         ->where('gender', $gender)
    //         ->where('round', $round)
    //         ->count();
    //     $done = Schedule::where('sport_id', $sport_id)
    //         ->where('gender', $gender)
    //         ->where('round', $round)
    //         ->where('is_done', true)
    //         ->count();
    //     return $total > 0 && $total === $done;
    // }

    // public function generateNextRound($sport_id, $gender, $currentRound)
    // {
    //     $matches = Schedule::where('sport_id', $sport_id)
    //         ->where('gender', $gender)
    //         ->where('round', $currentRound)
    //         ->where('is_done', true)
    //         ->orderBy('id')
    //         ->get();

    //     $winners = [];
    //     foreach ($matches as $match) {
    //         if ($match->score_a > $match->score_b) {
    //             $winners[] = $match->team_a_id;
    //         } else {
    //             $winners[] = $match->team_b_id;
    //         }
    //     }

    //     $nextRound = $this->getNextRoundName($currentRound);
    //     for ($i = 0; $i < count($winners); $i += 2) {
    //         if (isset($winners[$i+1])) {
    //             Schedule::create([
    //                 'sport_id' => $sport_id,
    //                 'gender' => $gender,
    //                 'team_a_id' => $winners[$i],
    //                 'team_b_id' => $winners[$i+1],
    //                 'match_date' => null,
    //                 'match_time' => null,
    //                 'venue' => '',
    //                 'stage' => $nextRound,
    //                 'round' => $nextRound,
    //                 'is_done' => false,
    //                 'score_a' => null,
    //                 'score_b' => null,
    //             ]);
    //         }
    //     }
    //     $this->loadSchedules();
    // }

    // public function getNextRoundName($currentRound)
    // {
    //     if (strtolower($currentRound) === 'quarterfinal') return 'Semifinal';
    //     if (strtolower($currentRound) === 'semifinal') return 'Final';
    //     return '';
    // }

    public function allMatchesDone($sport_id, $gender, $round)
    {
        $total = \App\Models\Schedule::where('sport_id', $sport_id)
            ->where('gender', $gender)
            ->where('round', $round)
            ->count();
        $done = \App\Models\Schedule::where('sport_id', $sport_id)
            ->where('gender', $gender)
            ->where('round', $round)
            ->where('is_done', true)
            ->count();
        return $total > 0 && $total === $done;
    }

    public function generateNextRound($sport_id, $gender, $currentRound)
    {
        $matches = \App\Models\Schedule::where('sport_id', $sport_id)
            ->where('gender', $gender)
            ->where('round', $currentRound)
            ->where('is_done', true)
            ->orderBy('id')
            ->get();

        $winners = [];
        foreach ($matches as $match) {
            if ($match->score_a > $match->score_b) {
                $winners[] = $match->team_a_id;
            } else {
                $winners[] = $match->team_b_id;
            }
            // Optionally update status to "Finalized"
            $match->status = 'Finalized';
            $match->save();
        }

        $nextRound = $this->getNextRoundName($currentRound);
        for ($i = 0; $i < count($winners); $i += 2) {
            if (isset($winners[$i+1])) {
                \App\Models\Schedule::create([
                    'sport_id' => $sport_id,
                    'gender' => $gender,
                    'team_a_id' => $winners[$i],
                    'team_b_id' => $winners[$i+1],
                    'match_date' => null,
                    'match_time' => null,
                    'venue' => '',
                    'stage' => $nextRound,
                    'round' => $nextRound,
                    'is_done' => false,
                    'score_a' => null,
                    'score_b' => null,
                    'round' => 'OnGoing',
                ]);
            }
        }
        // Optionally reload schedules or emit event
    }

    public function getNextRoundName($currentRound)
    {
        if (strtolower($currentRound) === 'quarterfinal') return 'Semifinal';
        if (strtolower($currentRound) === 'semifinal') return 'Final';
        return '';
    }

    //schedule-detail.blade.php
    public function showScheduleDetail()
    {
        $this->showDetail = true;
    }

    public function hideScheduleDetail()
    {
        $this->showDetail = false;
        $this->reset(['search', 'filterSport', 'filterStatus']);
    }

    public function getFilteredSchedulesProperty()
    {
        $query = \App\Models\Schedule::with(['sport', 'teamA', 'teamB']);

        if ($this->search) {
            $query->where(function($q) {
                $q->whereHas('teamA', fn($t) => $t->where('name', 'like', "%{$this->search}%"))
                ->orWhereHas('teamB', fn($t) => $t->where('name', 'like', "%{$this->search}%"))
                ->orWhere('venue', 'like', "%{$this->search}%");
            });
        }

        if ($this->filterSport) {
            $query->where('sport_id', $this->filterSport);
        }

        if ($this->filterStatus !== '') {
            $query->where('is_done', $this->filterStatus === 'finalized');
        }

        return $query->orderBy('match_date')->get();
    }

    public function goBack()
    {
        return redirect()->route('adminschedule');
    }

    public function resetForm()
    {
        $this->reset(['title', 'date', 'description']); // include all fields you want to reset
    }

    public function render()
    {
        return view('livewire.admin.admin-schedule');
    }
}


/*
<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Sport;
use App\Models\Team;
use App\Models\Schedule;

class AdminSchedule extends Component
{
    public $sports, $teams, $schedules;
    public $sport_id, $gender = 'Male', $team_a_id, $team_b_id, $match_date, $match_time, $venue, $stage, $editId = null;

    protected $rules = [
        'sport_id' => 'required|exists:sports,id',
        'gender' => 'required|in:Male,Female,Mixed',
        'team_a_id' => 'required|different:team_b_id|exists:teams,id',
        'team_b_id' => 'required|exists:teams,id',
        'match_date' => 'required|date',
        'match_time' => 'required',
        'venue' => 'required|string|max:255',
        'stage' => 'nullable|string|max:255',
    ];

    public function mount()
    {
        $this->sports = Sport::all();
        // $this->teams = collect();
        $this->teams = Team::all(); // Load all teams initially
            if ($this->sport_id) {
            $sport = Sport::find($this->sport_id);
            if ($sport) {
                $this->gender = $sport->gender;
            }
        }
        $this->loadSchedules();
    }

    public function updatedSport_id()
    {
        $sport = Sport::find($this->sport_id);
        if ($sport) {
            $this->gender = $sport->gender;
        }

        $this->teams = Team::all(); // Optionally filter by sport/gender if needed
    }

    public function save()
    {
        $this->validate();

        if ($this->editId) {
            $schedule = Schedule::find($this->editId);
            $schedule->update($this->only([
                'sport_id', 'gender', 'team_a_id', 'team_b_id', 'match_date', 'match_time', 'venue', 'stage'
            ]));
        } else {
            Schedule::create($this->only([
                'sport_id', 'gender', 'team_a_id', 'team_b_id', 'match_date', 'match_time', 'venue', 'stage'
            ]));
        }

        $this->reset(['team_a_id', 'team_b_id', 'match_date', 'match_time', 'venue', 'stage', 'editId']);
        $this->loadSchedules();
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $this->editId = $schedule->id;
        $this->sport_id = $schedule->sport_id;
        $this->gender = $schedule->gender;
        $this->team_a_id = $schedule->team_a_id;
        $this->team_b_id = $schedule->team_b_id;
        $this->match_date = $schedule->match_date;
        $this->match_time = $schedule->match_time;
        $this->venue = $schedule->venue;
        $this->stage = $schedule->stage;
        $this->teams = Team::all();
    }

    public function delete($id)
    {
        Schedule::findOrFail($id)->delete();
        $this->loadSchedules();
    }

    public function loadSchedules()
    {
        $this->schedules = Schedule::with(['sport', 'teamA', 'teamB'])
            ->orderBy('match_date')->orderBy('match_time')->get();
    }

    public function render()
    {
        return view('livewire.admin.admin-schedule');
    }
}

*/