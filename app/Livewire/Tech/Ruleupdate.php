<?php

namespace App\Livewire\Tech;

use Livewire\Component;
use Livewire\WithFileUploads;

class Ruleupdate extends Component
{
    use WithFileUploads;

    public $title;
    public $sport_id;
    public $category;
    public $gender;
    public $pdf;
    public $description;
    public $profile_picture;

    protected $rules = [
        'title' => 'required|string|max:255',
        'sport_id' => 'required|string|max:50',
        'category' => 'required|string|max:50',
        'gender' => 'required|string|max:20',
        'pdf' => 'nullable|file|mimes:pdf|max:2048',
        'description' => 'required|string',
        'profile_picture' => 'nullable|image|max:2048',
    ];

    public function updateRule()
    {
        $validated = $this->validate();

        // Handle file uploads if needed
        if ($this->pdf) {
            $validated['pdf'] = $this->pdf->store('pdfs', 'public');
        }
        if ($this->profile_picture) {
            $validated['profile_picture'] = $this->profile_picture->store('profile_pictures', 'public');
        }

        // Save or update the rule in the database
        // Example: Rule::updateOrCreate([...], $validated);

        session()->flash('success', 'Rule updated successfully!');
    }

    public function render()
    {
        return view('livewire.tech.ruleupdate');
    }
}
