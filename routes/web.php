<?php

use App\Http\Controllers\LeverancierController;
use App\Http\Controllers\MagazijnController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

    // Magazijn, Levering & Allergenen routes
    Route::get('/magazijn', [MagazijnController::class, 'index'])->name('magazijn.index');
    Route::get('/magazijn/{productId}/levering', [MagazijnController::class, 'levering'])->name('magazijn.levering');
    Route::get('/magazijn/{productId}/allergenen', [MagazijnController::class, 'allergenen'])->name('magazijn.allergenen');

    // Leverancier & Productlevering routes (Opdracht 02)
    Route::get('/leveranciers', [LeverancierController::class, 'index'])->name('leverancier.index');
    Route::get('/leveranciers/{leverancierId}/producten', [LeverancierController::class, 'producten'])->name('leverancier.producten');
    Route::get('/leveranciers/{leverancierId}/producten/{productId}/levering', [LeverancierController::class, 'leveringCreate'])->name('leverancier.levering.create');
    Route::post('/leveranciers/{leverancierId}/producten/{productId}/levering', [LeverancierController::class, 'leveringStore'])->name('leverancier.levering.store');
});

require __DIR__.'/auth.php';

