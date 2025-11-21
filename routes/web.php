<?php

use App\Http\Controllers\ExploreController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Common Page for all authenticated users
    Route::get('/explore', [ExploreController::class, 'index'])->name('explore.index');

    // Mentor Verified Only Page Here
    Route::middleware(['role:mentor', 'verified'])->prefix('mentor')->name('mentor.')->group(function () {
    });

    // Learner Only Page Here
    Route::middleware('role:learner')->group(function () {
    });
});

require __DIR__ . '/auth.php';
