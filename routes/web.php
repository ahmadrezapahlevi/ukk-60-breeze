<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaAspirasiController;
use App\Http\Controllers\AdminAspirasiController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\AdminUserController;

Route::redirect('/', '/login');

// SISWA Dashboard was using explicit /dashboard but since it's mapped by Breeze default, we can preserve it
Route::middleware('auth:siswa')->name('siswa.')->group(function () {
    // Note: 'auth:siswa' is conceptual in middleware, wait, we will use 'auth' and roles instead!
    // Actually our old middleware was 'siswa'. Let's keep it 'siswa' for now, but we will redefine the middleware to use Auth!
});

// Let's rewrite the routes keeping our existing middleware names
// SISWA
Route::middleware(['auth', 'siswa'])->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');

    Route::prefix('aspirasi')->name('aspirasi.')->group(function () {
        Route::get('/', [SiswaAspirasiController::class, 'index'])->name('index');
        Route::get('/create', [SiswaAspirasiController::class, 'create'])->name('create');
        Route::post('/', [SiswaAspirasiController::class, 'store'])->name('store');
        Route::get('/{aspirasi}', [SiswaAspirasiController::class, 'show'])->name('show');

        // Note: the old routes expected these without explicit resource controller.
        Route::get('/{aspirasi}/edit', [SiswaAspirasiController::class, 'edit'])->name('edit');
        Route::put('/{aspirasi}', [SiswaAspirasiController::class, 'update'])->name('update');
        Route::delete('/{aspirasi}', [SiswaAspirasiController::class, 'destroy'])->name('destroy');
    });
});

// ADMIN
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::prefix('aspirasi')->name('aspirasi.')->group(function () {
        Route::get('/', [AdminAspirasiController::class, 'index'])->name('index');
        Route::get('/{aspirasi}', [AdminAspirasiController::class, 'show'])->name('show');
        Route::post('/{aspirasi}/status', [AdminAspirasiController::class, 'update'])->name('update');
        Route::post('/{aspirasi}/feedback', [AdminAspirasiController::class, 'feedback'])->name('feedback');
    });

    Route::prefix('kategori')->name('kategori.')->group(function () {
        Route::get('/', [AdminKategoriController::class, 'index'])->name('index');
        Route::get('/create', [AdminKategoriController::class, 'create'])->name('create');
        Route::post('/', [AdminKategoriController::class, 'store'])->name('store');
        Route::get('/{kategori}', [AdminKategoriController::class, 'show'])->name('show');
        Route::get('/{kategori}/edit', [AdminKategoriController::class, 'edit'])->name('edit');
        Route::put('/{kategori}', [AdminKategoriController::class, 'update'])->name('update');
        Route::delete('/{kategori}', [AdminKategoriController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::get('/create', [AdminUserController::class, 'create'])->name('create');
        Route::post('/', [AdminUserController::class, 'store'])->name('store');
        Route::get('/{user}', [AdminUserController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [AdminUserController::class, 'update'])->name('update');
        Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
