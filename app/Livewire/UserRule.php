<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Rules;
use App\Models\Sport;
use Illuminate\Support\Facades\Storage;

class UserRule extends Component
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
        return view('livewire.user-rule', compact('rules'));
        // return view('livewire.user-rule');
    }
}
