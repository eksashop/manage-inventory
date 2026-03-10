<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login'); 
});

// Route Dashboard bawaan Breeze kita arahkan ke Inventory
Route::get('/dashboard', [ProductController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

// Route CRUD Products yang dilindungi sistem Login
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';