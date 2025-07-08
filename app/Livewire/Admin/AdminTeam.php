<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Team;

class AdminTeam extends Component
{
    use WithFileUploads;

    public $teams;
    public $name = '';
    public $description = '';
    public $photo;
    public $editId = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'photo' => 'nullable|image|max:2048', // 2MB max
    ];

    public function mount()
    {
        $this->loadTeams();
    }

    public function loadTeams()
    {
        $this->teams = Team::all();
    }

    public function save()
    {
        $this->validate();

        $photoPath = null;
        if ($this->photo) {
            $photoPath = $this->photo->store('teams', 'public');
        }

        if ($this->editId) {
            $team = Team::find($this->editId);
            $team->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);
            if ($photoPath) {
                $updateData['photo'] = $photoPath;
            }
            $team->update($updateData);
        } else {
            Team::create([
                'name' => $this->name,
                'description' => $this->description,
                'photo' => $photoPath,
            ]);
        }

        $this->reset(['name', 'description', 'photo', 'editId']);
        $this->loadTeams();
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);
        $this->editId = $team->id;
        $this->name = $team->name;
        $this->description = $team->description;
        $this->photo = null; // Don't prefill with old photo
    }

    public function cancelEdit()
    {
        $this->reset(['name', 'description', 'photo', 'editId']);
    }

    public function delete($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();
        $this->loadTeams();
        if ($this->editId == $id) {
            $this->reset(['name', 'description', 'photo', 'editId']);
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-team');
    }
}
