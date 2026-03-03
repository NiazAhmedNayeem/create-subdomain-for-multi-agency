<?php

use App\Http\Controllers\Agency\Auth\ClientAuthController;
use App\Http\Controllers\Agency\Candidate\AgencyCandidateController;
use App\Http\Controllers\Agency\Candidate\CandidateAuthController;
use App\Http\Controllers\Agency\Candidate\CandidateDashboardController;
use App\Http\Controllers\Agency\Client\ClientDashboardController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'check.agency'])->prefix('agency')->group(function () {

    Route::get('/dashboard', function () {

        $agency = request()->attributes->get('agency');

        return view('agency.dashboard', compact('agency'));
    })->name('agency.dashboard');
});


Route::domain('{subdomain}.lvh.me')->middleware('identify.agency')->group(function () {

        Route::get('/client/register', [ClientAuthController::class, 'showRegister'])->name('client.register');
        Route::post('/client/register', [ClientAuthController::class, 'register'])->name('client.register.store');
        // Login
        Route::get('/client/login', [ClientAuthController::class, 'showLogin'])->name('client.login');
        Route::post('/client/login', [ClientAuthController::class, 'login'])->name('client.login.store');

        // Dashboard
        Route::middleware(['auth', 'role:client'])->group(function () {
            Route::get('/client/dashboard', [ClientDashboardController::class, 'index'])->name('client.dashboard');
        });

});


Route::domain('{subdomain}.lvh.me')->middleware('identify.agency')->group(function () {

        Route::get('/candidate/register', [CandidateAuthController::class, 'showRegister'])->name('candidate.register');
        Route::post('/candidate/register', [CandidateAuthController::class, 'register'])->name('candidate.register.store');
        // Login
        Route::get('/candidate/login', [CandidateAuthController::class, 'showLogin'])->name('candidate.login');
        Route::post('/candidate/login', [CandidateAuthController::class, 'login'])->name('candidate.login.store');

        // Dashboard
        Route::middleware(['auth', 'role:candidate'])->group(function () {
            Route::get('/candidate/dashboard', [CandidateDashboardController::class, 'index'])->name('candidate.dashboard');
        });

});


Route::middleware(['auth', 'check.agency', 'role:agency_admin'])->prefix('agency')->group(function () {

    // Candidate List
    Route::get('/candidates', [AgencyCandidateController::class, 'index'])->name('agency.candidates.index');

    // Create Candidate
    // Route::get('/candidates/create', [AgencyCandidateController::class, 'create'])->name('candidates.create');
    // Route::post('/candidates', [AgencyCandidateController::class, 'store'])->name('candidates.store');

    // // Edit Candidate
    // Route::get('/candidates/{candidate}/edit', [AgencyCandidateController::class, 'edit'])->name('candidates.edit');
    // Route::put('/candidates/{candidate}', [AgencyCandidateController::class, 'update'])->name('candidates.update');

    // // Delete Candidate
    // Route::delete('/candidates/{candidate}', [AgencyCandidateController::class, 'destroy'])->name('candidates.destroy');
});
