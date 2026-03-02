<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Database\Models\Tenant;
use Stancl\Tenancy\Database\Models\Domain;
use Illuminate\Http\Request;

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

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/agencies', function () {
        return view('admin.agencies');
    })->name('admin.agencies');


    Route::get('/agencies/create', function () {
        return view('admin.create-agency');
    })->name('admin.agencies.create');

    Route::post('/agencies/store', function (Request $request) {

        $subdomain = strtolower(str_replace(' ', '', $request->name));

        $tenant = Tenant::create([
            'id' => $subdomain,
        ]);

        Domain::create([
            'domain' => $subdomain . '.lvh.me',
            'tenant_id' => $tenant->id,
        ]);

        \Artisan::call('tenants:migrate', [
            '--tenants' => [$tenant->id],
        ]);

        return redirect()->route('admin.agencies')
            ->with('success', 'Agency Created Successfully');
    })->name('admin.agencies.store');
});





require __DIR__ . '/auth.php';
