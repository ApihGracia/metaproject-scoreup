<?php

// use App\Livewire\Admin\Login as AdminLogin;
// use App\Livewire\Admin\Register as AdminRegister;
// use App\Livewire\Admin\Dashboard as AdminDashboard;

// use App\Livewire\Technician\Login as TechnicianLogin;
// use App\Livewire\Technician\Register as TechnicianRegister;
// use App\Livewire\Technician\Dashboard as TechnicianDashboard;

// use App\Livewire\AdminLogin;
// use App\Livewire\AdminRegister;

use App\Livewire\Admin\AdminLogin as AdminLogin;
use App\Livewire\Admin\AdminRegister as AdminRegister;
use App\Livewire\Admin\AdminDashboard as AdminDashboard;
use App\Livewire\Admin\AdminSport as AdminSport;
use App\Livewire\Admin\AdminTeam as AdminTeam;
use App\Livewire\Admin\AdminRule as AdminRule;
use App\Livewire\Admin\AdminSchedule as AdminSchedule;

use App\Livewire\Technician\TechnicianLogin as TechnicianLogin;
use App\Livewire\Technician\TechnicianRegister as TechnicianRegister;
use App\Livewire\Technician\TechnicianDashboard as TechnicianDashboard;
use App\Livewire\Technician\TechnicianRule as TechnicianRule;
use App\Livewire\Technician\TechnicianSchedule as TechnicianSchedule;

use App\Livewire\ResultForm;
use App\Livewire\ResultScore;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Technician\TechnicianDashboard as TechnicianTechnicianDashboard;
use App\Livewire\TechnicianResultscore;
use App\Livewire\TechnicianResultform;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


// Dashboard for any logged in + verified user
// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Public User settings (web guard)    
// Public authenticated user routes
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

// Authenticated Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('admin/admin-team', AdminTeam::class)->name('adminteam');
    Route::get('admin/admin-sport', AdminSport::class)->name('adminsport');
    Route::get('admin/admin-rule', AdminRule::class)->name('adminrule');
    Route::get('admin/admin-schedule', AdminSchedule::class)->name('adminschedule');
    Route::get('result-score', ResultScore::class)->name('result.score');
    Route::get('result-form', ResultForm::class)->name('result.form');
});

Route::middleware(['auth', 'role:technician'])->group(function () {
    Route::get('technician/dashboard', TechnicianDashboard::class)->name('techniciandashboard');
    Route::get('technician/technicianrule', TechnicianRule::class)->name('technicianrule');
    Route::get('technician/technicianschedule', TechnicianSchedule::class)->name('technicianschedule');
    Route::get('result-score', ResultScore::class)->name('result.score');
    Route::get('result-form', ResultForm::class)->name('result.form');
});

// 
// // // Admin-only routes
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('result-score', ResultScore::class)->name('result.score');
//     Route::get('result-form', ResultForm::class)->name('result.form');
// });

// // // Technician-only routes
// Route::middleware(['auth', 'role:technician'])->group(function () {
//     Route::get('technician-resultscore', TechnicianResultscore::class)->name('technician.resultscore');
//     Route::get('technician-resultform', TechnicianResultform::class)->name('technician.resultform');
// });


require __DIR__ . '/auth.php';
