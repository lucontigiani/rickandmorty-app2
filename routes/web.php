<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ListaController;
use App\Models\Character;
use App\Models\Episode;
use App\Models\Location;

Route::get('/personajes', [CharacterController::class, 'index'])->name('characters.index');
Route::get('/personajes/{character}', [CharacterController::class, 'show'])->name('characters.show');
Route::get('/episodios', [EpisodeController::class, 'index'])->name('episodes.index');
Route::get('/episodios/{episode}', [EpisodeController::class, 'show'])->name('episodes.show');
Route::get('/ubicaciones', [LocationController::class, 'index'])->name('locations.index');
Route::get('/ubicaciones/{location}', [LocationController::class, 'show'])->name('locations.show');
Route::middleware('auth')->group(function () {
    Route::get('/listas', [ListaController::class, 'index'])->name('listas.index');
    Route::get('/listas/crear', [ListaController::class, 'create'])->name('listas.create');
    Route::post('/listas', [ListaController::class, 'store'])->name('listas.store');
    Route::get('/listas/{lista}', [ListaController::class, 'show'])->name('listas.show');
    Route::delete('/listas/{lista}', [ListaController::class, 'destroy'])->name('listas.destroy');
    Route::get('/listas/{lista}/editar', [ListaController::class, 'edit'])->name('listas.edit');
    Route::put('/listas/{lista}', [ListaController::class, 'update'])->name('listas.update');
    Route::post('/listas/{lista}/elementos', [ListaController::class, 'addItem'])->name('listas.items.add');
    Route::delete('/listas/{lista}/elementos/{item}', [ListaController::class, 'removeItem'])->name('listas.items.remove');
});
//El middleware auth redirige a /login a quien no tenga sesión. Las rutas públicas del explorador quedan fuera del grupo 

Route::get('/', function () {
    return view('home', [
        'characters' => Character::count(),
        'episodes' => Episode::count(),
        'locations' => Location::count(),
    ]);
})->name('home');

Route::get('/dashboard', fn () => redirect()->route('home'))
    ->middleware('auth')
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
