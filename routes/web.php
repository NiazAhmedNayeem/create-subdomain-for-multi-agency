<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdmin\AgencyController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use Illuminate\Support\Facades\Route;


Route::domain('lvh.me')->group(function () {

    // Route::get('/', function () {
    //     return view('welcome');
    // });

    Route::get('/', [FrontendController::class, 'index'])->name('home');


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware(['auth', 'super_admin'])->prefix('admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        ///Agency Management
        Route::get('/agencies', [AgencyController::class, 'index'])->name('admin.agencies');
        Route::get('/agencies/create', [AgencyController::class, 'create'])->name('admin.agencies.create');
        Route::post('/agencies/store', [AgencyController::class, 'store'])->name('admin.agencies.store');
        Route::get('admin/agencies/{agency}/edit', [AgencyController::class, 'edit'])->name('admin.agencies.edit');
        Route::put('admin/agencies/{agency}', [AgencyController::class, 'update'])->name('admin.agencies.update');
        Route::delete('admin/agencies/{agency}', [AgencyController::class, 'destroy'])->name('admin.agencies.destroy');
        //Ajax subdomain check
        Route::get('/agencies/check-subdomain', [AgencyController::class, 'subDomainCheck'])->name('admin.agencies.check-subdomain');
    });

    require __DIR__ . '/auth.php';
});
