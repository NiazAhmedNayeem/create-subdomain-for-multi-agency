<?php

use App\Http\Controllers\Agency\Auth\ClientAuthController;
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
