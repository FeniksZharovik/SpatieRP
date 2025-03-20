<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;

// Halaman Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Middleware Auth
Route::middleware(['auth'])->group(function () {
    // Dashboard Admin (Hanya bisa diakses oleh Admin)
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');
    });

    // Dashboard User (Hanya bisa diakses oleh User)
    Route::middleware(['role:user'])->group(function () {
        Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
            ->name('user.dashboard');
    });
});
