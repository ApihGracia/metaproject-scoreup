<?php

namespace App\Livewire\Admin;

use App\Models\Scoreboard;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;

class AdminDashboard extends Component
{

    public $teams;
    public $scoreboards;
    public $selectedTeamId;
    public $gold = 0, $silver = 0, $bronze = 0;
    public $newTeamName;

    public function mount()
    {
        $this->teams = Team::all();
        $this->scoreboards = Scoreboard::with('team')->get();
    }

    public function updatedSelectedTeamId($teamId)
    {
        $team = Team::find($teamId);
        if (!$team) return;

        $scoreboard = Scoreboard::firstOrCreate([
            'team_id' => $teamId
        ], [
            'gold' => 0, 'silver' => 0, 'bronze' => 0
        ]);

        $this->gold = $scoreboard->gold;
        $this->silver = $scoreboard->silver;
        $this->bronze = $scoreboard->bronze;
    }

    public function addNewTeam()
    {
        $team = Team::firstOrCreate(['name' => $this->newTeamName]);
        Scoreboard::firstOrCreate(['team_id' => $team->id], [
            'gold' => 0, 'silver' => 0, 'bronze' => 0
        ]);

        $this->reset(['newTeamName']);
        $this->mount();
    }

    public function updateMedals()
    {
        $scoreboard = Scoreboard::where('team_id', $this->selectedTeamId)->first();
        if ($scoreboard) {
            $scoreboard->update([
                'gold' => $this->gold,
                'silver' => $this->silver,
                'bronze' => $this->bronze
            ]);
            $this->mount();
        }
    }

    public function deleteTeam($teamId)
    {
        Scoreboard::where('team_id', $teamId)->delete();
        Team::find($teamId)?->delete();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.admin.admin-dashboard');
    }
}
