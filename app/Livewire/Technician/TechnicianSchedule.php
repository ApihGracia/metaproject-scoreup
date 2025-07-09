<?php

namespace App\Livewire\Technician;

use Livewire\Component;
use App\Models\Sport;
use App\Models\Schedule;

class TechnicianSchedule extends Component
{
    public $sports;
    public $selectedSportName = null;
    public $schedules = [];
    public $selectedSchedule = null;
    public $score_a, $score_b;
    public $is_done = false;

    public function mount()
    {
        // Get unique sport names (no gender)
        $this->sports = Sport::select('sport_name')->distinct()->get();
    }

    public function selectSport($sportName)
    {
        $this->selectedSportName = $sportName;
        $this->selectedSchedule = null;
        $this->loadSchedules();
    }

    public function loadSchedules()
    {
        // Get all schedules for this sport, sorted by date, gender, time
        $this->schedules = Schedule::with(['sport', 'teamA', 'teamB'])
            ->whereHas('sport', function($q) {
                $q->where('sport_name', $this->selectedSportName);
            })
            ->orderBy('match_date')
            // ->orderByRaw("FIELD(gender, 'Male', 'Female', 'Mixed')")
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

    public function selectSchedule($scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        $this->selectedSchedule = $schedule;
        $this->score_a = $schedule->score_a;
        $this->score_b = $schedule->score_b;
        $this->is_done = $schedule->is_done;
    }

    public function updateScore()
    {
        if (!$this->selectedSchedule || $this->is_done) return;

        $schedule = Schedule::findOrFail($this->selectedSchedule->id);
        $schedule->score_a = $this->score_a;
        $schedule->score_b = $this->score_b;
        $schedule->save();

        $this->selectedSchedule = $schedule;
        session()->flash('success', 'Score updated!');
        $this->loadSchedules();
    }

    public function finalize()
    {
        if (!$this->selectedSchedule) return;

        $schedule = Schedule::findOrFail($this->selectedSchedule->id);
        $schedule->is_done = true;
        $schedule->save();

        $this->is_done = true;
        session()->flash('success', 'Match finalized!');
        $this->loadSchedules();
    }

    public function backToList()
    {
        // $this->selectedSchedule = null;
        $this->selectedSchedule = null;
        $this->selectedSportName = null;
    }

    public function render()
    {
        return view('livewire.technician.technician-schedule');
    }
}
