<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;

// Public route
Route::get('/', function () {
    return view('welcome');
});

// Authenticated user dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes for authenticated users
Route::middleware('auth')->group(function () {
    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Complaint routes (for users)
    Route::get('/complaints', [ComplaintController::class, 'dahboard'])->name('complaints.dashboard');
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/complaints', [AdminController::class, 'index'])->name('admin.complaints');
    Route::post('/complaints/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.complaints.updateStatus');
    Route::get('/complaints/{id}', [ComplaintController::class, 'show'])->name('admin.complaints.show');
});



require __DIR__.'/auth.php';
