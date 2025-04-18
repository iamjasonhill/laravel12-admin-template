<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;

Route::view('/', 'welcome');

Route::get('dashboard', function() {
    // Check if user has admin role and redirect to admin dashboard
    if (auth()->check() && auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    
    // Email Logs Routes
    Route::prefix('email-logs')->name('email-logs.')->group(function () {
        Route::get('/', function() { 
            return view('admin.email-logs.index'); 
        })->name('index');
    });
    
    // Theme toggle route for dark/light mode
    Route::post('/theme-toggle', function() {
        session(['theme' => request('theme', 'light')]);
        return response()->json(['success' => true]);
    })->name('theme.toggle');
});

require __DIR__.'/auth.php';
