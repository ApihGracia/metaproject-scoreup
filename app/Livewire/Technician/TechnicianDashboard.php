<?php

namespace App\Livewire\Technician;

use App\Models\Scoreboard;
use App\Models\Team;
use Livewire\Component;

class TechnicianDashboard extends Component
{
    public $scoreboards = [];
    public $medals = [];
    public $overview = [];
    public $teams = [];
    public $showModal = false;
    public $modalTeamId;
    public $modalGold;
    public $modalSilver;
    public $modalBronze;

    // public function mount()
    // {
    //     // // Get all teams and their scoreboard (or default medals if not exist)
    //     // $this->scoreboards = Team::with('scoreboard')->get();

    //     // // Prepare medals array for input fields
    //     // foreach ($this->scoreboards as $team) {
    //     //     $this->medals[$team->id]['gold'] = $team->scoreboard->gold ?? 0;
    //     //     $this->medals[$team->id]['silver'] = $team->scoreboard->silver ?? 0;
    //     //     $this->medals[$team->id]['bronze'] = $team->scoreboard->bronze ?? 0;
    //     // }

    //     // Overview: total medals per team
    //     $this->overview = Team::with('scoreboards')->get()->map(function($team) {
    //         return [
    //             'team' => $team,
    //             'gold' => $team->scoreboards->sum('gold'),
    //             'silver' => $team->scoreboards->sum('silver'),
    //             'bronze' => $team->scoreboards->sum('bronze'),
    //             'total' => $team->scoreboards->sum(function($s) {
    //                 return $s->gold + $s->silver + $s->bronze;
    //             }),
    //         ];
    //     });

    //     // For detailed table (per team per sport)
    //     $this->scoreboards = Scoreboard::with(['team', 'sport'])->get();
    // }

    public function mount()
    {
        $this->teams = Team::all();
        $sports = \App\Models\Sport::all();

        // Overview: total medals per team
        $this->overview = collect($this->teams)->map(function($team) {
            return [
                'team' => $team,
                'gold' => $team->scoreboards->sum('gold'),
                'silver' => $team->scoreboards->sum('silver'),
                'bronze' => $team->scoreboards->sum('bronze'),
                'total' => $team->scoreboards->sum(function($s) {
                    return $s->gold + $s->silver + $s->bronze;
                }),
            ];
        });

        // Build all combinations for detailed scoreboard
        $scoreboards = [];
        foreach ($this->teams as $team) {
            foreach ($sports as $sport) {
                // Try to find an existing scoreboard
                $scoreboard = \App\Models\Scoreboard::where('team_id', $team->id)
                    ->where('sport_id', $sport->id)
                    ->first();

                $scoreboards[] = [
                    'team' => $team,
                    'sport' => $sport,
                    'gold' => $scoreboard ? $scoreboard->gold : 0,
                    'silver' => $scoreboard ? $scoreboard->silver : 0,
                    'bronze' => $scoreboard ? $scoreboard->bronze : 0,
                    'total' => $scoreboard ? ($scoreboard->gold + $scoreboard->silver + $scoreboard->bronze) : 0,
                ];
            }
        }
        $this->scoreboards = $scoreboards;
    }

    // public function editScoreboard($teamId)
    // {
    //     $team = Team::findOrFail($teamId);
    //     $this->modalTeamId = $team->id;
    //     $this->modalGold = $team->scoreboards->sum('gold');
    //     $this->modalSilver = $team->scoreboards->sum('silver');
    //     $this->modalBronze = $team->scoreboards->sum('bronze');
    //     $this->showModal = true;
    // }

    // public function closeModal()
    // {
    //     $this->showModal = false;
    //     $this->modalTeamId = null;
    //     $this->modalGold = null;
    //     $this->modalSilver = null;
    //     $this->modalBronze = null;
    // }

    // public function saveUpdate()
    // {
    //     $teamId = $this->modalTeamId;
    //     $team = Team::findOrFail($teamId);
    //     // Update all scoreboards for this team
    //     foreach ($team->scoreboards as $scoreboard) {
    //         $scoreboard->update([
    //             'gold' => $this->modalGold,
    //             'silver' => $this->modalSilver,
    //             'bronze' => $this->modalBronze,
    //         ]);
    //     }
    //     // If no scoreboard exists, create one (assign to first sport or null)
    //     if ($team->scoreboards->count() == 0) {
    //         $firstSport = \App\Models\Sport::first();
    //         Scoreboard::create([
    //             'team_id' => $teamId,
    //             'sport_id' => $firstSport ? $firstSport->id : null,
    //             'gold' => $this->modalGold,
    //             'silver' => $this->modalSilver,
    //             'bronze' => $this->modalBronze,
    //         ]);
    //     }
    //     $this->showModal = false;
    //     $this->mount();
    //     session()->flash('success', 'Scoreboard updated!');
    // }

    // public function updatedMedals()
    // {
    //     // No-op, just to trigger Livewire updates
    // }

    // public function saveMedals($teamId)
    // {
    //     $data = $this->medals[$teamId];
    //     $team = Team::findOrFail($teamId);

    //     $scoreboard = Scoreboard::firstOrCreate(
    //         [
    //             'team_id' => $teamId,
    //             'sport_id' => $team->sport_id, // <-- Add this line
    //         ],
    //         [
    //             'gold' => 0,
    //             'silver' => 0,
    //             'bronze' => 0,
    //         ]
    //     );

    //     $scoreboard->update([
    //         'gold' => $data['gold'],
    //         'silver' => $data['silver'],
    //         'bronze' => $data['bronze'],
    //     ]);
    //     $this->mount(); // Refresh data
    //     session()->flash('success', 'Scoreboard updated!');
    // }

    public function render()
    {
        $scoreboards = Scoreboard::with('team')->get()->map(function ($score) {
            $score->total = $score->gold + $score->silver + $score->bronze;
            return $score;
        });

        return view('livewire.technician.technician-dashboard');
    }
}
