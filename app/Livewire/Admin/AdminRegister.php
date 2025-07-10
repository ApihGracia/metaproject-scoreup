<?php

namespace App\Livewire\Admin;

use App\Models\Admin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;

use Livewire\Component;

#[Layout('components.layouts.auth')]
class AdminRegister extends Component
{

    public string $name = '';
    public string $email = '';
    public string $staff_id = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email'],
            'staff_id' => ['required', 'string', 'max:50'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $admin = Admin::create($validated);

        event(new Registered($admin));

        Auth::guard('admin')->login($admin);

        $this->redirect(route('admin.dashboard'), navigate: true);
    }
    
    public function render()
    {
        return view('livewire.admin.admin-register');
    }
}
