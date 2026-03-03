<?php

use App\Http\Controllers\Agency\Auth\ClientAuthController;
use App\Http\Controllers\Agency\Candidate\AgencyCandidateController;
use App\Http\Controllers\Agency\Candidate\CandidateAuthController;
use App\Http\Controllers\Agency\Candidate\CandidateDashboardController;
use App\Http\Controllers\Agency\Client\AgencyClientController;
use App\Http\Controllers\Agency\Client\ClientDashboardController;
use Illuminate\Support\Facades\Route;



Route::domain('{subdomain}.lvh.me')->middleware(['identify.agency'])->group(function () {

    // Agency Admin routes
    Route::middleware(['auth', 'check.agency', 'role:agency_admin'])->prefix('agency')->group(function () {

        Route::get('/dashboard', function () {
            $agency = request()->attributes->get('agency');
            return view('agency.dashboard', compact('agency'));
        })->name('agency.dashboard');



        Route::get('clients', [AgencyClientController::class, 'index'])->name('agency.clients.index');
        Route::get('candidates', [AgencyCandidateController::class, 'index'])->name('agency.candidates.index');
    });


    // Client routes
    Route::prefix('client')->group(function () {
        Route::get('register', [ClientAuthController::class, 'showRegister'])->name('client.register');
        Route::post('register', [ClientAuthController::class, 'register'])->name('client.register.store');
        Route::get('login', [ClientAuthController::class, 'showLogin'])->name('client.login');
        Route::post('login', [ClientAuthController::class, 'login'])->name('client.login.store');

        Route::middleware(['auth', 'role:client'])->group(function () {
            Route::get('dashboard', [ClientDashboardController::class, 'index'])->name('client.dashboard');
        });
    });


    // Candidate routes
    Route::prefix('candidate')->group(function () {
        Route::get('register', [CandidateAuthController::class, 'showRegister'])->name('candidate.register');
        Route::post('register', [CandidateAuthController::class, 'register'])->name('candidate.register.store');
        Route::get('login', [CandidateAuthController::class, 'showLogin'])->name('candidate.login');
        Route::post('login', [CandidateAuthController::class, 'login'])->name('candidate.login.store');

        Route::middleware(['auth', 'role:candidate'])->group(function () {
            Route::get('dashboard', [CandidateDashboardController::class, 'index'])->name('candidate.dashboard');
        });
    });
});
