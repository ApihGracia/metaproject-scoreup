<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Sport;
use App\Models\Schedule;
use App\Models\Team;

class WelcomeSchedule extends Component
{
    public $sports;
    public $selectedSport = '';
    public $selectedGender = '';
    public $viewType = 'grid'; // 'grid' or 'list'
    public $showFilter = false;

    // For modal filter selection
    public $filterSport = '';
    public $filterGender = '';

    public function mount()
    {
        $this->sports = Sport::all();
        $this->filterSport = $this->selectedSport;
        $this->filterGender = $this->selectedGender;
    }

    public function applyFilter()
    {
        $this->selectedSport = $this->filterSport;
        $this->selectedGender = $this->filterGender;
        $this->showFilter = false;
    }

    public function cancelFilter()
    {
        $this->filterSport = $this->selectedSport;
        $this->filterGender = $this->selectedGender;
        $this->showFilter = false;
    }

    public function getFilteredSchedulesProperty()
    {
        $query = Schedule::with(['sport', 'teamA', 'teamB']);

        if ($this->selectedSport) {
            $query->where('sport_id', $this->selectedSport);
        }
        if ($this->selectedGender) {
            $query->where('gender', $this->selectedGender);
        }

        return $query->orderBy('match_date')->orderBy('match_time')->get();
    }

    public function render()
    {
        return view('livewire.welcome-schedule');
    }
}
