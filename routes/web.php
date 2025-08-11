<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authenticated: Role-aware /dashboard
|--------------------------------------------------------------------------
|
| Visiting /dashboard will redirect to the correct dashboard
| based on the logged-in user's role.
*/
Route::get('/dashboard', function () {
    $user = auth()->user();
    if (!$user) {
        return redirect()->route('login');
    }

    return strtolower($user->role ?? '') === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('complaints.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated: Profile + User (Complaints)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // USER area: prefix + namespacing keeps things tidy
    Route::prefix('complaints')->name('complaints.')->group(function () {
        // User dashboard (moved off the root /complaints to avoid conflicts)
        Route::get('/dashboard', [ComplaintController::class, 'dashboard'])->name('dashboard');

        // List, create, store
        Route::get('/', [ComplaintController::class, 'index'])->name('index');
        Route::get('/create', [ComplaintController::class, 'create'])->name('create');
        Route::post('/', [ComplaintController::class, 'store'])->name('store');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Area
|--------------------------------------------------------------------------
| Assumes you have a gate/middleware named 'admin' that checks role.
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Manage complaints list
        Route::get('/complaints', [AdminController::class, 'index'])->name('complaints');

        // Update status (POST)
        Route::post('/complaints/{id}/status', [AdminController::class, 'updateStatus'])
            ->name('complaints.updateStatus');

        // View a specific complaint (re-using your ComplaintController@show)
        Route::get('/complaints/{id}', [ComplaintController::class, 'show'])
            ->name('complaints.show');
    });

require __DIR__.'/auth.php';
