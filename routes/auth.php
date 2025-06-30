<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\Auth\ConfirmPassword;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\VerifyEmail;
use Illuminate\Support\Facades\Route;

use App\Livewire\Admin\AdminLogin as AdminLogin;
use App\Livewire\Admin\AdminRegister as AdminRegister;
use App\Livewire\Admin\AdminDashboard as AdminDashboard;
use App\Livewire\ResultForm;
use App\Livewire\ResultScore;
use App\Livewire\Technician\TechnicianLogin as TechnicianLogin;
use App\Livewire\Technician\TechnicianRegister as TechnicianRegister;
use App\Livewire\Technician\TechnicianDashboard as TechnicianDashboard;
use App\Livewire\TechnicianResultform;
use App\Livewire\TechnicianResultscore;

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
    Route::get('forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('reset-password/{token}', ResetPassword::class)->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', VerifyEmail::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::get('confirm-password', ConfirmPassword::class)
        ->name('password.confirm');
});


// Admin Routes (admin guard)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', AdminLogin::class)->name('login');
    Route::get('/register', AdminRegister::class)->name('register');

    Route::middleware('auth:admin')->group(function () {

        //
        
        Route::get('verify-email', VerifyEmail::class)
        ->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::get('confirm-password', ConfirmPassword::class)
            ->name('password.confirm');

        // 

        Route::get('/admin-dashboard', AdminDashboard::class)->name('admin-dashboard');
        // Route::get('/result-score', ResultScore::class)->name('result.score');
        // Route::get('/result-form', ResultForm::class)->name('result.form');

        // Add here — user must be authenticated
        Route::get('/result-score', ResultScore::class)->name('result.score');
        Route::get('/result-form', ResultForm::class)->name('result.form');

        Route::get('/technician-resultscore', TechnicianResultscore::class)->name('technician.resultscore');
        Route::get('/technician-resultform', TechnicianResultform::class)->name('technician-resultform');
    });
});

// // Technician Routes (technician guard)
Route::prefix('technician')->name('technician.')->group(function () {
    Route::get('/login', TechnicianLogin::class)->name('login');
    Route::get('/register', TechnicianRegister::class)->name('register');

    Route::middleware('auth:technician')->group(function () {
        Route::get('/technician-dashboard', TechnicianDashboard::class)->name('technician-dashboard');
        // Route::get('/resultscore', TechnicianResultscore::class)->name('resultscore');
        // Route::get('/resultform', TechnicianResultform::class)->name('resultform');

        // Add here — user must be authenticated
        Route::get('/result-score', ResultScore::class)->name('result.score');
        Route::get('/result-form', ResultForm::class)->name('result.form');

        Route::get('/technician-resultscore', TechnicianResultscore::class)->name('technician.resultscore');
        Route::get('/technician-resultform', TechnicianResultform::class)->name('technician-resultform');
    });
});


Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');
