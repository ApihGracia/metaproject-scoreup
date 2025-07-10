<?php

namespace App\Livewire;

use App\Models\Result;
use Livewire\Component;
// use App\Models\Result;


class ResultScore extends Component
{
    public $scores = [];
    public $name;
    public $score;

    public function addScore()
    {
        $this->validate([
            'name'  => 'required',
            'score' => 'required|numeric|min:0|max:100',
        ]);

        $this->scores[] = [
            'name'  => $this->name,
            'score' => $this->score,
        ];

        // Clear input after adding
        $this->name = '';
        $this->score = '';
    }

    public function removeScore($index)
    {
        unset($this->scores[$index]);
        $this->scores = array_values($this->scores);
    }

    public function render()
    {
        // return view('livewire.result-score');
        return view('livewire.result-score', [
            'results' => Result::latest()->get(),
        ]);
    }
}
