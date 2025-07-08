<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Sport;

class AdminSport extends Component
{
    use WithFileUploads;

    public $sports;
    public $sport_name = '';
    public $gender = 'Mixed';
    public $photo;
    public $description = '';
    public $editId = null;

    protected $rules = [
        'sport_name' => 'required|string|max:255',
        'gender' => 'required|in:Male,Female,Mixed',
        'photo' => 'nullable|image|max:2048', // 2MB max
        'description' => 'nullable|string',
    ];

    public function mount()
    {
        $this->loadSports();
    }

    public function loadSports()
    {
        $this->sports = Sport::all();
    }

    public function save()
    {
        $this->validate();

        $photoPath = null;
        if ($this->photo) {
            $photoPath = $this->photo->store('sports', 'public');
        }

        if ($this->editId) {
            $sport = Sport::find($this->editId);
            $updateData = [
                'sport_name' => $this->sport_name,
                'gender' => $this->gender,
                'description' => $this->description,
            ];
            if ($photoPath) {
                $updateData['photo'] = $photoPath;
            }
            $sport->update($updateData);
            // $sport->update([
            //     'sport_name' => $this->sport_name,
            //     'gender' => $this->gender,
            //     'photo' => $photoPath,
            //     'description' => $this->description,
            // ]);
        } else {
            Sport::create([
                'sport_name' => $this->sport_name,
                'gender' => $this->gender,
                'photo' => $photoPath,
                'description' => $this->description,
            ]);
        }

        $this->reset(['sport_name', 'gender', 'photo', 'description', 'editId']);
        $this->loadSports();
    }

    public function edit($id)
    {
        $sport = Sport::findOrFail($id);
        $this->editId = $sport->id;
        $this->sport_name = $sport->sport_name;
        $this->gender = $sport->gender;
        $this->description = $sport->description;
        $this->photo = null; // Do not set to $sport->photo, keep it null for new uploads
    }

    public function cancelEdit()
    {
        $this->reset(['sport_name', 'gender', 'photo', 'description', 'editId']);
    }

    public function delete($id)
    {
        $sport = Sport::findOrFail($id);
        $sport->delete();
        $this->loadSports();
        // Optionally reset form if editing the deleted item
        if ($this->editId == $id) {
            $this->reset(['sport_name', 'gender', 'photo', 'description', 'editId']);
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-sport');
    }
}
