<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;

use Livewire\Component;

#[Layout('components.layouts.auth')]
class AdminLogin extends Component
{

    public string $email = '';
    public string $password = '';

    public function login(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::guard('admin')->attempt(['email' => $this->email, 'password' => $this->password])) {
            throw ValidationException::withMessages(['email' => __('auth.failed')]);
        }

        $this->redirect(route('admin.dashboard'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.admin-login');
    }
}
