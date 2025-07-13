<?php

namespace App\Livewire\Technician;

use Livewire\Component;
use App\Models\Scoreboard;

class TechnicianDashboard extends Component
{
    public $scoreboards = [];

    public function mount(){
        // $this->techni = Team::all();
        $this->scoreboards = Scoreboard::with('team')->get();
    }

    public function render()
    {
        $scoreboards = Scoreboard::with('team')->get()->map(function ($score) {
            $score->total = $score->gold + $score->silver + $score->bronze;
            return $score;
        });

        return view('livewire.technician.technician-dashboard');
    }
}
