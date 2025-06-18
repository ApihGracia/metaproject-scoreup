<?php

namespace App\Livewire\Technician;

use App\Models\SportTechnician;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;

use Livewire\Component;

#[Layout('components.layouts.auth')]
class TechnicianRegister extends Component
{

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $sport_id = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:sport_technicians,email'],
            'sport_id' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['status'] = 'Active';
        $validated['joined_date'] = now();

        $technician = SportTechnician::create($validated);

        event(new Registered($technician));

        Auth::guard('technician')->login($technician);

        $this->redirect(route('technician.dashboard'), navigate: true);
    }

    public function render()
    {
        return view('livewire.technician.technician-register');
    }
}
