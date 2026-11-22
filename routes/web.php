<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\LocationController;

Route::get('/personajes', [CharacterController::class, 'index'])->name('characters.index');
Route::get('/personajes/{character}', [CharacterController::class, 'show'])->name('characters.show');
Route::get('/episodios', [EpisodeController::class, 'index'])->name('episodes.index');
Route::get('/episodios/{episode}', [EpisodeController::class, 'show'])->name('episodes.show');
Route::get('/ubicaciones', [LocationController::class, 'index'])->name('locations.index');
Route::get('/ubicaciones/{location}', [LocationController::class, 'show'])->name('locations.show');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
