<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = 'public'; // default value
    public string $sport = ''; // optional, if technician

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,technician,public'],
            'sport' => ['nullable', 'string', 'max:255'],
        ]);

        // Only allow sport if technician
        if ($this->role !== 'technician') {
            $validated['sport'] = null;
        }

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        $user->assignRole($this->role);

        Auth::login($user);

        // $this->redirect(route('dashboard', absolute: false), navigate: true);

        if ($user->hasRole('admin')) {
            $this->redirect(route('dashboard'), navigate: true);
        } elseif ($user->hasRole('technician')) {
            $this->redirect(route('techniciandashboard'), navigate: true);
        } else {
            $this->redirect(route('dashboard'), navigate: true);
        }
    }
}
