<?php

namespace App\Livewire\Technician;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;  
use Livewire\Attributes\Layout;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Livewire\Attributes\Validate;

use Livewire\Component;

#[Layout('components.layouts.auth')]
class TechnicianLogin extends Component
{
    // public string $email = '';
    // public string $password = '';

    // public function login(): void
    // {
    //     $this->validate([
    //         'email' => ['required', 'string', 'email'],
    //         'password' => ['required', 'string'],
    //     ]);

    //     if (!Auth::guard('technician')->attempt(['email' => $this->email, 'password' => $this->password])) {
    //         throw ValidationException::withMessages(['email' => __('auth.failed')]);
    //     }

    //     $this->redirect(route('technician.dashboard'), navigate: true);
    // }

    //From login.php
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */

    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
        // $this->redirectIntended(default: route('admin.admin-dashboard', absolute: false), navigate: true);
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }


    //End of login.php

    public function render()
    {
        return view('livewire.technician.technician-login');
    }
}
