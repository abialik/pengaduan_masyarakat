<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Masyarakat\LoginController;
use App\Http\Controllers\Masyarakat\RegisterController;
use App\Http\Controllers\Masyarakat\PengaduanController;
use App\Http\Controllers\AdminController;

// Halaman landing (umum sebelum login)
Route::get('/', function () {
    return view('landing');
});

// Alias Laravel auth
Route::get('/login', fn() => redirect()->route('masyarakat.login'))->name('login');
Route::get('/register', fn() => redirect()->route('masyarakat.register'))->name('register');
Route::post('/logout', fn() => redirect('/'))->name('logout');

// Group khusus masyarakat
Route::prefix('masyarakat')->group(function () {
    // === REGISTER ===
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('masyarakat.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('masyarakat.register.submit');

    // === LOGIN ===
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('masyarakat.login');
    Route::post('/login', [LoginController::class, 'login']);

    // === LOGOUT ===
    Route::post('/logout', [LoginController::class, 'logout'])->name('masyarakat.logout');

    // === DASHBOARD (menampilkan landing + laporan masyarakat) ===
    Route::get('/dashboard', [PengaduanController::class, 'dashboard'])
        ->middleware('auth:masyarakat')
        ->name('masyarakat.dashboard');

    // === FORM BUAT LAPORAN ===
    Route::get('/pengaduan', [PengaduanController::class, 'create'])
        ->middleware('auth:masyarakat')
        ->name('masyarakat.pengaduan');

    Route::post('/pengaduan', [PengaduanController::class, 'store'])
        ->middleware('auth:masyarakat')
        ->name('masyarakat.pengaduan.submit');
});

// Group khusus admin
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Tambahkan route lain sesuai kebutuhan fitur admin
});
