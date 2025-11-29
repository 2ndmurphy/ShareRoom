<?php

use App\Http\Controllers\ExploreController;
use App\Http\Controllers\Mentor\{
    DashboardController,
    RoomController,
    RoomMaterialController,
    PostController,
    MentorProfileController,
};
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
    Route::prefix('explore')->name('explore.')->group(fn () => [
        Route::get('/', [ExploreController::class, 'index'])->name('index'),
        Route::get('/{room}', [ExploreController::class, 'showRoom'])->name('room.show'),
        Route::post('/{room}/join', [ExploreController::class, 'joinRoom'])->name('room.join'),
        Route::delete('/{room}/leave', [ExploreController::class, 'leaveRoom'])->name('room.leave'),
    ]);

    // Mentor Verified Only Page Here
    Route::middleware(['role:mentor', 'verified'])->prefix('m')->name('mentor.')->group(fn () => [
        Route::resource('dashboard', DashboardController::class),
        Route::resource('profile', MentorProfileController::class),
        Route::resource('rooms', RoomController::class),
        Route::resource('rooms.materials', RoomMaterialController::class),
        Route::resource('rooms.posts', PostController::class),
    ]);

    // Learner Only Page Here
    Route::middleware('role:learner')->group(fn () => [

    ]);
});

require __DIR__ . '/auth.php';
