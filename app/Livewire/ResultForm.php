<?php

namespace App\Livewire;

use App\Models\Result;
use Livewire\Component;

class ResultForm extends Component
{
    public $match_name, $team_a_score, $team_b_score;

    protected $rules = [
        'match_name' => 'required',
        'team_a_score' => 'required|integer',
        'team_b_score' => 'required|integer',
    ];

    public function save()
    {
        $this->validate();

        Result::create([
            'match_name' => $this->match_name,
            'team_a_score' => $this->team_a_score,
            'team_b_score' => $this->team_b_score,
        ]);

        session()->flash('message', 'Result saved successfully!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.result-form');
    }
}
