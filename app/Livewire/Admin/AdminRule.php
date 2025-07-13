<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Rules;
use App\Models\Sport;
use Illuminate\Support\Facades\Storage;

class AdminRule extends Component
{
    use WithFileUploads;

    public $sports;
    public $sport_id = '';
    public $title = '';
    public $description = '';
    public $pdf;
    public $selectedRuleId = null;
    public $showPdfModal = false;
    public $pdfUrl = '';
    // public $editId = null;

    protected $rules = [
        'sport_id' => 'required|exists:sports,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'pdf' => 'nullable|file|mimes:pdf|max:20480', // 20MB max
    ];

    public function mount()
    {
        // $this->sports = Sport::all();
        
        // Only get unique sport names (no gender distinction)
        // $this->sports = \App\Models\Sport::select('id', 'sport_name')
        //     ->groupBy('sport_name', 'id')
        //     ->get();
        
        // if you want to show each sport only once even if there are multiple entries with different genders
        $this->sports = \App\Models\Sport::select('sport_name', 'id')
            ->groupBy('sport_name')
            ->get();

    }

    public function getUniqueSportsProperty()
    {
        return \App\Models\Sport::select('sport_name')->distinct()->get();
    }

    public function save()
    {
        $this->validate();

        $pdfPath = null;
        if ($this->pdf) {
            $pdfPath = $this->pdf->store('rules', 'public');
        }

        Rules::create([
            'sport_id' => $this->sport_id,
            'title' => $this->title,
            'description' => $this->description,
            'file_path' => $pdfPath,
        ]);

        $this->reset(['sport_id', 'title', 'description', 'pdf']);
        session()->flash('success', 'PDF uploaded and rule added successfully!');
    }

    // public function delete($id)
    // {
    //     $rule = Rules::findOrFail($id);
    //     if ($rule->file_path && Storage::disk('public')->exists($rule->file_path)) {
    //         Storage::disk('public')->delete($rule->file_path);
    //     }
    //     $rule->delete();
    //     session()->flash('success', 'Rule and PDF deleted successfully!');
    // }

    public function delete($id)
    {
        $rule = Rules::findOrFail($id);
        if ($rule->file_path && Storage::disk('public')->exists($rule->file_path)) {
            Storage::disk('public')->delete($rule->file_path);
        }
        $rule->delete();
        session()->flash('success', 'Rule and PDF deleted successfully!');
    }

    // public function edit($id)
    // {
    //     $rule = Rules::findOrFail($id);
    //     $this->editId = $rule->id;
    //     $this->sport_id = $rule->sport_id;
    //     $this->title = $rule->title;
    //     $this->description = $rule->description;
    //     $this->pdf = null; // Don't prefill with old PDF
    // }

    // public function update()
    // {
    //     $this->validate([
    //         'sport_id' => 'required|exists:sports,id',
    //         'title' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'pdf' => 'nullable|file|mimes:pdf|max:20480',
    //     ]);

    //     $rule = Rules::findOrFail($this->editId);

    //     $pdfPath = $rule->file_path;
    //     if ($this->pdf) {
    //         // Delete old PDF if exists
    //         if ($pdfPath && Storage::disk('public')->exists($pdfPath)) {
    //             Storage::disk('public')->delete($pdfPath);
    //         }
    //         $pdfPath = $this->pdf->store('rules', 'public');
    //     }

    //     $rule->update([
    //         'sport_id' => $this->sport_id,
    //         'title' => $this->title,
    //         'description' => $this->description,
    //         'file_path' => $pdfPath,
    //     ]);

    //     $this->reset(['sport_id', 'title', 'description', 'pdf', 'editId']);
    //     session()->flash('success', 'Rule updated successfully!');
    // }

    public function viewPdf($id)
    {
        $rule = Rules::findOrFail($id);
        if ($rule->file_path && Storage::disk('public')->exists($rule->file_path)) {
            $this->pdfUrl = Storage::url($rule->file_path);
            $this->showPdfModal = true;
        } else {
            session()->flash('error', 'PDF file not found.');
        }
    }

    public function closePdfModal()
    {
        $this->showPdfModal = false;
        $this->pdfUrl = '';
    }

    public function render()
    {
        $rules = Rules::with('sport')->orderBy('created_at', 'desc')->get();
        return view('livewire.admin.admin-rule', [
            'rules' => $rules,
            'sports' => $this->sports,
        ]);
    }
}
