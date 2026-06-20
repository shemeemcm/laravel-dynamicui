<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UIBlockController;
use Illuminate\Support\Facades\Route;

// Client Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Dashboard Redirect Wrapper (to preserve route('dashboard') calls)
Route::get('/dashboard', function () {
    return auth()->user()->role === 'admin' 
        ? redirect()->route('admin.dashboard') 
        : redirect()->route('home');
})->middleware(['auth'])->name('dashboard');

// Auth routes (includes /login, /register, etc.)
require __DIR__.'/auth.php';

// Profile routes (Shared)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Group
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', function () {
        $stats = [
            'total' => \App\Models\UIBlock::count(),
            'active' => \App\Models\UIBlock::where('status', true)->count(),
            'inactive' => \App\Models\UIBlock::where('status', false)->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    })->name('dashboard');

    // UI Blocks AJAX Routes
    Route::post('/blocks/update-order', [UIBlockController::class, 'updateOrder'])->name('blocks.update-order');
    Route::post('/blocks/{block}/toggle-status', [UIBlockController::class, 'toggleStatus'])->name('blocks.toggle-status');

    // UI Blocks Resource
    Route::resource('blocks', UIBlockController::class);
});
