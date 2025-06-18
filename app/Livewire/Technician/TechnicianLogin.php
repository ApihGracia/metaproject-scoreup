<?php

namespace App\Livewire\Technician;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;  
use Livewire\Attributes\Layout;

use Livewire\Component;

#[Layout('components.layouts.auth')]
class TechnicianLogin extends Component
{

    public string $email = '';
    public string $password = '';

    public function login(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::guard('technician')->attempt(['email' => $this->email, 'password' => $this->password])) {
            throw ValidationException::withMessages(['email' => __('auth.failed')]);
        }

        $this->redirect(route('technician.dashboard'), navigate: true);
    }

    public function render()
    {
        return view('livewire.technician.technician-login');
    }
}
