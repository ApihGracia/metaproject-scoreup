<?php

namespace App\Livewire\Admin;

use App\Models\Scoreboard;
use App\Models\Team;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $scoreboards = [];
    public $medals = [];
    public $overview = [];

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
        $teams = Team::all();
        $sports = \App\Models\Sport::all();

        // Overview: total medals per team
        $this->overview = $teams->map(function($team) {
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
        foreach ($teams as $team) {
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

    public function updatedMedals()
    {
        // No-op, just to trigger Livewire updates
    }

    public function saveMedals($teamId)
    {
        $data = $this->medals[$teamId];
        $team = Team::findOrFail($teamId);

        $scoreboard = Scoreboard::firstOrCreate(
            [
                'team_id' => $teamId,
                'sport_id' => $team->sport_id, // <-- Add this line
            ],
            [
                'gold' => 0,
                'silver' => 0,
                'bronze' => 0,
            ]
        );

        $scoreboard->update([
            'gold' => $data['gold'],
            'silver' => $data['silver'],
            'bronze' => $data['bronze'],
        ]);
        $this->mount(); // Refresh data
        session()->flash('success', 'Scoreboard updated!');
    }

    public function render()
    {
        return view('livewire.admin.admin-dashboard');
    }
}
