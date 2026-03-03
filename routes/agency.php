<?php

use App\Http\Controllers\Agency\Admin\AgencyDashboardController;
use App\Http\Controllers\Agency\Admin\AgencyClientController;
use App\Http\Controllers\Agency\Admin\AgencyCandidateController;
use App\Http\Controllers\Agency\Candidate\CandidateDashboardController;
use App\Http\Controllers\Agency\Client\ClientDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agency\Auth\AgencyAuthController;



Route::domain('{subdomain}.lvh.me')->middleware(['identify.agency'])->group(function () {

    Route::get('login', [AgencyAuthController::class, 'showLogin'])->name('agency.login');
    Route::post('login', [AgencyAuthController::class, 'login'])->name('agency.login.store');


    Route::middleware(['auth', 'role:agency_admin'])->prefix('agency')->group(function () {

        Route::get('/dashboard', [AgencyDashboardController::class, 'index'])->name('agency.dashboard');
        Route::get('clients', [AgencyClientController::class, 'index'])->name('agency.clients.index');
        Route::get('candidates', [AgencyCandidateController::class, 'index'])->name('agency.candidates.index');
    });


    // Client routes
    Route::prefix('client')->group(function () {
        Route::get('register', [AgencyAuthController::class, 'clientShowRegister'])->name('client.register');
        Route::post('register', [AgencyAuthController::class, 'clientRegister'])->name('client.register.store');

        Route::middleware(['auth', 'role:client'])->group(function () {
            Route::get('dashboard', [ClientDashboardController::class, 'index'])->name('client.dashboard');
        });
    });


    // Candidate routes
    Route::prefix('candidate')->group(function () {
        Route::get('register', [AgencyAuthController::class, 'candidateShowRegister'])->name('candidate.register');
        Route::post('register', [AgencyAuthController::class, 'candidateRegister'])->name('candidate.register.store');

        Route::middleware(['auth', 'role:candidate'])->group(function () {
            Route::get('dashboard', [CandidateDashboardController::class, 'index'])->name('candidate.dashboard');
        });
    });
});
