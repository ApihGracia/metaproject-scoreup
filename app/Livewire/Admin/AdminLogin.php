<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportRedirects\Redirector;

use Livewire\Component;

#[Layout('components.layouts.auth')]
class AdminLogin extends Component
{

    public string $email = '';
    public string $password = '';


    //logic from login.php
    // #[Validate('required|string|email')]
    // public string $email = '';

    // #[Validate('required|string')]
    // public string $password = '';

    // public bool $remember = false;
    //end of login.php

    public function login()
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::guard('admin')->attempt([
            'email' => $this->email, 
            'password' => $this->password
        ])) {
            throw ValidationException::withMessages(['email' => __('auth.failed')]);
        }

        session()->regenerate();

        // $this->redirect(route('admin.admin-dashboard'), navigate: true);
        // $this->redirect(route('/admin-dashboard'), navigate: true);
        // return redirect()->route('admin.admin-dashboard');
        return redirect()->route('admin.admin-dashboard');

    }

    // public function login(): \Illuminate\Http\RedirectResponse   
    // // public function login(): Redirector
    // {
    //     $this->validate([
    //         'email' => ['required', 'string', 'email'],
    //         'password' => ['required', 'string'],
    //     ]);

    //     if (!Auth::guard('admin')->attempt([
    //         'email' => $this->email,
    //         'password' => $this->password
    //     ])) {
    //         throw ValidationException::withMessages(['email' => __('auth.failed')]);
    //     }

    //     return redirect()->route('admin.admin-dashboard');
    // }


    public function render()
    {
        return view('livewire.admin.admin-login');
    }
}
