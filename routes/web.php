<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananPublikController; // <-- PASTIKAN INI ADA
use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\Admin\LayananController; // <-- Hapus atau komen dulu jika belum dibuat

// =======================================================
// 1. ROUTE PUBLIK / UMUM
// =======================================================

// Halaman Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Halaman Layanan (Halaman 4) - BISA DIAKSES SEMUA ORANG
Route::get('/layanan', [LayananPublikController::class, 'index'])->name('layanan.publik.index');

// =======================================================
// 2. ROUTE OTENTIKASI (LOGIN/REGISTER/DASHBOARD USER)
// =======================================================

// Login/Sign Up (Route di dalam auth.php)
require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
// Route yang butuh login (Dashboard User)
Route::get('/dashboard-user', function () {
        return view('dashboard'); 
    })->name('dashboard'); // <-- Beri nama 'dashboard'

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

// =======================================================
// 3. ROUTE ADMIN (Hanya Bisa Diakses Admin)
// =======================================================

Route::middleware(['auth', 'is.admin'])->prefix('admin')->group(function () {

    // ADMIN DASHBOARD
    Route::get('/', function () {
        return view('admin.dashboard'); 
    })->name('admin.dashboard');

    // Nanti kita tambahkan CRUD Layanan Admin di sini
});