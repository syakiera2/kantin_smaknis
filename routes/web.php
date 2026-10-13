<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Import Controller dengan Alias agar tidak bentrok namanya
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\TopUpController as AdminTopUpController;


use App\Http\Controllers\Penjual\DashboardController as PenjualDashboardController;
use App\Http\Controllers\Pembeli\DashboardController as PembeliDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

// ==========================================
// 1. ROUTE KHUSUS ADMIN
// ==========================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard'); // Menghasilkan nama 'admin.dashboard'

    // Perbaikan di bagian ini:
    Route::get('/topups', [AdminTopUpController::class, 'index'])->name('topups.index'); // Menjadi 'admin.topups.index'
    Route::get('topups/create', [AdminTopUpController::class, 'create'])->name('topups.create');
    Route::post('topups', [AdminTopUpController::class, 'store'])->name('topups.store');
    Route::get('topups/{topUp}', [AdminTopUpController::class, 'show'])->name('topups.show');
});
    
    // Tambahan rute admin lainnya di sini jika ada...
    // Contoh: Route::get('/users', [AdminDashboardController::class, 'users'])->name('users');


// ==========================================
// 2. ROUTE KHUSUS PENJUAL
// ==========================================
Route::middleware(['auth'])->prefix('penjual')->name('penjual.')->group(function () {
    Route::get('/dashboard', [PenjualDashboardController::class, 'index'])->name('dashboard');
    
    // Tambahan rute penjual lainnya di sini...
});


// ==========================================
// 3. ROUTE KHUSUS PEMBELI (SISWA)
// ==========================================
Route::middleware(['auth'])->prefix('pembeli')->name('pembeli.')->group(function () {
    Route::get('/dashboard', [PembeliDashboardController::class, 'index'])->name('dashboard');
    
    // Tambahan rute pembeli lainnya di sini...
});

// Rute Logout yang menangani method POST dari tombol logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Memuat rute bawaan autentikasi dari Breeze (login, register, dll)
require __DIR__.'/auth.php';