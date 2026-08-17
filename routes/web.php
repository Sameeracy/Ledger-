<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// Public Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Ledger Dashboard
    Route::get('/dashboard', [TransactionController::class, 'index'])->name('dashboard');

    // Transaction Resource Routes
    Route::resource('transactions', TransactionController::class);

    // Quick Status Toggle Route
    Route::patch('/transactions/{transaction}/toggle-status', [TransactionController::class, 'toggleStatus'])
        ->name('transactions.toggle-status');

    // User Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';