<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\ProfileController;
use App\Models\Agency;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Database\Models\Tenant;
use Stancl\Tenancy\Database\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'super_admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    ///Agency Management
    Route::get('/agencies', [AgencyController::class, 'index'])->name('admin.agencies');
    Route::get('/agencies/create', [AgencyController::class, 'create'])->name('admin.agencies.create');
    Route::post('/agencies/store', [AgencyController::class, 'store'])->name('admin.agencies.store');
    Route::get('admin/agencies/{agency}/edit', [AgencyController::class, 'edit'])->name('admin.agencies.edit');
    Route::put('admin/agencies/{agency}', [AgencyController::class, 'update'])->name('admin.agencies.update');
    Route::delete('admin/agencies/{agency}', [AgencyController::class, 'destroy'])->name('admin.agencies.destroy');


    Route::get('/agencies/check-subdomain', function (\Illuminate\Http\Request $request) {
        $subdomain = strtolower($request->query('subdomain'));
        $excludeId = $request->query('exclude_id');

        $exists = \App\Models\Agency::where('subdomain', $subdomain)
            ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
            ->exists();

        return response()->json([
            'available' => !$exists
        ]);
    });
});







require __DIR__ . '/auth.php';
