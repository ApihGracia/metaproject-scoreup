<?php

namespace App\Livewire\Technician;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Rules;
use App\Models\Sport;
use Illuminate\Support\Facades\Storage;

class TechnicianRule extends Component
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

    protected $rules = [
        'sport_id' => 'required|exists:sports,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'pdf' => 'nullable|file|mimes:pdf|max:20480', // 20MB max
    ];

    public function mount()
    {
        $this->sports = Sport::all();
    }

    // public function save()
    // {
    //     $this->validate();

    //     $pdfPath = null;
    //     if ($this->pdf) {
    //         $pdfPath = $this->pdf->store('rules', 'public');
    //     }

    //     Rules::create([
    //         'sport_id' => $this->sport_id,
    //         'title' => $this->title,
    //         'description' => $this->description,
    //         'file_path' => $pdfPath,
    //     ]);

    //     $this->reset(['sport_id', 'title', 'description', 'pdf']);
    //     session()->flash('success', 'PDF uploaded and rule added successfully!');
    // }

    // public function delete($id)
    // {
    //     $rule = Rules::findOrFail($id);
    //     if ($rule->file_path && Storage::disk('public')->exists($rule->file_path)) {
    //         Storage::disk('public')->delete($rule->file_path);
    //     }
    //     $rule->delete();
    //     session()->flash('success', 'Rule and PDF deleted successfully!');
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
        $rules = \App\Models\Rules::with('sport')->orderBy('created_at', 'desc')->get();
        return view('livewire.technician.technician-rule', compact('rules'));
    }

    // public function render()
    // {
    //     return view('livewire.technician.technician-rule');
    // }
}
