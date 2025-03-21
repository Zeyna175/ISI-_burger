<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\BurgerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CommandeClientController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome'); // Assure-toi que le fichier welcome.blade.php existe
})->name('home');

// Route du dashboard général
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:gestionnaire'])
    ->name('dashboard');

// Routes protégées par l'authentification
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes accessibles uniquement par un gestionnaire
Route::middleware(['auth', 'role:gestionnaire'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('burgers', BurgerController::class);
    Route::resource('commandes', CommandeController::class)->except(['update', 'destroy']);
    Route::patch('/commandes/{commande}', [CommandeController::class, 'update'])->name('commandes.update');
    Route::delete('/commandes/{commande}', [CommandeController::class, 'destroy'])->name('commandes.destroy');
    Route::post('/commandes/{commande}/payer', [CommandeController::class, 'payer'])->name('commandes.payer');
    Route::patch('/commandes/{commande}/livraison', [CommandeController::class, 'updateLivraison'])->name('commandes.livraison');
});

// Routes accessibles uniquement par un client
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client', [ClientController::class, 'index'])->name('client.dashboard');
    Route::get('/commandes/create', [CommandeController::class, 'create'])->name('commandes.create');
    Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
    Route::get('/mes-commandes', [CommandeClientController::class, 'index'])->name('client.commandes');
});

// Route accessible à tous (clients et gestionnaires)
Route::get('/menu', [BurgerController::class, 'index'])->name('menu');
Route::post('/commander', [OrderController::class, 'store'])->name('order.store');

// Chargement des routes d'authentification (login, register...)
require __DIR__.'/auth.php';