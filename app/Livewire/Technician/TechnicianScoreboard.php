<?php

namespace App\Livewire\Technician;

use Livewire\Component;
use App\Models\Team;

class TechnicianScoreboard extends Component
{
    public $overview = [];

    public function mount()
    {
        $this->refreshOverview();
    }

    public function refreshOverview()
    {
        $this->overview = Team::all()->map(function($team) {
            $gold = $team->scoreboards->sum('gold');
            $silver = $team->scoreboards->sum('silver');
            $bronze = $team->scoreboards->sum('bronze');
            $total = $gold + $silver + $bronze;
            return [
                'team' => $team,
                'gold' => $gold,
                'silver' => $silver,
                'bronze' => $bronze,
                'total' => $total
            ];
        })->sort(function($a, $b) {
            if ($a['gold'] !== $b['gold']) {
                return $b['gold'] <=> $a['gold'];
            }
            if ($a['silver'] !== $b['silver']) {
                return $b['silver'] <=> $a['silver'];
            }
            if ($a['bronze'] !== $b['bronze']) {
                return $b['bronze'] <=> $a['bronze'];
            }
            return $b['total'] <=> $a['total'];
        })->values();
    }

    public function render()
    {
        return view('livewire.technician.technician-scoreboard', [
            'overview' => $this->overview,
        ]);
    }
}
