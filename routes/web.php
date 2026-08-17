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
    Route::get('/dashboard', [TransactionController::class, 'index'])->name('dashboard');
    
    // Dedicated Credit & Debit Routes
    Route::get('/credits', [TransactionController::class, 'credits'])->name('transactions.credits');
    Route::get('/debits', [TransactionController::class, 'debits'])->name('transactions.debits');

    Route::resource('transactions', TransactionController::class);
    Route::patch('/transactions/{transaction}/toggle-status', [TransactionController::class, 'toggleStatus'])
        ->name('transactions.toggle-status');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';